FROM php:7.2-fpm

# Update system and install required packages
ENV DEBIAN_FRONTEND noninteractive

# Common tools
RUN \
    apt-get -y update && \
    apt-get -y install curl cron git telnet vim autoconf file build-essential pkg-config re2c wget ca-certificates supervisor apt-transport-https software-properties-common gnupg2

# PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
        libicu-dev \
        libzip-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libwebp-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
        --with-png-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# PECL extensions
RUN \
    pecl install zip && \
    docker-php-ext-enable zip && \
    pecl install redis && \
    docker-php-ext-enable redis  && \
    pecl install igbinary && \
    docker-php-ext-enable igbinary

# Composer
RUN curl -sS https://getcomposer.org/installer | /usr/local/bin/php -- --install-dir=/usr/local/bin --filename=composer

ADD ./ /var/www

WORKDIR /var/www

RUN chown -R www-data:www-data var/
RUN composer -n --no-ansi install

EXPOSE 80
