FROM php:7.4.1-fpm-alpine3.11
RUN apk add --no-cache openssl \
                        bash \
                        mysql-client \
                        wget \
                        nodejs \
                        npm \
                        freetype-dev \
                        libjpeg-turbo-dev \
                        libpng-dev
RUN apk add --update npm

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd

ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz

RUN apk add -u nghttp2

WORKDIR /var/www

RUN rm -rf /var/www/html
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN ln -s public html

EXPOSE 9000
ENTRYPOINT ["php-fpm"]
