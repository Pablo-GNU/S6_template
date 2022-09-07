FROM nginx:1.18.0

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data \
    && mkdir -p /home/data/data \
    && chown -R www-data:www-data /home/data/data

COPY nginx.conf /etc/nginx/
COPY default.conf /etc/nginx/conf.d/