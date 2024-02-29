FROM php:8.2-apache

ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy files from ./srcs into /var/www/html
COPY . /var/www/html

# Update and install required packages
RUN apt-get update -qq && \
    apt-get install -qy \
    git \
    gnupg \
    unzip \
    zip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-install -j$(nproc) opcache pdo_mysql

# Enable Apache mod_rewrite module
RUN a2enmod rewrite

# Create directories for Apache and set permissions
RUN mkdir -p /var/run/apache2 \
    && chown www-data:www-data /var/run/apache2

# Set Apache environment variables
ENV APACHE_RUN_DIR=/var/run/apache2 \
    APACHE_PID_FILE=/var/run/apache2/apache2.pid \
    APACHE_LOCK_DIR=/var/lock/apache2 \
    APACHE_LOG_DIR=/var/log/apache2

# Define the server name in the Apache configuration
RUN echo "Servername localhost" >> /etc/apache2/apache2.conf

# Copy the Apache && Postfix configurations
COPY ./config/apache-config.conf /etc/apache2/sites-available/000-default.conf

# Expose port  80
EXPOSE  80

# Start Apache in the foreground
CMD ["/bin/bash", "-c", "source /etc/apache2/envvars && exec apache2 -D FOREGROUND"]