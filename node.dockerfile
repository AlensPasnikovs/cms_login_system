# Nodes
FROM node:alpine3.17 as node
WORKDIR /var/www
COPY . .
# Install Bash
RUN apk add --no-cache bash
COPY /docker/node_entrypoint.sh /node_entrypoint.sh
RUN chmod +x /node_entrypoint.sh

ENTRYPOINT [ "/node_entrypoint.sh" ]


