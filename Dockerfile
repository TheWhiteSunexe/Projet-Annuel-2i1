FROM php:8.2-apache

RUN apt-get update && apt-get install -y xinetd \
    && docker-php-ext-install pdo pdo_mysql mysqli

WORKDIR /var/www/html/Projet-Annuel-2i1/PA2i1

RUN a2enmod rewrite

CMD service apache2 start && xinetd -stayalive -f /etc/xinetd.conf && tail -f /dev/null
