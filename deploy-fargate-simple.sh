#!/bin/bash

export AWS_PROFILE=teamfemr
ACCOUNT_ID=$(aws sts get-caller-identity --query Account --output text)
ECR_REGISTRY=${ACCOUNT_ID}.dkr.ecr.us-east-2.amazonaws.com

# Build and push image
aws ecr get-login-password --region us-east-2 | docker login --username AWS --password-stdin $ECR_REGISTRY
docker build -t teamfemr .
docker tag teamfemr:latest $ECR_REGISTRY/teamfemr:latest
docker push $ECR_REGISTRY/teamfemr:latest

# Update task definition
sed "s/ACCOUNT_ID/$ACCOUNT_ID/g" task-definition.json > task-definition-updated.json

# Register new task definition
aws ecs register-task-definition --cli-input-json file://task-definition-updated.json --region us-east-2

# Update service (if it exists)
aws ecs update-service --cluster teamfemr --service teamfemr --task-definition teamfemr --region us-east-2

echo "Deployment initiated. Check status with:"
echo "aws ecs describe-services --cluster teamfemr --services teamfemr --profile teamfemr --region us-east-2"

rm -f task-definition-updated.json