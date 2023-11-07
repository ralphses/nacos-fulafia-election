# Use the official PHP and Node Docker images as base
FROM php:8.2-cli

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && \
    apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Copy all files to the container
COPY . .

# Generate the autoloader files
RUN composer dump-autoload

# Set permissions for storage and bootstrap folders
RUN chmod -R 777 storage bootstrap/cache

# Install NPM dependencies and build assets
RUN npm install
RUN npm run dev

# Expose the port the app runs on
EXPOSE 80

# Start the Laravel server
CMD php artisan serve --host=0.0.0.0 --port=80
