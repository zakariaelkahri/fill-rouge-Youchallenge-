FROM php:8.2-apache

# Install necessary dependencies for MySQL (pdo_mysql)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    default-mysql-client  # Install MySQL client for interaction

# Install MySQL PDO extension
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite
