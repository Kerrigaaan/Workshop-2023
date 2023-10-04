FROM alpine:latest
LABEL maintainer="EPSI students - Group 9"
LABEL description="Alpine based image with apache2 and php8.2"

WORKDIR /server

# Change time to UTC+1
ENV TZ=Europe/Paris
RUN apk add --no-cache tzdata
RUN ln -sf /usr/share/zoneinfo/Europe/Paris /etc/localtime

# Installing bash
RUN apk --no-cache add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

# Installing curl
RUN apk --no-cache add curl

# Installing PHP 8.2
RUN apk --no-cache add php82 \
    php82-common \
    php82-cli \
    php82-fpm \
    php82-pdo \
    php82-opcache \
    php82-zip \
    php82-phar \
    php82-iconv \
    php82-curl \
    php82-openssl \
    php82-mbstring \
    php82-tokenizer \
    php82-fileinfo \
    php82-json \
    php82-xml \
    php82-xmlwriter \
    php82-simplexml \
    php82-dom \
    php82-pdo_mysql \
    php82-ctype \
    php82-session

RUN ln -s /usr/bin/php82 /usr/bin/php

# Installing composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

# Installing Apache2
RUN apk --no-cache add apache2 \
    libxml2-dev \
    apache2-utils

# Configure FPM
RUN mkdir -p /run/php/
RUN touch /run/php/php8.2-fpm.id
COPY .docker/php/php-fpm.conf /etc/php82/php-fpm.conf
COPY .docker/php/php.ini-development /etc/php82/php.ini

# Configure Apache2
RUN mkdir -p /etc/apache2/sites-available/
COPY .docker/apache2/fuzhana.conf /etc/apache2/sites-available/fuzhana.conf

# Configure supervisor
RUN mkdir -p /etc/supervisor.d/
COPY .docker/supervisord.ini /etc/supervisor.d/supervisord.ini

EXPOSE 80 443
CMD ["httpd", "-D", "FOREGROUND"]