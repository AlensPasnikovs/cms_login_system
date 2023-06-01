#!/bin/bash

echo "Current location: $(pwd)"

if [ ! "$(ls -A /var/www/html)" ]; then
  echo "EMPTY"
else
  ls -alh /var/www/html
fi

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
   echo "Creating .env file $APP_ENV"
   cp .env.example .env
else
   echo "Using existing .env file"
fi

role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then
   php artisan config:clear
   php artisan cache:clear
   php artisan key:generate
   php artisan route:clear
   php artisan view:clear
   # if [ ! -d "storage/app/public" ]; then
   #    php artisan storage:link
   # fi
   php artisan storage:link

   chown -R www-data:www-data /var/www/html

   while ! php artisan migrate; do
      echo "Migration failed - retrying in 3 seconds..."
      sleep 3
   done
   # php artisan serve --port=$PORT --host=0.0.0.0 --env=.env
   # exec docker-php-entrypoint "$@" 
fi

php-fpm -F