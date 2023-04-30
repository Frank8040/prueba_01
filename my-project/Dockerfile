FROM render/php:8-nginx

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN docker-php-ext-install pdo pdo_mysql
RUN rm /etc/nginx/sites-enabled/default
COPY nginx.conf /etc/nginx/sites-enabled/default

EXPOSE 8080

ENTRYPOINT ["php-fpm", "-F"]
