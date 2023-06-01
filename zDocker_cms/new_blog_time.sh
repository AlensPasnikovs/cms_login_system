#!/bin/bash
# bash new_blog.sh name

# Start the timer
start_time=$(date +%s)

# Set the name from the first argument
name=$1

# Restore the MySQL volume
docker run -d --rm -v ${name}_db_data:/data -v $(pwd):/backup alpine tar -xzvf /backup/mysql_vol.tar.gz -C /data

# Restore the PHP volume
docker run -d --rm -v ${name}_user_data:/data -v $(pwd):/backup alpine tar -xzvf /backup/php_vol.tar.gz -C /data

# Start the project
docker-compose -p $name -f docker-compose-saved.yml up -d

# Wait for the website to load
while [[ "$(curl -s -o /dev/null -w "%{http_code}" http://${name}.prakse.localhost/)" == "502" ]]; do sleep 0.5; done

# Stop the timer
end_time=$(date +%s)

# Calculate the time it took for the website to load
elapsed_time=$((end_time - start_time))

echo "Projekta mājaslapas startēšanās ātrums ir $elapsed_time sekundes."

# Print the contents of the website
curl http://${name}.prakse.localhost/