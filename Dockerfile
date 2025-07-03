FROM php:8.2-apache

# Install ekstensi PHP Laravel
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer terbaru
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Aktifkan mod_rewrite Laravel
RUN a2enmod rewrite

# Copy semua file project Laravel
COPY . /var/www/html
WORKDIR /var/www/html

# Ganti root Apache ke /public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Ubah permission storage & bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Jalankan Laravel + Apache
CMD php artisan config:cache && apache2-foreground
