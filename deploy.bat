@echo off
REM Deployment script for Laravel application on Windows

REM Navigate to project directory (update this path to your actual project location)
cd /d "D:\oceef"

REM Pull latest changes from repository
git pull origin main

REM Install/update PHP dependencies
composer install --no-dev --optimize-autoloader

REM Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

REM Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

REM Run database migrations
php artisan migrate --force

REM Restart IIS (if using IIS)
REM iisreset

REM Or restart Apache (if using XAMPP/WAMP)
REM net stop wampapache64
REM net start wampapache64

echo Deployment completed successfully!
pause