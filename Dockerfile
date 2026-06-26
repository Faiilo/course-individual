FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    sqlite3 \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN a2enmod rewrite

WORKDIR /var/www/html

# Копируем ВСЕ файлы ДО composer install
COPY . .

RUN composer install --no-interaction --prefer-source

# ОЧИЩАЕМ КЕШ
RUN php artisan config:clear && \
    php artisan cache:clear && \
    php artisan view:clear && \
    php artisan route:clear

# СОЗДАЁМ ССЫЛКУ STORAGE
RUN php artisan storage:link

# МЕНЯЕМ ПРАВА ТОЛЬКО НА НУЖНЫЕ ПАПКИ (НЕ НА ВЕСЬ ПРОЕКТ!)
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/database \
    && chown -R www-data:www-data /var/www/html/public/storage \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/database \
    && chmod -R 755 /var/www/html/public/storage

# Настраиваем Apache
RUN echo '<VirtualHost *:80>' > /etc/apache2/sites-available/000-default.conf && \
    echo '    DocumentRoot /var/www/html/public' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    <Directory /var/www/html/public>' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        Options Indexes FollowSymLinks' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        AllowOverride All' >> /etc/apache2/sites-available/000-default.conf && \
    echo '        Require all granted' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    </Directory>' >> /etc/apache2/sites-available/000-default.conf && \
    echo '</VirtualHost>' >> /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]