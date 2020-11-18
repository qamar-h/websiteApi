FROM php:7.4-apache

MAINTAINER Qamar HAYAT

RUN apt-get update && apt-get upgrade -y && apt-get install -y \
      procps \
      nano \
      git \
      unzip \
      libicu-dev \
      zlib1g-dev \
      libxml2 \
      libxml2-dev \
      libreadline-dev \
      supervisor \
      cron \
      libzip-dev \
      librabbitmq-dev \
    && pecl install amqp \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
      pdo_mysql \
      sockets \
      intl \
      opcache \
      zip \
    && docker-php-ext-enable amqp \
    && rm -rf /tmp/* \
    && rm -rf /var/list/apt/* \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get clean

    WORKDIR /var/www/html

COPY . .
RUN rm .env
RUN rm config/jwt/*

RUN chmod -R 777 var/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite remoteip && \
    a2enconf

EXPOSE 80



