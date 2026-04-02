FROM php:8.2-cli

# Install system-level packages needed to compile PHP extensions
RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    libpng-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql gd xml bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy Composer binary from the official Composer image — no separate install needed
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Install PHP dependencies inside the container
COPY composer.json ./
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application
COPY . .

# Ensure required directories exist and are writable before finalizing autoload
RUN mkdir -p bootstrap/cache storage/logs storage/framework/cache storage/framework/sessions storage/framework/views \
    && chmod -R 775 bootstrap/cache storage \
    && composer dump-autoload --optimize

# Serve on 0.0.0.0 so the port is reachable from outside the container
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
