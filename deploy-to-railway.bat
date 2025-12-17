@echo off
title Sisbar Hairstudio - Deploy to Railway
color 0D

echo.
echo 🚂 DEPLOY KE RAILWAY
echo ===================
echo.

echo 📋 Railway adalah platform cloud yang mudah untuk deploy Laravel
echo 💰 Harga: $5/bulan (gratis trial $5 credit)
echo ⚡ Keuntungan: Auto-deploy dari Git, database included, HTTPS otomatis
echo.

REM Check if railway CLI is installed
railway --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Railway CLI belum terinstall!
    echo.
    echo 📥 Install Railway CLI:
    echo 1. Buka: https://railway.app/cli
    echo 2. Download dan install Railway CLI
    echo 3. Atau install via npm: npm install -g @railway/cli
    echo.
    pause
    exit /b 1
)

echo ✅ Railway CLI terdeteksi!
echo.

echo 🔧 Persiapan deploy...

REM Create railway.json config
echo 📝 Membuat konfigurasi Railway...
(
echo {
echo   "build": {
echo     "builder": "NIXPACKS"
echo   },
echo   "deploy": {
echo     "startCommand": "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT",
echo     "healthcheckPath": "/",
echo     "healthcheckTimeout": 100,
echo     "restartPolicyType": "ON_FAILURE",
echo     "restartPolicyMaxRetries": 10
echo   }
echo }
) > railway.json

REM Create Procfile for Railway
echo 📝 Membuat Procfile...
echo web: php artisan migrate --force ^&^& php artisan serve --host=0.0.0.0 --port=$PORT > Procfile

REM Create nixpacks.toml for better PHP support
echo 📝 Membuat nixpacks.toml...
(
echo [phases.build]
echo cmds = [
echo   "composer install --no-dev --optimize-autoloader",
echo   "php artisan config:cache",
echo   "php artisan route:cache",
echo   "php artisan view:cache",
echo   "npm ci",
echo   "npm run build"
echo ]
echo.
echo [phases.start]
echo cmd = "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT"
echo.
echo [variables]
echo PHP_VERSION = "8.2"
echo NODE_VERSION = "18"
) > nixpacks.toml

echo.
echo 🚀 Memulai deploy ke Railway...
echo.
echo 📋 Langkah-langkah:
echo 1. Login ke Railway
echo 2. Buat project baru
echo 3. Connect ke GitHub repository
echo 4. Deploy otomatis
echo.

echo 🔐 Login ke Railway...
railway login

echo.
echo 📁 Inisialisasi project Railway...
railway init

echo.
echo 🗄️ Menambahkan database PostgreSQL...
railway add --database postgresql

echo.
echo 🔧 Setting environment variables...
railway variables set APP_ENV=production
railway variables set APP_DEBUG=false
railway variables set LOG_LEVEL=error
railway variables set SESSION_DRIVER=database
railway variables set CACHE_DRIVER=database

echo.
echo 🚀 Deploy aplikasi...
railway up

echo.
echo ✅ Deploy selesai!
echo.
echo 🌐 Aplikasi Anda akan tersedia di URL yang diberikan Railway
echo 📊 Monitor aplikasi: railway status
echo 📝 Lihat logs: railway logs
echo.

echo 📋 Langkah selanjutnya:
echo 1. Buka URL aplikasi dari Railway
echo 2. Test semua fitur
echo 3. Setup domain custom (opsional)
echo 4. Configure Google OAuth dengan URL baru
echo.

pause