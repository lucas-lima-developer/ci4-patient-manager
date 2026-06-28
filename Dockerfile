FROM php:8.2-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
        libicu-dev \
        libonig-dev \
        zip \
        unzip \
    && docker-php-ext-install intl mbstring mysqli pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia manifests primeiro para aproveitar cache de camadas
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

COPY . .

# Aponta DocumentRoot para /public e habilita .htaccess
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' \
        /etc/apache2/sites-available/000-default.conf \
    && printf '<Directory /var/www/html/public>\n\tAllowOverride All\n\tRequire all granted\n</Directory>\n' \
        >> /etc/apache2/apache2.conf

RUN chown -R www-data:www-data /var/www/html/writable

EXPOSE 80
