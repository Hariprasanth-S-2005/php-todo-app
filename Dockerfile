FROM php:8.2-fpm

# Install nginx and mysqli
RUN apt-get update && apt-get install -y nginx \
    && docker-php-ext-install mysqli \
    && rm -rf /var/lib/apt/lists/*

# Copy app
COPY app/ /var/www/html

# Copy nginx config
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

CMD service nginx start && php-fpm
