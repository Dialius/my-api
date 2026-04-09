# 🔧 TROUBLESHOOTING ERROR 500

## Penyebab Umum Error 500:

### 1. ❌ Migration Belum Dijalankan
**Gejala:** Error saat akses endpoint categories, products, dll

**Solusi:**
```bash
php artisan migrate:status
```

Jika ada yang "Pending", jalankan:
```bash
php artisan migrate
```

---

### 2. ❌ Laravel Sanctum Belum Terinstall
**Gejala:** Error saat register/login atau akses protected routes

**Solusi:**
```bash
# Install Sanctum
composer require laravel/sanctum

# Publish config
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

# Migrate
php artisan migrate
```

---

### 3. ❌ Database Connection Error
**Gejala:** Error di semua endpoint

**Solusi:**
Cek file `.env`:
```env
DB_CONNECTION=sqlite
DB_DATABASE=D:/APPS/laragon/www/my-api/database/database.sqlite
```

Atau gunakan MySQL:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_toko_online
DB_USERNAME=root
DB_PASSWORD=
```

Test koneksi:
```bash
php artisan db:show
```

---

### 4. ❌ Cache Issue
**Gejala:** Error setelah update code

**Solusi:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

Atau sekaligus:
```bash
php artisan optimize:clear
```

---

### 5. ❌ Permission Issue (Storage/Logs)
**Gejala:** Error saat upload file atau write logs

**Solusi (Windows):**
Pastikan folder `storage` dan `bootstrap/cache` bisa ditulis

**Solusi (Linux/Mac):**
```bash
chmod -R 775 storage bootstrap/cache
```

---

### 6. ❌ Missing Dependencies
**Gejala:** Error class not found

**Solusi:**
```bash
composer install
composer dump-autoload
```

---

## 🔍 Cara Cek Error Detail

### 1. Lihat Laravel Log
```bash
# Windows (PowerShell)
Get-Content storage/logs/laravel.log -Tail 50

# Linux/Mac
tail -50 storage/logs/laravel.log
```

### 2. Enable Debug Mode
Edit `.env`:
```env
APP_DEBUG=true
```

⚠️ **PENTING:** Set `APP_DEBUG=false` di production!

### 3. Cek Response di Postman
Lihat tab "Body" untuk detail error message

---

## 🧪 Testing Step by Step

### Step 1: Cek Server Running
```bash
php artisan serve
```
Buka: http://localhost:8000

### Step 2: Cek Database
```bash
php artisan migrate:status
```

### Step 3: Cek Routes
```bash
php artisan route:list --path=api
```

### Step 4: Test Endpoint Sederhana
```
GET http://localhost:8000/api/test
```

---

## 📋 Checklist untuk Teman Anda

Minta teman Anda cek hal-hal ini:

- [ ] Server Laravel sudah running (`php artisan serve`)
- [ ] Migration sudah dijalankan (`php artisan migrate`)
- [ ] File `.env` sudah dikonfigurasi dengan benar
- [ ] Database connection berhasil
- [ ] Sanctum sudah terinstall (jika pakai auth)
- [ ] Composer dependencies sudah terinstall
- [ ] Cache sudah di-clear
- [ ] Postman headers sudah benar (Content-Type, Accept)
- [ ] URL endpoint sudah benar

---

## 🚨 Error Spesifik & Solusi

### Error: "SQLSTATE[HY000] [1049] Unknown database"
**Solusi:** Database belum dibuat
```bash
# MySQL
mysql -u root -p
CREATE DATABASE db_toko_online;
exit;

# Atau gunakan SQLite (lebih mudah)
# Edit .env:
DB_CONNECTION=sqlite
```

### Error: "Class 'Laravel\Sanctum\HasApiTokens' not found"
**Solusi:** Install Sanctum
```bash
composer require laravel/sanctum
php artisan migrate
```

### Error: "SQLSTATE[42S02]: Base table or view not found"
**Solusi:** Migration belum dijalankan
```bash
php artisan migrate
```

### Error: "Unauthenticated"
**Solusi:** Token tidak valid atau tidak ada
- Pastikan sudah login dan dapat token
- Pastikan header: `Authorization: Bearer TOKEN`

### Error: "The name field is required"
**Solusi:** Body request tidak lengkap
- Pastikan pilih "raw" dan "JSON" di Postman
- Pastikan header `Content-Type: application/json`

---

## 💡 Tips untuk Sharing Project

### 1. Buat Setup Script
Buat file `setup.sh` atau `setup.bat`:
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

### 2. Dokumentasi .env
Buat file `.env.example` yang lengkap dengan komentar

### 3. Sediakan Postman Collection
Export collection Postman dan share ke teman

### 4. Buat Video Tutorial
Record cara setup dan testing di komputer Anda

---

## 📞 Jika Masih Error

1. Screenshot error di Postman
2. Copy error dari `storage/logs/laravel.log`
3. Share konfigurasi `.env` (tanpa password!)
4. Share hasil `php artisan migrate:status`
5. Share hasil `composer show` untuk cek dependencies

---

**Semoga membantu! 🚀**
