FROM php:8.1-fpm as php

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data

RUN apt-get update -y
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev nginx 
RUN docker-php-ext-install pdo pdo_mysql bcmath curl 

WORKDIR /var/www

COPY --chown=www-data:www-data . .

COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

RUN chmod -R 755 /var/www/storage
RUN chmod -R 755 /var/www/bootstrap

ENTRYPOINT [ "docker/entrypoint.sh" ]