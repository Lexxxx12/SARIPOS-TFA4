FROM php:8.3-cli

RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
        default-mysql-server git libicu-dev libjpeg62-turbo-dev libonig-dev libpng-dev unzip \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install gd intl mbstring mysqli \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

COPY . .

RUN mkdir -p writable/cache writable/debugbar writable/logs writable/session writable/uploads \
    && chown -R www-data:www-data writable \
    && cp env .env \
    && chmod +x docker/start-render.sh

ENV CI_ENVIRONMENT=production
ENV PORT=10000

EXPOSE 10000

CMD ["docker/start-render.sh"]
