FROM php:8.2-apache

## for database
RUN docker-php-ext-install pdo pdo_mysql

## rewrite url for routing
RUN a2enmod rewrite

## put apache conf to container
COPY docker/app/apache.conf /etc/apache2/sites-available/000-default.conf


