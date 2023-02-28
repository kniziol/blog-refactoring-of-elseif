FROM php:8.2-cli-alpine
MAINTAINER Krzysztof Nizioł

RUN apk add --update linux-headers \
    && apk add --no-cache $PHPIZE_DEPS \
    && pecl install \
        xdebug \
    && docker-php-ext-enable \
        xdebug
