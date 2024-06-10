# Use a imagem oficial do PHP como base
FROM php:8.1-fpm

# Defina o diretório de trabalho
WORKDIR /var/www

# Instale dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_mysql mbstring exif pcntl bcmath gd zip

# Limpe o cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instale o Composer
COPY --from=composer:2.7.2 /usr/bin/composer /usr/bin/composer

# Copie o conteúdo da aplicação
COPY . /var/www

# Ajuste permissões
RUN chown -R www-data:www-data /var/www

# Exponha a porta 9000 e inicie o servidor PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]
