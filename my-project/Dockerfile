# Definir la imagen base
FROM php:7.4-fpm-alpine

# Instalar las dependencias necesarias
RUN apk add --no-cache \
    nginx \
    supervisor \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    postgresql-dev \
    zip \
    unzip \
    zlib-dev \
    && docker-php-ext-configure gd \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) \
    gd \
    mbstring \
    pdo \
    pdo_pgsql \
    pdo_mysql \
    xml \
    zip \
    && curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Definir el directorio de trabajo
WORKDIR /app

# Copiar los archivos del proyecto
COPY . /app

# Instalar las dependencias del proyecto
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Copiar la configuración de Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Copiar la configuración de Supervisor
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Definir los puertos que serán expuestos
EXPOSE 80

# Ejecutar los servicios de Nginx y PHP-FPM con Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
