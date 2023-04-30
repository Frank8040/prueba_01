FROM php:7.4-apache
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite
EXPOSE 80
ENTRYPOINT ["apache2ctl", "-D", "FOREGROUND"]
