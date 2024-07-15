# Use the official PHP image as the base
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libmagickwand-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql bcmath mysqli \
    && pecl install imagick \
    && docker-php-ext-enable imagick

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest \
    && npm install -g vite

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Change ownership of the .npm directory
RUN mkdir -p /var/www/.npm && chown -R www-data:www-data /var/www/.npm

# Install PHP dependencies
#RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Install Node.js dependencies
#RUN npm install && npm run build

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

# Make sure permissions are correct
RUN chown -R www-data:www-data /var/www/html \
  && chmod -R 755 /var/www/html