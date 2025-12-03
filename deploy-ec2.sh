#!/bin/bash

export AWS_PROFILE=teamfemr
ACCOUNT_ID=$(aws sts get-caller-identity --query Account --output text)
ECR_REGISTRY=${ACCOUNT_ID}.dkr.ecr.us-east-2.amazonaws.com
EC2_HOST="your-ec2-instance-ip"

# Build and push to ECR (same as before)
aws ecr get-login-password --region us-east-2 | docker login --username AWS --password-stdin $ECR_REGISTRY
docker build --platform linux/amd64 -t teamfemr .
docker tag teamfemr:latest $ECR_REGISTRY/teamfemr:latest
docker push $ECR_REGISTRY/teamfemr:latest

# Deploy to EC2
ssh -i ~/.ssh/your-key.pem ec2-user@$EC2_HOST << 'EOF'
  # Login to ECR
  aws ecr get-login-password --region us-east-2 | docker login --username AWS --password-stdin ACCOUNT_ID.dkr.ecr.us-east-2.amazonaws.com
  
  # Stop existing container
  docker stop teamfemr || true
  docker rm teamfemr || true
  
  # Run new container
  docker run -d --name teamfemr -p 80:8080 \
    -e APP_NAME="TeamfEMR" \
    -e APP_ENV="production" \
    -e APP_DEBUG="false" \
    -e DB_HOST="teamfemr-db.c1wk6a6i8bnd.us-east-2.rds.amazonaws.com" \
    -e DB_DATABASE="teamfemr" \
    -e DB_USERNAME="admin" \
    -e DB_PASSWORD="CalPolyRocks2025!" \
    ACCOUNT_ID.dkr.ecr.us-east-2.amazonaws.com/teamfemr:latest
EOF