# Étape 1: Image de base PHP avec Apache
FROM php:8.2.12-apache

# Étape 2: Installer les dépendances système requises
RUN apt-get update && apt-get install -y libicu-dev libpng-dev libjpeg-dev libfreetype6-dev

# Étape 3: Installation des extensions PHP requises
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo_mysql ctype iconv intl gd

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Étape 4: Installation des dépendances de développement
RUN apt-get update && apt-get install -y git zip unzip

# Copy Apache configuration file to container
COPY apache.conf /etc/apache2/sites-available/000-default.conf
# Étape 5: Configuration Apache
RUN a2enmod rewrite

# Étape 6: Définir le répertoire de travail dans le conteneur
WORKDIR /var/www

# Étape 7: Copier le code source Symfony dans le conteneur
COPY . /var/www

# Étape 9: Installer les dépendances avec Composer
RUN composer install --no-interaction --optimize-autoloader

# Étape 10: Donner les droits appropriés aux dossiers cache et logs
RUN chown -R www-data:www-data /var/www/var/cache /var/www/var/log
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www

# Étape 11: Exposer le port 80 pour Apache
EXPOSE 80

# Étape 12: Commande par défaut pour démarrer Apache
CMD ["apache2-foreground"]