FROM php:7.4-cli

RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        zip

RUN docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install zip

WORKDIR /app
COPY . .

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
RUN chmod 0755 /usr/bin/composer

CMD ["php", "./index.php"]
