#!/bin/bash

# Install dependencies Laravel
composer install --no-interaction --prefer-dist --optimize-autoloader

# Set permission agar bisa nulis log dll
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Cache config dan route
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan migrate
php artisan migrate --force

# Jalankan Laravel built-in server
php artisan serve --host=0.0.0.0 --port=3000
