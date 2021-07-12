FROM php:8.0.8-cli-alpine

RUN docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install pcntl

COPY . /app

WORKDIR /app

CMD ["php", "./index.php"]
