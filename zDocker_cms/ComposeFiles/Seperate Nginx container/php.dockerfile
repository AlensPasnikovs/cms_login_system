FROM php:8.1.12-fpm-alpine as php

ENV PHP_OPCACHE_ENABLE=0
ENV PHP_OPCACHE_ENABLE_CLI=0
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS=0
ENV PHP_OPCACHE_REVALIDATE_FREQ=0

RUN apk update \
    && apk add bash unzip git libcurl shadow \
    && docker-php-ext-install pdo pdo_mysql bcmath 

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data

RUN git clone https://github.com/AlensPasnikovs/tinymce_cms.git /var/www/html

WORKDIR /var/www/html

COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

COPY .env .

COPY docker/php_entrypoint.sh /php_entrypoint.sh

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN chown -R www-data:www-data /var/www
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 755 /var/www/html/storage
RUN chmod -R 755 /var/www/html/bootstrap

ENV PORT=8000

ENTRYPOINT [ "/php_entrypoint.sh" ]