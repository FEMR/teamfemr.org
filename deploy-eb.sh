#!/bin/bash

export AWS_PROFILE=teamfemr

# Initialize Elastic Beanstalk (run once)
# eb init teamfemr --platform "Docker running on 64bit Amazon Linux 2" --region us-east-2

# Deploy to Elastic Beanstalk
eb deploy

echo "Deployed to Elastic Beanstalk"