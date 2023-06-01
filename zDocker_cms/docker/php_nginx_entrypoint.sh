#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

php artisan config:clear
php artisan cache:clear
php artisan key:generate
php artisan route:clear
php artisan view:clear
php artisan storage:link

chown -R www-data:www-data /var/www/html

while ! php artisan migrate; do
   echo "Migration failed - retrying in 1 second..."
   sleep 1
done

sed "s/SUBDOMAIN/$SUBDOMAIN/g" /nginx.conf.template > /etc/nginx/nginx.conf

php-fpm -D
nginx -g "daemon off;"

