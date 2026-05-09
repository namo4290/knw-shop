FROM php:8.4-fpm

# 1. 시스템 의존성 설치 (Debian 계열 apt-get 사용)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. PHP 확장 설정 및 설치 (중복 제거 및 통합)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    intl

# 3. PECL 확장 설치 (Redis)
RUN pecl install redis && docker-php-ext-enable redis

# Node.js 및 npm 설치 (안정적인 최신 LTS 버전)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 4. Composer 복사
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. 작업 디렉토리 설정
WORKDIR /var/www/html