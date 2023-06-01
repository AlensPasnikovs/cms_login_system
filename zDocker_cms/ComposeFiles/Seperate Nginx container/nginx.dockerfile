FROM nginx:alpine as nginx
RUN apk add --no-cache bash
RUN adduser -D -u 1000 -G www-data www-data
WORKDIR /var/www/html
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx_entrypoint.sh /nginx_entrypoint.sh
ENTRYPOINT [ "/nginx_entrypoint.sh" ]
