FROM php:8.0-cli

RUN useradd -m --uid 1000 --gid 50 docker

COPY . /var/www/html
WORKDIR /var/www/html

RUN chown -R docker /var/www/html

#global install of composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Get dependencies
USER docker
RUN composer install --working-dir=/var/www/html
