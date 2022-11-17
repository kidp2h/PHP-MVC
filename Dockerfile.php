FROM php:apache
RUN apt-get update -y && apt-get upgrade -y && apt-get install git libzip-dev zip unzip -y 
RUN docker-php-ext-install mysqli  && docker-php-ext-enable mysqli && docker-php-ext-install zip
RUN a2enmod rewrite
COPY src .env ./
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1


