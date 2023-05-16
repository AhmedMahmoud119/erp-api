#!/bin/bash
set -e

CURR=$(git branch --show-current)
RED='\033[0;31m'
WHITE='\033[0;37m'
YELLOW='\033[0;33m'
MESSAGE=$@

if [ -t 1 ]; then
  exec < /dev/tty
fi

if [[ ! $CURR =~ ^(develop|master|(release|hotfix)\/v[0-9](.[0-9]){1,})$ ]] && [[ ! $MESSAGE =~ ^ERP-[0-9]+[[:space:]]\|[[:space:]](feat|fix|test|docs|chore|ci):[[:space:]](.*)$ ]]; then
    echo -e ${RED}
    echo "The commit message is not in the expected format!"
    echo -e "${RED}Expected Format: ${YELLOW}ERP-100 | feat: New exciting feature"
    echo -e "${RED}Allowed types are: ${YELLOW}feat|fix|test|docs|chore|ci"
    echo -e "${WHITE}"
    exit 1
fi
