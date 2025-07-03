FROM laravelsail/php82-composer:latest

RUN apt-get update && apt-get install -y apache2 libapache2-mod-php libpng-dev zip unzip git \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN a2enmod rewrite

COPY . /var/www/html
WORKDIR /var/www/html

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

RUN chmod -R 775 storage bootstrap/cache

CMD php artisan config:cache && apache2ctl -D FOREGROUND
