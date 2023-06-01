#!/bin/bash

echo "Running npm install"
npm install --global cross-env
npm install
npm run build
chown -R 1000:1000 /var/www/html

