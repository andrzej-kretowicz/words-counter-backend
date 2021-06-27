FROM php:8.0-fpm
RUN apt-get update && docker-php-ext-install pdo_mysql && apt-get install -y git-core zip unzip
RUN apt-get update -y && apt-get install -y sendmail libpng-dev libzip-dev libonig-dev

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev \
        supervisor
RUN docker-php-ext-install mbstring

RUN docker-php-ext-install zip

RUN docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php; mv composer.phar /usr/local/bin/composer

USER www-data


