FROM php:latest

# Copie des fichiers de ./srcs dans /var/www/html
COPY ./srcs /var/www/html

# Mise à jour et installation des packages requis
RUN apt-get update \
    && apt-get install -y apache2 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install mysqli pdo pdo_mysql

# Création des répertoires pour Apache et configuration des permissions
RUN mkdir -p /var/run/apache2 \
    && chown www-data:www-data /var/run/apache2

# Configuration des variables d'environnement d'Apache
ENV APACHE_RUN_DIR=/var/run/apache2 \
    APACHE_PID_FILE=/var/run/apache2/apache2.pid \
    APACHE_LOCK_DIR=/var/lock/apache2 \
    APACHE_LOG_DIR=/var/log/apache2

# Activation du module Rewrite d'Apache
RUN a2enmod rewrite

# Définition du nom du serveur dans la configuration Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copie de la configuration d'Apache
COPY ./srcs/config/apache-config.conf /etc/apache2/sites-available/000-default.conf

# Exposition du port 80
EXPOSE 80

# Commande de démarrage d'Apache
CMD ["/bin/bash", "-c", "source /etc/apache2/envvars && exec apache2 -D FOREGROUND"]