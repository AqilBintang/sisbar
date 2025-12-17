@echo off
title Sisbar Hairstudio - Prepare for Hosting
color 0B

echo.
echo 📦 PERSIAPAN DEPLOY KE HOSTING
echo ==============================
echo.

REM Create deployment folder
if not exist "deployment" mkdir deployment
cd deployment

echo 🧹 Membersihkan folder deployment...
if exist "sisbar-hairstudio" rmdir /s /q "sisbar-hairstudio"
mkdir sisbar-hairstudio
cd sisbar-hairstudio

echo.
echo 📋 Menyalin file project...

REM Copy essential files
xcopy /E /I /H /Y "..\..\app" "app\"
xcopy /E /I /H /Y "..\..\bootstrap" "bootstrap\"
xcopy /E /I /H /Y "..\..\config" "config\"
xcopy /E /I /H /Y "..\..\database" "database\"
xcopy /E /I /H /Y "..\..\public" "public\"
xcopy /E /I /H /Y "..\..\resources" "resources\"
xcopy /E /I /H /Y "..\..\routes" "routes\"
xcopy /E /I /H /Y "..\..\storage" "storage\"
xcopy /E /I /H /Y "..\..\vendor" "vendor\"

REM Copy root files
copy "..\..\artisan" .
copy "..\..\composer.json" .
copy "..\..\composer.lock" .
copy "..\..\package.json" .
copy "..\..\vite.config.js" .
copy "..\..\phpunit.xml" .

REM Create production .env
echo 🔧 Membuat file .env untuk production...
(
echo APP_NAME="Sisbar Hairstudio"
echo APP_ENV=production
echo APP_KEY=
echo APP_DEBUG=false
echo APP_URL=https://yourdomain.com
echo.
echo LOG_CHANNEL=stack
echo LOG_DEPRECATIONS_CHANNEL=null
echo LOG_LEVEL=debug
echo.
echo DB_CONNECTION=mysql
echo DB_HOST=127.0.0.1
echo DB_PORT=3306
echo DB_DATABASE=your_database_name
echo DB_USERNAME=your_database_user
echo DB_PASSWORD=your_database_password
echo.
echo BROADCAST_DRIVER=log
echo CACHE_DRIVER=file
echo FILESYSTEM_DISK=local
echo QUEUE_CONNECTION=sync
echo SESSION_DRIVER=file
echo SESSION_LIFETIME=120
echo.
echo MEMCACHED_HOST=127.0.0.1
echo.
echo REDIS_HOST=127.0.0.1
echo REDIS_PASSWORD=null
echo REDIS_PORT=6379
echo.
echo MAIL_MAILER=smtp
echo MAIL_HOST=mailpit
echo MAIL_PORT=1025
echo MAIL_USERNAME=null
echo MAIL_PASSWORD=null
echo MAIL_ENCRYPTION=null
echo MAIL_FROM_ADDRESS="hello@example.com"
echo MAIL_FROM_NAME="${APP_NAME}"
echo.
echo AWS_ACCESS_KEY_ID=
echo AWS_SECRET_ACCESS_KEY=
echo AWS_DEFAULT_REGION=us-east-1
echo AWS_BUCKET=
echo AWS_USE_PATH_STYLE_ENDPOINT=false
echo.
echo PUSHER_APP_ID=
echo PUSHER_APP_KEY=
echo PUSHER_APP_SECRET=
echo PUSHER_HOST=
echo PUSHER_PORT=443
echo PUSHER_SCHEME=https
echo PUSHER_APP_CLUSTER=mt1
echo.
echo VITE_APP_NAME="${APP_NAME}"
echo VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
echo VITE_PUSHER_HOST="${PUSHER_HOST}"
echo VITE_PUSHER_PORT="${PUSHER_PORT}"
echo VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
echo VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
echo.
echo # Google OAuth
echo GOOGLE_CLIENT_ID=your_google_client_id
echo GOOGLE_CLIENT_SECRET=your_google_client_secret
echo GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
echo.
echo # Performance Settings
echo CACHE_DRIVER=file
echo SESSION_DRIVER=file
echo QUEUE_CONNECTION=sync
) > .env

REM Create .htaccess for shared hosting
echo 📝 Membuat .htaccess untuk shared hosting...
(
echo ^<IfModule mod_rewrite.c^>
echo     RewriteEngine On
echo     RewriteRule ^^$ public/ [L]
echo     RewriteRule ^(.*^) public/$1 [L]
echo ^</IfModule^>
) > .htaccess

REM Create database export
echo 💾 Membuat export database...
cd ..\..
php artisan db:export > deployment\sisbar-hairstudio\database.sql 2>nul

cd deployment\sisbar-hairstudio

REM Create installation guide
echo 📋 Membuat panduan instalasi...
(
echo # 🚀 PANDUAN INSTALASI DI HOSTING
echo ================================
echo.
echo ## 📂 Upload Files
echo 1. Upload semua file ke folder public_html
echo 2. Jika ada folder public_html/public, pindahkan isinya ke public_html
echo 3. Hapus folder public_html/public setelah dipindah
echo.
echo ## 🗄️ Setup Database
echo 1. Buka cPanel ^> MySQL Databases
echo 2. Buat database baru
echo 3. Buat user database dan berikan semua privileges
echo 4. Import file database.sql
echo.
echo ## 🔧 Konfigurasi
echo 1. Edit file .env:
echo    - DB_DATABASE: nama database Anda
echo    - DB_USERNAME: username database
echo    - DB_PASSWORD: password database
echo    - APP_URL: domain website Anda
echo.
echo 2. Set permission folder:
echo    - storage/ : 755
echo    - bootstrap/cache/ : 755
echo.
echo 3. Generate APP_KEY:
echo    - Jalankan: php artisan key:generate
echo    - Atau generate online dan paste ke .env
echo.
echo ## 🔗 Final Steps
echo 1. Buka website Anda
echo 2. Test login/register
echo 3. Test booking system
echo 4. Verify mobile responsiveness
echo.
echo ## 🆘 Troubleshooting
echo - Jika error 500: check file permissions
echo - Jika database error: check .env credentials
echo - Jika assets tidak load: check APP_URL
echo.
echo 📞 Butuh bantuan? Hubungi developer
) > INSTALLATION-GUIDE.md

echo.
echo ✅ Persiapan selesai!
echo.
echo 📁 File siap deploy ada di: deployment\sisbar-hairstudio\
echo.
echo 📋 Langkah selanjutnya:
echo 1. Zip folder sisbar-hairstudio
echo 2. Upload ke hosting (cPanel File Manager)
echo 3. Extract di public_html
echo 4. Follow INSTALLATION-GUIDE.md
echo.
echo 💡 Rekomendasi hosting murah:
echo - Hostinger: Rp 25rb/bulan
echo - Niagahoster: Rp 30rb/bulan
echo - DomainRacer: Rp 20rb/bulan
echo.

pause