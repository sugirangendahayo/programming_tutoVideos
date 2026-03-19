# Use official PHP Apache image
FROM php:8.2-apache

# Install dependencies for PostgreSQL PDO
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy project files to Apache root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Expose port 10000 for Render
EXPOSE 10000

# Start Apache in foreground
CMD ["apache2-foreground"] 