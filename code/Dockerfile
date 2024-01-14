FROM php:8.2-apache
COPY . /var/www/html/
WORKDIR /var/www/html/
COPY php.ini /usr/local/etc/php/php.ini
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli