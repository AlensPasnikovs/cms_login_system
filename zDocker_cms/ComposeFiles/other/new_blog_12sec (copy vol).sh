#!/bin/bash
# bash new_blog.sh name

# Set the name from the first argument
name=$1

# Restore the MySQL volume
docker run --rm \
  -v mysql_db_data:/from \
  -v ${name}_db_data:/to \
  alpine \
  sh -c "cd /from && tar -cf - . | tar -xf - -C /to"

# Restore the PHP volume
docker run --rm \
  -v php_user_data:/from \
  -v ${name}_user_data:/to \
  alpine \
  sh -c "cd /from && tar -cf - . | tar -xf - -C /to"



# Start the project
docker-compose -p $name up -d
