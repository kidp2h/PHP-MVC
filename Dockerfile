FROM php:apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get -o Acquire::Check-Valid-Until=false update
RUN apt-get install -q -y ssmtp mailutils
RUN a2enmod rewrite



