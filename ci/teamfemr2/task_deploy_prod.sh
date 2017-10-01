#!/bin/sh

set -ex

aws ssm send-command --instance-ids "i-002f991384327a0cb" --document-name "AWS-RunShellScript" --comment "TeamFemr2 deploy" --parameters commands=['sudo -u production /home/production/update.sh'] --output json

#cp -a git-teamfemr2-app/. teamfemr2-build-folder/

#ls teamfemr2-build-folder

#cd teamfemr2-build-folder && composer install
