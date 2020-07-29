FROM php:7-fpm-alpine
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
COPY ./php.ini /usr/local/etc/php/php.ini
RUN install-php-extensions gd mysqli opcache
