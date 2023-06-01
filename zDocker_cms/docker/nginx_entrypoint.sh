#!/bin/bash
# chown -R 1000:1000 /var/log/nginx

sed -i "s/SUBDOMAIN/$SUBDOMAIN/g" /etc/nginx/nginx.conf
exec "$@"
nginx -g "daemon off;"