FROM php:8.2.27-fpm

RUN apt update && \
    apt install -y \
    libzip-dev \
    wget \
    unzip \
    git && \
    pecl install apcu && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install zip && \
    docker-php-ext-enable apcu

COPY --from=composer:2.8.4 /usr/bin/composer /usr/local/bin/composer

WORKDIR /usr/src/api

COPY --chown=1000:1000 api /usr/src/api

RUN mkdir -p /.composer/cache && chown -R 1000:1000 /.composer

RUN PATH=$PATH:/usr/src/api/vendor/bin:bin

USER 1000:1000