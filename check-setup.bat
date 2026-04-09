@echo off
echo ========================================
echo CHECKING PROJECT SETUP
echo ========================================
echo.

echo [1/6] Checking PHP version...
php -v
echo.

echo [2/6] Checking Composer...
composer --version
echo.

echo [3/6] Checking .env file...
if exist .env (
    echo ✓ .env file exists
) else (
    echo ✗ .env file NOT found! Run: copy .env.example .env
)
echo.

echo [4/6] Checking database file (SQLite)...
if exist database\database.sqlite (
    echo ✓ database.sqlite exists
) else (
    echo ✗ database.sqlite NOT found! Will be created on first migration
)
echo.

echo [5/6] Checking migration status...
php artisan migrate:status
echo.

echo [6/6] Checking routes...
php artisan route:list --path=api
echo.

echo ========================================
echo SETUP CHECK COMPLETE
echo ========================================
echo.
echo Next steps:
echo 1. Run: php artisan serve
echo 2. Test: http://localhost:8000/api/test
echo.
pause
