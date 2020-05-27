FROM php:7.2-fpm
LABEL maintainer="juccexu" email="juccexu@gmail.com"

RUN sed -i "s@http://deb.debian.org@http://mirrors.aliyun.com@g" /etc/apt/sources.list
# Set working directory
WORKDIR /var/www

RUN docker-php-ext-install pdo_mysql mysqli pcntl opcache bcmath
RUN apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev libmcrypt-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && pecl install redis-5.1.1 \
    && docker-php-ext-enable redis  \
    && pecl install igbinary \
    && docker-php-ext-enable igbinary  

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
