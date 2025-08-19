#!/usr/bin/env bash

# Une partie du dockerfile et entrypoint.sh ont été générés par IA, il s'agit du seul endroit ou l'IA a été utilisée.
set -e

cd /var/www/html

# .env
if [ ! -f ".env" ]; then
  cp .env.example .env || true
fi

if ! grep -q "APP_KEY=" .env || [ -z "$(grep APP_KEY= .env | cut -d= -f2)" ]; then
    echo ">> Génération APP_KEY"
    php artisan key:generate --force
fi

# SQLite file
if [ ! -f "$DB_DATABASE" ]; then
  mkdir -p "$(dirname "$DB_DATABASE")"
  touch "$DB_DATABASE"
  chown www-data:www-data "$DB_DATABASE"
fi
npm i
npm run build
# Cache config (optionnel)
php artisan config:cache || true
php artisan route:cache || true

# Migrate / Seed selon flags
if [ "$MIGRATE_ON_BOOT" = "true" ]; then
  php artisan migrate --force --no-interaction || true
fi

if [ "$SEED_ON_BOOT" = "true" ]; then
  php artisan db:seed --force --no-interaction || true
fi

# Lancer Apache
exec apache2-foreground
