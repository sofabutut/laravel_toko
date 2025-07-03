#!/bin/bash

# Set permission biar Laravel bisa nulis ke log
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Jalankan cache dan migrasi
php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan migrate --force

# Jalankan PHP server (opsional bisa ganti php-fpm tergantung image)
php-fpm
