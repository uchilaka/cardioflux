#!/bin/bash
if [[ -z "$1" ]]; then 
   COMMIT_MSG="Just chugging along..."
else
   COMMIT_MSG="$1"
fi
git add .
git commit -m "$COMMIT_MSG"
git push origin marcel
