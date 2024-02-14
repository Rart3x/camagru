FROM php:latest

COPY ./srcs /usr/share/nginx/html

RUN apt-get update \
    && apt-get install -y apache2 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN mkdir -p /var/run/apache2
RUN chown www-data:www-data /var/run/apache2

ENV APACHE_RUN_DIR=/var/run/apache2 \
    APACHE_PID_FILE=/var/run/apache2/apache2.pid \
    APACHE_LOCK_DIR=/var/lock/apache2 \
    APACHE_LOG_DIR=/var/log/apache2

RUN a2enmod rewrite

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
COPY ./srcs/config/apache-config.conf /etc/apache2/sites-available/000-default.conf

EXPOSE  80

CMD ["/bin/bash", "-c", "source /etc/apache2/envvars && exec apache2 -D FOREGROUND"]