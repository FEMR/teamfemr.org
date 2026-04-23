#!/bin/bash
set -e

# Configuration
# Disable AWS CLI pager so script output never pauses in less/more.
export AWS_PAGER=""
export CLI_PAGER=""
export AWS_PROFILE=teamfemr
ACCOUNT_ID=$(aws sts get-caller-identity --query Account --output text)
ECR_REGISTRY=${ACCOUNT_ID}.dkr.ecr.us-east-2.amazonaws.com
REGION=us-east-2

echo "🚀 Starting Fargate deployment for account: $ACCOUNT_ID"

# Create ECR repository
echo "📦 Setting up ECR repository..."
aws ecr describe-repositories --repository-names teamfemr --region $REGION 2>/dev/null || \
aws ecr create-repository --repository-name teamfemr --region $REGION

# Build and push Docker image
echo "🔨 Building and pushing Docker image..."
aws ecr get-login-password --region $REGION | docker login --username AWS --password-stdin $ECR_REGISTRY
docker build --platform linux/amd64 -t teamfemr .
docker tag teamfemr:latest $ECR_REGISTRY/teamfemr:latest
docker push $ECR_REGISTRY/teamfemr:latest

# Update task definition with env vars from .env.production
echo "📝 Updating task definition..."
if [ ! -f .env.production ]; then
  echo "❌ .env.production not found. Copy .env.production.example and fill in real values."
  exit 1
fi

# Build JSON array from .env.production (skip comments and blank lines)
ENV_JSON=$(grep -v '^#' .env.production | grep -v '^$' | grep '=' | while IFS='=' read -r key value; do
  value=$(echo "$value" | sed 's/^"//' | sed 's/"$//')
  printf '{"name":"%s","value":"%s"},' "$key" "$value"
done | sed 's/,$//')

sed "s/ACCOUNT_ID/$ACCOUNT_ID/g" task-definition.json | \
  python3 -c "
import json, sys
td = json.load(sys.stdin)
td['containerDefinitions'][0]['environment'] = json.loads('[' + sys.argv[1] + ']')
print(json.dumps(td))
" "$ENV_JSON" > task-definition-updated.json

# Create ECS resources
echo "☁️ Setting up ECS resources..."
aws ecs create-cluster --cluster-name teamfemr --region $REGION 2>/dev/null || echo "Cluster exists"
aws logs create-log-group --log-group-name /ecs/teamfemr --region $REGION 2>/dev/null || echo "Log group exists"

# Create execution role
aws iam create-role --role-name ecsTaskExecutionRole --assume-role-policy-document '{
  "Version": "2012-10-17",
  "Statement": [{
    "Effect": "Allow",
    "Principal": {"Service": "ecs-tasks.amazonaws.com"},
    "Action": "sts:AssumeRole"
  }]
}' 2>/dev/null || echo "Role exists"

aws iam attach-role-policy --role-name ecsTaskExecutionRole \
  --policy-arn arn:aws:iam::aws:policy/service-role/AmazonECSTaskExecutionRolePolicy 2>/dev/null || true

# Register task definition
aws ecs register-task-definition --cli-input-json file://task-definition-updated.json --region $REGION

# Setup networking
echo "🌐 Setting up networking..."
VPC_ID=$(aws ec2 describe-vpcs --filters "Name=is-default,Values=true" --query "Vpcs[0].VpcId" --output text --region $REGION)
SUBNET_IDS=$(aws ec2 describe-subnets --filters "Name=vpc-id,Values=$VPC_ID" --query "Subnets[0:2].SubnetId" --output text --region $REGION | tr '\t' ',')

# Create security group
SG_ID=$(aws ec2 create-security-group --group-name teamfemr-sg --description "TeamFEMR security group" \
  --vpc-id $VPC_ID --region $REGION --query "GroupId" --output text 2>/dev/null) || \
SG_ID=$(aws ec2 describe-security-groups --filters "Name=group-name,Values=teamfemr-sg" \
  --query "SecurityGroups[0].GroupId" --output text --region $REGION)

# Configure security group rules
aws ec2 authorize-security-group-ingress --group-id $SG_ID --protocol tcp --port 8080 --cidr 0.0.0.0/0 --region $REGION 2>/dev/null || true
aws ec2 authorize-security-group-egress --group-id $SG_ID --protocol tcp --port 3306 --cidr 0.0.0.0/0 --region $REGION 2>/dev/null || true

# Configure RDS access
RDS_SG_ID=$(aws rds describe-db-instances --db-instance-identifier teamfemr-db \
  --query "DBInstances[0].VpcSecurityGroups[0].VpcSecurityGroupId" --output text --region $REGION 2>/dev/null)
if [ "$RDS_SG_ID" != "None" ] && [ -n "$RDS_SG_ID" ]; then
  aws ec2 authorize-security-group-ingress --group-id $RDS_SG_ID --protocol tcp --port 3306 \
    --source-group $SG_ID --region $REGION 2>/dev/null || echo "RDS access already configured"
fi

# Deploy service
echo "🚢 Deploying service..."
SERVICE_EXISTS=$(aws ecs describe-services --cluster teamfemr --services teamfemr \
  --query "services[?status=='ACTIVE'].serviceName" --output text --region $REGION 2>/dev/null)

if [ -n "$SERVICE_EXISTS" ]; then
  echo "Updating existing service (preserving load balancer config)..."
  aws ecs update-service \
    --cluster teamfemr \
    --service teamfemr \
    --task-definition teamfemr \
    --desired-count 1 \
    --region $REGION
else
  echo "Creating new service..."
  aws ecs create-service \
    --cluster teamfemr \
    --service-name teamfemr \
    --task-definition teamfemr \
    --desired-count 1 \
    --launch-type FARGATE \
    --network-configuration "awsvpcConfiguration={subnets=[$SUBNET_IDS],securityGroups=[$SG_ID],assignPublicIp=ENABLED}" \
    --region $REGION
fi

echo "⏳ Waiting for service to stabilize..."
aws ecs wait services-stable --cluster teamfemr --services teamfemr --region $REGION

# Get public IP
echo "🔍 Getting public IP..."
TASK_ARN=$(aws ecs list-tasks --cluster teamfemr --service-name teamfemr --query "taskArns[0]" --output text --region $REGION)
if [ "$TASK_ARN" != "None" ] && [ -n "$TASK_ARN" ]; then
  ENI_ID=$(aws ecs describe-tasks --cluster teamfemr --tasks $TASK_ARN \
    --query "tasks[0].attachments[0].details[?name=='networkInterfaceId'].value" --output text --region $REGION)
  PUBLIC_IP=$(aws ec2 describe-network-interfaces --network-interface-ids $ENI_ID \
    --query "NetworkInterfaces[0].Association.PublicIp" --output text --region $REGION)
  
  echo "✅ Deployment successful!"
  echo "🌐 Access your app at: http://$PUBLIC_IP:8080"
else
  echo "❌ No running tasks found"
fi

# Cleanup
rm -f task-definition-updated.json