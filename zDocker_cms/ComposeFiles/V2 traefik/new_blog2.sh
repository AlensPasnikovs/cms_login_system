#!/bin/bash
# bash new_blog2.sh name

# Set the name from the first argument
name=$1

# Restore the MySQL volume
docker run -d --rm -v ${name}_db_data:/data -v $(pwd):/backup alpine tar -xzvf /backup/mysql_v2_vol.tar.gz -C /data

# Restore the PHP volume
docker run -d --rm -v ${name}_user_data:/data -v $(pwd):/backup alpine tar -xzvf /backup/php_v2_vol.tar.gz -C /data

# Start the project
docker-compose -f compose_saved_traefik.yml -p $name up -d