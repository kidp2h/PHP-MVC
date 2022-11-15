FROM php:apache
RUN apt-get update -y && apt-get upgrade -y && apt-get install git -y
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN a2enmod rewrite
COPY ./src/composer.json .
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install


