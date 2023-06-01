#!/bin/bash
# bash optimize.sh

## Save container to image

docker commit sag_php php_saved1
docker commit sag_database mysql_saved1

## SAVE MYSQL VOLUME

docker run -d --rm -v sag_db_data:/data -v $(pwd):/backup alpine tar -czvf /backup/mysql_vol.tar.gz -C /data .

## SAVE PHP VOLUME

docker run -d --rm -v sag_user_data:/data -v $(pwd):/backup alpine tar -czvf /backup/php_vol.tar.gz -C /data .

# <!-- ## SAVE NODE VOLUME

# docker run -d --rm -v node_modules_cms:/data -v $(pwd):/backup alpine tar -czvf /backup/node_modules_vol.tar.gz -C /data . -->






