#!/bin/bash
if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env.example .env
else
    echo "env file exists."
fi

php artisan config:clear
php artisan cache:clear
php artisan key:generate
php artisan route:clear
php artisan view:clear
php artisan storage:link
while ! php artisan migrate; do
   echo "Migration failed - retrying in 3 seconds..."
   sleep 3
done

chown -R 1000:1000 /var/www/

php-fpm -D
nginx -g "daemon off;"

