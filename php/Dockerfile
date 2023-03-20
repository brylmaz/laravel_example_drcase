FROM php:8.0.3-fpm




RUN apt-get update


RUN apt-get -y install apt-utils nano wget dialog vim


RUN echo "\e[1;33mInstall important libraries\e[0m"
RUN apt-get -y install --fix-missing \
    apt-utils \
    build-essential \
    git \
    curl \
    libcurl4 \
    libcurl4-openssl-dev \
    zlib1g-dev \
    libzip-dev \
    zip \
    libbz2-dev \
    locales \
    libmcrypt-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev
    
RUN echo "\e[1;33mInstall important docker dependencies\e[0m"
RUN docker-php-ext-install \
    exif \
    pcntl \
    bcmath \
    ctype \
    curl \
    iconv \
    xml \
    soap \
    pcntl \
    mbstring \
    tokenizer \
    bz2 \
    zip \
    intl


RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
RUN pecl install  redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis \
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install sockets && docker-php-ext-enable sockets
RUN apt-get update && docker-php-ext-install pdo_mysql

COPY --from=composer:2.5.4 /usr/bin/composer /usr/bin/composer

