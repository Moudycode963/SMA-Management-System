FROM php:8.2-apache

# 1. System-Abhängigkeiten & PHP Extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite

# 2. Document Root anpassen
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. NEU: Composer installieren (Kopiert das Programm aus dem offiziellen Image) 🐳
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. (Optional aber sauber) Arbeitsverzeichnis setzen
WORKDIR /var/www/html