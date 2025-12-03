#!/bin/bash

# Set profile and variables
export AWS_PROFILE=teamfemr
ACCOUNT_ID=$(aws sts get-caller-identity --query Account --output text)
ECR_REGISTRY=${ACCOUNT_ID}.dkr.ecr.us-east-2.amazonaws.com

# Build and push to ECR
aws ecr get-login-password --region us-east-2 | docker login --username AWS --password-stdin $ECR_REGISTRY
docker build --platform linux/amd64 -t teamfemr .
docker tag teamfemr:latest $ECR_REGISTRY/teamfemr:latest
docker push $ECR_REGISTRY/teamfemr:latest

echo "Image pushed to: $ECR_REGISTRY/teamfemr:latest"

# Deploy to ECS Fargate
echo "Deploying to ECS Fargate..."

# Update ECS service
aws ecs update-service \
  --cluster teamfemr-cluster \
  --service teamfemr-service \
  --force-new-deployment \
  --region us-east-2

echo "ECS service updated with new image"