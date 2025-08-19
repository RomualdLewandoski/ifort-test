# Une partie du dockerfile et entrypoint.sh ont été générés par IA, il s'agit du seul endroit ou l'IA a été utilisée.

# --- Étape 1 : build des assets ---
FROM node:22 AS build
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# --- Étape 2 : runtime PHP + Apache ---
FROM php:8.2-apache

# OS deps pour extensions PHP
RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libsqlite3-dev \
 && docker-php-ext-configure gd --with-jpeg --with-freetype \
 && docker-php-ext-install pdo pdo_sqlite zip gd bcmath \
 && rm -rf /var/lib/apt/lists/*

COPY --from=node:22 /usr/local/ /usr/local/

RUN a2enmod rewrite
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf /etc/apache2/apache2.conf && \
    sed -ri 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .
COPY --from=build /app/public /var/www/html/public
RUN git config --global --add safe.directory /var/www/html

# Install deps PHP
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --prefer-dist --optimize-autoloader --no-interaction

RUN if [ ! -f .env ]; then cp .env.example .env || true; fi \
 && php artisan key:generate --force || true \
 && php artisan lang:add fr || true \
 && php artisan config:cache || true \
 && php artisan route:cache || true

RUN chown -R www-data:www-data storage bootstrap/cache

# Variables d'env par défaut
ENV APP_ENV=local \
    APP_DEBUG=1 \
    DB_CONNECTION=sqlite \
    DB_DATABASE=/var/www/html/database/database.sqlite \
    SEED_ON_BOOT=false \
    MIGRATE_ON_BOOT=true \
    APACHE_DOCUMENT_ROOT=/var/www/html/public

# Entrypoint: init DB + migrate/seed puis Apache
COPY docker/entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80
CMD ["docker-entrypoint.sh"]
