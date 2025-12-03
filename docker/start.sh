#!/bin/sh

# Generate app key if not set
php artisan key:generate --force

# Run migrations
php artisan migrate --force

# Cache config and routes for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start PHP-FPM in background
php-fpm -D

# Start nginx in foreground
nginx -g "daemon off;"