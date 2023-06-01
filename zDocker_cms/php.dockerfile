FROM php:8.1.12-fpm-alpine as php

RUN apk update \
    && apk add bash unzip git libcurl shadow nginx \
    && docker-php-ext-install pdo pdo_mysql bcmath

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data

RUN git clone https://github.com/AlensPasnikovs/cms_blog_system.git /var/www/html

WORKDIR /var/www/html

COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/nginx/nginx.conf.template /

COPY .env .

COPY docker/php_nginx_entrypoint.sh /php_nginx_entrypoint.sh

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN chown -R www-data:www-data /var/www
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 755 /var/www/html/storage
RUN chmod -R 755 /var/www/html/bootstrap

ENTRYPOINT [ "/php_nginx_entrypoint.sh" ]