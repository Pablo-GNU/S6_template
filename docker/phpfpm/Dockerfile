FROM php:8.1-fpm

RUN apt-get update && \
    apt-get --no-install-recommends install -y \
        libevent-dev \
        libxml2-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libcurl4-openssl-dev \
        libzip-dev \
        libssl-dev \
        libicu-dev \
        git \
        openssl \
        zlib1g-dev \
        wget  \
        libc-client-dev \
        libmagickwand-dev \
        unzip \
        libonig-dev \
        jq \
        build-essential

RUN docker-php-ext-install curl iconv mbstring mysqli pdo pdo_mysql zip sockets opcache
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-configure bcmath
RUN docker-php-ext-install bcmath
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN pecl install imagick
RUN pecl install apcu
RUN docker-php-ext-enable opcache imagick apcu
RUN pecl install raphf && docker-php-ext-enable raphf
RUN pecl install pecl_http && docker-php-ext-enable http

RUN apt-get clean && apt-get autoremove -y
RUN rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN chmod +x /usr/local/bin/composer

RUN usermod -u 1000 www-data -s /bin/bash -G sudo -d /home/data/
RUN groupmod -g 1000 www-data
RUN mkdir -p /home/data/data
RUN chown -R www-data:www-data /home/data/
RUN chown -R www-data:www-data /home/data/*
RUN chmod -R ug+s /home/data/*

WORKDIR /home/data/data

USER 1000