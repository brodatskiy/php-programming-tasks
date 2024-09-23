FROM php:8-fpm

WORKDIR /var/www/project

RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
            curl \
            libpq-dev; \
    rm -rf /var/lib/apt/lists/*


RUN set -eux; \
    docker-php-ext-install pgsql; \
    docker-php-ext-install pdo_pgsql


RUN set -eux; \
    # Install the PHP xdebug extension
    pecl install xdebug

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY /php/conf.d /usr/local/etc/php/conf.d/