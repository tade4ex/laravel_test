FROM node:18.15 AS node
FROM php:8.2-fpm

# Install node to container
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# Install required libs
RUN apt-get update && apt-get install -y libzip-dev unzip python3 libpng-dev mariadb-client supervisor

# Install php extensions
RUN docker-php-ext-install pdo_mysql bcmath zip gd opcache

# Custom configurations
COPY ./templates/php.conf /usr/local/etc/php-fpm.d/zzz-custom.conf
COPY ./templates/memory-limit.ini /usr/local/etc/php/conf.d/memory-limit.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/local/bin

# Supervisor
COPY ./templates/supervisord.conf /etc/supervisor/supervisord.conf
RUN mkdir -p "/etc/supervisor/logs"

# Change workdir
WORKDIR /srv/www

CMD ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisor/supervisord.conf"]