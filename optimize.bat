@echo off
echo ===================================================
echo   OPTIMASI F9 MINISOCCER ELITE - STARTING...
echo ===================================================

echo [1/5] Membersihkan Cache...
php artisan cache:clear
php artisan view:clear
php artisan config:clear
php artisan route:clear

echo [2/5] Mengoptimalkan Route dan Config...
php artisan optimize

echo [3/5] Membersihkan Log Lama...
del /q storage\logs\*.log

echo [4/5] Mengoptimalkan Database (Optional)...
php artisan queue:flush

echo [5/5] Memulai Server Baru...
echo Web Bos akan jalan di http://127.0.0.1:8000
php artisan serve

pause