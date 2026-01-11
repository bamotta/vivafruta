# Usa PHP 8.2 con Apache
FROM php:8.2-apache

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Copia el código al contenedor
COPY . /var/www/html

# Establece directorio de trabajo
WORKDIR /var/www/html

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Ajusta permisos para storage y bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expone el puerto 10000 (Render detecta el contenedor)
EXPOSE 10000

# Ejecuta Apache en primer plano
CMD ["apache2-foreground"]
