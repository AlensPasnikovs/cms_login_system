FROM php:8.1.15-fpm-alpine3.17

# Install dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    bash \
    curl \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

# Configure PHP
COPY php.ini /usr/local/etc/php/conf.d/

# Configure Nginx
COPY default.conf /etc/nginx/conf.d/default.conf

# Copy project files
COPY . /var/www

# Set working directory
WORKDIR /var/www

# Install Laravel dependencies
RUN curl -sS https://getcomposer.org/installer | php \
    && php composer.phar install \
    && php composer.phar dump-autoload -o

# Expose port 80
EXPOSE 80

RUN mkdir -p /var/lib/mysql
RUN mkdir -p /var/www/storage/app/public/photos/posts
# Mount a volume for the MySQL data and the post photos
VOLUME ["/var/lib/mysql", "/var/www/storage/app/public/photos/posts"]

# Start Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]