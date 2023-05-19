#!/bin/bash

echo "Current location: $(pwd)"

if [ ! "$(ls -A /var/www)" ]; then
  echo "EMPTY"
else
  ls -alh /var/www
fi

echo "Running npm install"

npm install --global cross-env
npm install
npm run build
chown -R 1000:1000 /var/www/