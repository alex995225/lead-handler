FROM php:7.4-cli

RUN docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install pcntl

COPY . /app

WORKDIR /app

CMD ["php", "./index.php"]
