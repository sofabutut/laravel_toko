#!/bin/bash

# Install dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Set permission
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Generate key kalau belum ada
if [ ! -f .env ]; then
  cp .env.example .env
fi

# Cache dan migrate
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

# Delay sebentar sebelum start
sleep 5

# Jalankan Laravel di port 3000 (harus ini)
php artisan serve --host=0.0.0.0 --port=3000
