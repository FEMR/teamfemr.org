#!/bin/bash

# Set profile and variables
export AWS_PROFILE=teamfemr
ACCOUNT_ID=$(aws sts get-caller-identity --query Account --output text)
ECR_REGISTRY=${ACCOUNT_ID}.dkr.ecr.us-east-2.amazonaws.com
REGION=us-east-2

echo "Starting Fargate deployment for account: $ACCOUNT_ID"

# Create ECR repository if it doesn't exist
aws ecr describe-repositories --repository-names teamfemr --region $REGION 2>/dev/null || \
aws ecr create-repository --repository-name teamfemr --region $REGION

# Build and push Docker image
echo "Building and pushing Docker image..."
aws ecr get-login-password --region $REGION | docker login --username AWS --password-stdin $ECR_REGISTRY
docker build --platform linux/amd64 -t teamfemr .
docker tag teamfemr:latest $ECR_REGISTRY/teamfemr:latest
docker push $ECR_REGISTRY/teamfemr:latest

# Update task definition with account ID
sed "s/ACCOUNT_ID/$ACCOUNT_ID/g" task-definition.json > task-definition-updated.json

# Create ECS cluster
echo "Creating ECS cluster..."
aws ecs create-cluster --cluster-name teamfemr --region $REGION 2>/dev/null || echo "Cluster already exists"

# Create CloudWatch log group
echo "Creating CloudWatch log group..."
aws logs create-log-group --log-group-name /ecs/teamfemr --region $REGION 2>/dev/null || echo "Log group already exists"

# Create ECS execution role
echo "Creating ECS execution role..."
aws iam create-role --role-name ecsTaskExecutionRole --assume-role-policy-document '{
  "Version": "2012-10-17",
  "Statement": [
    {
      "Effect": "Allow",
      "Principal": {"Service": "ecs-tasks.amazonaws.com"},
      "Action": "sts:AssumeRole"
    }
  ]
}' 2>/dev/null || echo "Role already exists"

aws iam attach-role-policy --role-name ecsTaskExecutionRole --policy-arn arn:aws:iam::aws:policy/service-role/AmazonECSTaskExecutionRolePolicy 2>/dev/null

# Register task definition
echo "Registering task definition..."
aws ecs register-task-definition --cli-input-json file://task-definition-updated.json --region $REGION

# Get default VPC and subnets
echo "Getting VPC and subnet information..."
VPC_ID=$(aws ec2 describe-vpcs --filters "Name=is-default,Values=true" --query "Vpcs[0].VpcId" --output text --region $REGION)
SUBNET_IDS=$(aws ec2 describe-subnets --filters "Name=vpc-id,Values=$VPC_ID" --query "Subnets[0:2].SubnetId" --output text --region $REGION | tr '\t' ',')

# Create security group
echo "Creating security group..."
SG_ID=$(aws ec2 create-security-group --group-name teamfemr-sg --description "TeamFEMR security group" --vpc-id $VPC_ID --region $REGION --query "GroupId" --output text 2>/dev/null) || \
SG_ID=$(aws ec2 describe-security-groups --filters "Name=group-name,Values=teamfemr-sg" --query "SecurityGroups[0].GroupId" --output text --region $REGION)

aws ec2 authorize-security-group-ingress --group-id $SG_ID --protocol tcp --port 8080 --cidr 0.0.0.0/0 --region $REGION 2>/dev/null || echo "Security group rule already exists"

# Allow outbound MySQL traffic to RDS
aws ec2 authorize-security-group-egress --group-id $SG_ID --protocol tcp --port 3306 --cidr 0.0.0.0/0 --region $REGION 2>/dev/null || echo "MySQL egress rule already exists"

# Get RDS security group and allow Fargate access
RDS_SG_ID=$(aws rds describe-db-instances --db-instance-identifier teamfemr-db --query "DBInstances[0].VpcSecurityGroups[0].VpcSecurityGroupId" --output text --region $REGION 2>/dev/null)
if [ "$RDS_SG_ID" != "None" ] && [ "$RDS_SG_ID" != "" ]; then
  aws ec2 authorize-security-group-ingress --group-id $RDS_SG_ID --protocol tcp --port 3306 --source-group $SG_ID --region $REGION 2>/dev/null || echo "RDS access rule already exists"
fi

# Get RDS endpoint and create database
RDS_ENDPOINT=$(aws rds describe-db-instances --db-instance-identifier teamfemr-db --query "DBInstances[0].Endpoint.Address" --output text --region $REGION 2>/dev/null)
echo "RDS Endpoint: $RDS_ENDPOINT"
echo "Creating database 'teamfemr' if it doesn't exist..."
echo "You need to run: docker run -it --rm mysql:8.0 mysql -h $RDS_ENDPOINT -u YOUR_USERNAME -p -e 'CREATE DATABASE IF NOT EXISTS teamfemr;'"

# Delete existing service if it exists
echo "Checking for existing service..."
aws ecs update-service --cluster teamfemr --service teamfemr --desired-count 0 --region $REGION 2>/dev/null
aws ecs delete-service --cluster teamfemr --service teamfemr --region $REGION 2>/dev/null
sleep 10

# Create ECS service
echo "Creating ECS service..."
aws ecs create-service \
  --cluster teamfemr \
  --service-name teamfemr \
  --task-definition teamfemr \
  --desired-count 1 \
  --launch-type FARGATE \
  --network-configuration "awsvpcConfiguration={subnets=[$SUBNET_IDS],securityGroups=[$SG_ID],assignPublicIp=ENABLED}" \
  --region $REGION

echo "Deployment complete! Waiting for service to start..."
aws ecs wait services-stable --cluster teamfemr --services teamfemr --region $REGION

# Get public IP
echo "Getting public IP address..."
TASK_ARN=$(aws ecs list-tasks --cluster teamfemr --service-name teamfemr --query "taskArns[0]" --output text --region $REGION)

if [ "$TASK_ARN" = "None" ] || [ -z "$TASK_ARN" ]; then
  echo "No running tasks found. Service may still be starting."
  exit 1
fi

ENI_ID=$(aws ecs describe-tasks --cluster teamfemr --tasks $TASK_ARN --query "tasks[0].attachments[0].details[?name=='networkInterfaceId'].value" --output text --region $REGION)
PUBLIC_IP=$(aws ec2 describe-network-interfaces --network-interface-ids $ENI_ID --query "NetworkInterfaces[0].Association.PublicIp" --output text --region $REGION)

echo "Application deployed successfully!"
echo "Access your Laravel app at: http://$PUBLIC_IP:8080"

# Cleanup
rm -f task-definition-updated.json