#!/bin/bash
# bash regular.sh name

# Change the current working directory to the script's directory
cd "$(dirname "$0")"

# Set the name from the first argument
name=$1

# Start the project
docker-compose -p $name up -d