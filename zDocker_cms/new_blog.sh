#!/bin/bash
# bash new_blog.sh name

# Change the current working directory to the script's directory
cd "$(dirname "$0")"

# Set the name from the first argument
name=$1

# Restore the MySQL volume
docker run -d --rm -v ${name}_db_data:/data -v $(pwd):/backup alpine tar -xzvf /backup/mysql_vol.tar.gz -C /data

# Restore the PHP volume
docker run -d --rm -v ${name}_user_data:/data -v $(pwd):/backup alpine tar -xzvf /backup/php_vol.tar.gz -C /data

# Start the project
docker-compose -p $name -f docker-compose-saved.yml up -d



