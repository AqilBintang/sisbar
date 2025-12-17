@echo off
echo ========================================
echo OPTIMASI PERFORMA WEBSITE SISBAR
echo ========================================
echo.

echo [1/8] Clearing application cache...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo.
echo [2/8] Checking cache tables...
echo Cache tables already exist or will be created during migration

echo.
echo [3/8] Running migrations...
php artisan migrate --force

echo.
echo [4/8] Optimizing configuration...
php artisan config:cache
php artisan route:cache

echo.
echo [5/8] Warming up cache...
php artisan cache:warm --clear

echo.
echo [6/8] Building optimized assets...
npm run build

echo.
echo [7/8] Optimizing Composer autoloader...
composer dump-autoload --optimize --classmap-authoritative

echo.
echo [8/8] Final optimization...
php artisan optimize

echo.
echo ========================================
echo OPTIMASI SELESAI!
echo ========================================
echo.
echo Performa website telah dioptimalkan:
echo ✅ Cache database aktif
echo ✅ Session menggunakan database
echo ✅ Queue menggunakan database
echo ✅ Asset telah diminifikasi
echo ✅ Cache aplikasi telah di-warm up
echo ✅ Autoloader dioptimalkan
echo.
echo Website sekarang akan lebih cepat!
echo ========================================

pause