FROM php:8.2-fpm

LABEL version="3.1"

ARG UID

# Create user and some useful stuff
RUN adduser -u ${UID} --disabled-password --gecos "" appuser
RUN mkdir /home/appuser/.ssh
RUN chown -R appuser:appuser /home/appuser/
RUN echo "StrictHostKeyChecking no" >> /home/appuser/.ssh/config
RUN echo "export COLUMNS=300" >> /home/appuser/.bashrc
RUN echo "alias sf=/appdata/www/bin/console" >> /home/appuser/.bashrc

# Install packages and PHP extensions

RUN apt-get update && \
    apt-get install -y libssl-dev zlib1g-dev curl git unzip netcat libxml2-dev libssh-dev libpq-dev libzip-dev && \
    apt-get install -y openssl openssh-client wget vim librabbitmq-dev && \
    pecl install apcu && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install -j$(nproc) zip opcache intl pdo_pgsql pgsql bcmath sockets && \
    docker-php-ext-enable apcu pdo_pgsql sodium bcmath sockets && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
RUN docker-php-ext-install sockets
RUN docker-php-ext-enable sockets

# Install supervisord
RUN apt-get update && apt-get install -y supervisor

# Install Symfony binary
RUN wget https://get.symfony.com/cli/installer -O - | bash

# Install and update composer
RUN curl https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer
RUN composer self-update

# Install PHP-CS-FIXER
RUN wget https://cs.symfony.com/download/php-cs-fixer-v2.phar -O php-cs-fixer
RUN chmod a+x php-cs-fixer
RUN mv php-cs-fixer /usr/local/bin/php-cs-fixer

# Set working directory
RUN mkdir -p /appdata/www
WORKDIR /appdata/www

# Set configuration files for supervisor
RUN echo "[include]\nfiles = /appdata/www/build/supervisor/*.conf" >> /etc/supervisor/supervisord.conf