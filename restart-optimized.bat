@echo off
echo === RESTARTING LARAVEL WITH OPTIMIZATIONS ===
echo.

echo 1. Stopping current server...
taskkill /f /im php.exe 2>nul

echo 2. Clearing all caches...
php artisan cache:clear
php artisan config:clear
php artisan view:clear

echo 3. Optimizing for performance...
php artisan config:cache
php artisan view:cache

echo 4. Starting optimized server...
echo Server will start at http://127.0.0.1:8000
echo Press Ctrl+C to stop the server
echo.
php artisan serve

pause