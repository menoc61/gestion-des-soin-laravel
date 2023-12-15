# Use the official PHP image as the base image
FROM php:8.0-apache

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy Laravel application files to the container
COPY . .

# Install PHP extensions and other dependencies
RUN docker-php-ext-install pdo pdo_mysql

# Run composer install to install Laravel dependencies
RUN apt-get update && \
    apt-get install -y zip unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --no-dev --optimize-autoloader

# Set permissions and configurations as needed
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose the port where the application runs
EXPOSE 80

# Start the Apache server (or your preferred server)
CMD ["apache2-foreground"]
