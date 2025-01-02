FROM dunglas/frankenphp

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    libxpm-dev \
    libvpx-dev \
    nodejs \
    npm \
    libzip-dev

RUN install-php-extensions \
    zip \
    pdo \
    pdo_mysql \
    pcntl \
    gd

COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /app

# Copiar archivos del proyecto
COPY . .

# Configurar permisos para Laravel
RUN chown -R www-data:www-data /app \
    && chmod -R 775 /app/storage \
    && chmod -R 775 /app/bootstrap/cache

# Instalar dependencias de PHP y Node.js
RUN composer install --no-dev --prefer-dist \
    && npm install \
    && npm run build

RUN php artisan octane:install --server=frankenphp \
    && php artisan optimize

# Comando para iniciar Laravel Octane con FrankenPHP
CMD ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=8080"]
