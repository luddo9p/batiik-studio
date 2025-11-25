FROM php:7.4-apache
COPY ./build/wordpress/ /var/www/html/
RUN a2enmod rewrite

# Installation des extensions mysqli et pdo_mysql pour PHP
RUN docker-php-ext-install mysqli pdo_mysql

RUN chown -R www-data:www-data /var/www/html
