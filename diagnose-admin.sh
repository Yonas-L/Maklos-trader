#!/bin/bash

echo "=== Filament Admin Panel Diagnostics ==="
echo ""

echo "1. Checking file permissions..."
ls -la public/
echo ""

echo "2. Checking storage link..."
ls -la public/storage
echo ""

echo "3. Checking if storage directory exists and is writable..."
ls -la storage/
echo ""

echo "4. Checking Laravel routes..."
php artisan route:list | grep adminPanel
echo ""

echo "5. Checking .env APP_URL..."
grep APP_URL .env
echo ""

echo "6. Checking if cache is causing issues..."
php artisan config:show | grep -A 5 "app.url"
echo ""

echo "=== Suggested Fixes ==="
echo "If you see permission errors, run:"
echo "  sudo chown -R www-data:www-data storage bootstrap/cache"
echo "  sudo chmod -R 775 storage bootstrap/cache"
echo ""
echo "If storage link is missing, run:"
echo "  php artisan storage:link"
echo ""
echo "If APP_URL is wrong, update .env and run:"
echo "  php artisan config:clear"
