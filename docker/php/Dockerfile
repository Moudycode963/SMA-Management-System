FROM php:8.2-apache

# 1. System-Abhängigkeiten installieren und PHP-Erweiterungen aktivieren
# Als Fachinformatiker wissen wir: Standard-Images sind minimal.
# Wir brauchen pdo und pdo_mysql für die Datenbankverbindung.
RUN docker-php-ext-install pdo pdo_mysql mysqli

# 2. Apache Rewrite Module aktivieren
# Das ist zwingend nötig für sauberes Routing (z.B. /login statt index.php?page=login)
RUN a2enmod rewrite

# 3. Document Root auf /public ändern
# Sicherheits-Feature: Der Webserver soll NICHT auf /app oder /docker zugreifen können.
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf
/etc/apache2/conf-available/*.conf