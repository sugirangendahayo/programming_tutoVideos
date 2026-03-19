# Use official PHP Apache image
FROM php:8.2-apache

# Install PDO for PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files to Apache root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Expose port 10000 for Render (Render automatically maps 10000)
EXPOSE 10000

# Start Apache in foreground
CMD ["apache2-foreground"]