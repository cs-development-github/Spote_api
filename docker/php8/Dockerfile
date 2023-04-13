FROM php:8.1-fpm-buster

ARG TIMEZONE

COPY php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

RUN apt-get update && apt-get install -y --no-install-recommends \
    locales  \
    apt-utils \
    gnupg \
    gnupg2 \
    g++ \
    procps \
    openssl \
    git \
    unzip \
    zlib1g-dev \
    libzip-dev \
    libfreetype6-dev \
    libpng-dev \
    libjpeg-dev \
    libicu-dev  \
    libonig-dev \
    libpq-dev \
    libxslt-dev \
    libxml2-dev \
    wget \
    curl \
    acl \
    locate \
    ksh  \
    zip \
    nano \
    vim \
    locate \
    && echo 'alias ll="ls -all"' >> ~/.bashrc \
    && echo 'alias sf="php bin/console"' >> ~/.bashrc \
    && echo 'alias pstan="vendor/bin/phpstan analyse"' >> ~/.bashrc

RUN wget https://pear.php.net/go-pear.phar
RUN php go-pear.phar

# Removing /var/lib/apt/lists worked
RUN rm -rf /var/lib/apt/lists/* && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
&& apt-get install nodejs -y

RUN docker-php-ext-configure intl

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql opcache intl zip calendar dom mbstring zip gd xsl

# Set timezone
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen

RUN curl -sS https://get.symfony.com/cli/installer | bash \
    &&  mv /root/.symfony5/bin/symfony /usr/local/bin

WORKDIR /opt/symfo

# install composer
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    composer require phpunit/phpunit --no-progress --no-scripts --no-interaction && \
    composer self-update 2.3.10


RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

ENV PATH /root/.composer/vendor/bin:$PATH
CMD php-fpm

EXPOSE 9000