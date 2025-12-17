@echo off
echo === APPLYING UI PERFORMANCE OPTIMIZATIONS ===
echo.

echo 1. Clearing caches...
php artisan cache:clear
php artisan view:clear

echo 2. Creating optimized directories...
if not exist "public\js" mkdir public\js

echo 3. Copying optimized navigation...
copy "resources\js\optimized-navigation.js" "public\js\optimized-navigation.js"

echo 4. Caching views...
php artisan view:cache

echo.
echo === OPTIMIZATION APPLIED ===
echo.
echo To test optimizations:
echo 1. Restart server: php artisan serve
echo 2. Visit: http://127.0.0.1:8000/barbershop
echo 3. Test navigation between pages
echo.
pause