FROM php:fpm-alpine

RUN docker-php-ext-install mysqli pdo pdo_mysql

#if you need gd and soap uncomment these two line.
#RUN apk add zlib-dev libpng-dev libxml2 libxml2-dev
#RUN docker-php-ext-install gd soap

COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

COPY --from=keymetrics/pm2:latest-alpine /usr/ /usr/