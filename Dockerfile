# Use the official PHP image with Apache
FROM php:8.2-apache

# Copy your app code into the container
COPY . /var/www/html/

# Enable mod_rewrite (important if your app uses routing)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html/

# Expose port 80
EXPOSE 80
