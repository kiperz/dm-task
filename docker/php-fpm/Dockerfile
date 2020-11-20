FROM php:7.4-fpm-alpine

ARG PROJECT_NAME

RUN apk add --no-cache --virtual build-dependencies autoconf gcc make g++ zlib-dev icu-dev libxml2-dev unzip libzip-dev curl-dev \
    && apk add --no-cache icu-libs libzip libcurl \
    && docker-php-ext-install intl pdo pdo_mysql mysqli curl zip xml bcmath opcache \
    && apk del --purge autoconf g++ make gcc build-dependencies

RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.memory_consumption=256" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.interned_strings_buffer=16" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.max_accelerated_files=50000" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.enable_cli=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.validate_timestamps=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.max_wasted_percentage=10" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.log_verbosity_level=0" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.optimization_level=0xFFFFFFEF" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

# Set timezone
RUN ln -sf /usr/share/zoneinfo/Europe/Warsaw /etc/localtime \
    && echo "Europe/Warsaw" > /etc/timezone
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www
COPY ./$PROJECT_NAME/composer.json /var/www
COPY ./$PROJECT_NAME/.env /var/www
RUN composer install
RUN rm -rf ./var && mkdir ./var ./var/cache ./var/files ./var/session ./var/tmp && chmod -R 777 ./var && chown -R www-data:www-data ./var
WORKDIR /var/www/public
