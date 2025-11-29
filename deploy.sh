#!/bin/bash

# Deployment script for Laravel application

# Navigate to project directory
cd /path/to/your/project

# Pull latest changes from repository
git pull origin main

# Install/update PHP dependencies
composer install --no-dev --optimize-autoloader

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations
php artisan migrate --force

# Set proper permissions (Linux/Unix only)
# chmod -R 755 storage bootstrap/cache
# chown -R www-data:www-data storage bootstrap/cache

# For Windows, you might need to restart your web server
# Uncomment the appropriate lines for your setup:
# net stop w3svc
# net start w3svc

echo "Deployment completed successfully!"