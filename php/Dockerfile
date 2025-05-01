FROM php:8.2-apache

# Install necessary dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    default-mysql-client \
    gnupg \
    ca-certificates \
    lsb-release \
    apt-transport-https

# Install Node.js (LTS version, e.g., 18.x)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Verify Node.js and npm installation
RUN node -v && npm -v

# Install MySQL PDO extension
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
