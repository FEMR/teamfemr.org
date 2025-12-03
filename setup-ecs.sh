#!/bin/bash

export AWS_PROFILE=teamfemr
ACCOUNT_ID=$(aws sts get-caller-identity --query Account --output text)

# Replace ACCOUNT_ID in task definition
sed "s/ACCOUNT_ID/$ACCOUNT_ID/g" ecs-task-definition.json > ecs-task-definition-final.json

# Create ECS cluster
aws ecs create-cluster --cluster-name teamfemr-cluster --region us-east-2

# Create log group
aws logs create-log-group --log-group-name /ecs/teamfemr --region us-east-2

# Register task definition
aws ecs register-task-definition --cli-input-json file://ecs-task-definition-final.json --region us-east-2

# Create ECS service (requires VPC setup)
echo "Next: Create ECS service with ALB and configure VPC/subnets"
echo "Use AWS Console or complete the service creation with your VPC details"