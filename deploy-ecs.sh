#!/bin/bash

# Set profile and variables
export AWS_PROFILE=teamfemr
ACCOUNT_ID=$(aws sts get-caller-identity --query Account --output text)

# Create ECS cluster
aws ecs create-cluster --cluster-name teamfemr --region us-east-2

# Create CloudWatch log group
aws logs create-log-group --log-group-name /ecs/teamfemr --region us-east-2

# Create ECS execution role (if it doesn't exist)
aws iam create-role --role-name ecsTaskExecutionRole --assume-role-policy-document '{
  "Version": "2012-10-17",
  "Statement": [
    {
      "Effect": "Allow",
      "Principal": {"Service": "ecs-tasks.amazonaws.com"},
      "Action": "sts:AssumeRole"
    }
  ]
}'

aws iam attach-role-policy --role-name ecsTaskExecutionRole --policy-arn arn:aws:iam::aws:policy/service-role/AmazonECSTaskExecutionRolePolicy

# Register task definition
aws ecs register-task-definition --cli-input-json file://task-definition.json --region us-east-2

# Get default VPC and subnets
VPC_ID=$(aws ec2 describe-vpcs --filters "Name=is-default,Values=true" --query "Vpcs[0].VpcId" --output text --region us-east-2)
SUBNET_IDS=$(aws ec2 describe-subnets --filters "Name=vpc-id,Values=$VPC_ID" --query "Subnets[0:2].SubnetId" --output text --region us-east-2)

# Create security group
SG_ID=$(aws ec2 create-security-group --group-name teamfemr-sg --description "TeamFEMR security group" --vpc-id $VPC_ID --region us-east-2 --query "GroupId" --output text)
aws ec2 authorize-security-group-ingress --group-id $SG_ID --protocol tcp --port 8080 --cidr 0.0.0.0/0 --region us-east-2

# Create ECS service
aws ecs create-service \
  --cluster teamfemr \
  --service-name teamfemr \
  --task-definition teamfemr:1 \
  --desired-count 1 \
  --launch-type FARGATE \
  --network-configuration "awsvpcConfiguration={subnets=[$SUBNET_IDS],securityGroups=[$SG_ID],assignPublicIp=ENABLED}" \
  --region us-east-2

echo "ECS service created. Check AWS Console for public IP."