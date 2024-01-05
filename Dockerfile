FROM php:8.2

RUN set -xe && \
    apt-get update && \
    apt-get install -y \
    sqlite3 \
    zip && \
    docker-php-ext-install \
    pdo_sqlite \
    sqlite3 && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
