# 🚀 SETUP PROJECT UNTUK TEMAN-TEMAN

## 📋 Langkah Setup (Wajib!)

### 1. Clone/Download Project
```bash
# Jika dari Git
git clone [URL_PROJECT]
cd my-api

# Jika download ZIP
# Extract dan masuk ke folder project
```

### 2. Install Dependencies
```bash
composer install
```

⏱️ **Tunggu sampai selesai** (bisa 2-5 menit)

### 3. Setup Environment
```bash
# Copy file .env.example ke .env
copy .env.example .env
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Setup Database

#### Opsi A: SQLite (Paling Mudah - RECOMMENDED)
Edit file `.env`:
```env
DB_CONNECTION=sqlite
DB_DATABASE=D:/APPS/laragon/www/my-api/database/database.sqlite
```

Sesuaikan path dengan lokasi project Anda!

#### Opsi B: MySQL
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_toko_online
DB_USERNAME=root
DB_PASSWORD=
```

Buat database dulu:
```sql
CREATE DATABASE db_toko_online;
```

### 6. Install Laravel Sanctum (Untuk Authentication)
```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

### 7. Jalankan Migration
```bash
php artisan migrate
```

Jika ditanya "Do you want to create the database?", ketik `yes`

### 8. (Optional) Seed Data Dummy
```bash
php artisan db:seed
```

Jika error, skip saja. Bisa buat data manual via Postman.

### 9. Jalankan Server
```bash
php artisan serve
```

Server akan jalan di: **http://localhost:8000**

---

## 🧪 Testing di Postman

### Test 1: Cek API Berjalan
```
GET http://localhost:8000/api/test

Response:
{
  "success": true,
  "message": "API is working!",
  "timestamp": "..."
}
```

✅ **Jika berhasil, lanjut ke test berikutnya**

### Test 2: Register User (Dengan Auth)
```
POST http://localhost:8000/api/register

Headers:
Content-Type: application/json
Accept: application/json

Body (raw JSON):
{
  "name": "Test User",
  "email": "test@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

✅ **Simpan token yang didapat!**

### Test 3: Create Category (Dengan Token)
```
POST http://localhost:8000/api/categories

Headers:
Content-Type: application/json
Accept: application/json
Authorization: Bearer YOUR_TOKEN_HERE

Body (raw JSON):
{
  "name": "Elektronik",
  "description": "Produk elektronik",
  "is_active": true
}
```

---

## 🔧 Jika Error 500

### Solusi 1: Clear Cache
```bash
php artisan optimize:clear
```

### Solusi 2: Cek Migration
```bash
php artisan migrate:status
```

Jika ada yang "Pending":
```bash
php artisan migrate
```

### Solusi 3: Cek Log Error
```bash
# Windows PowerShell
Get-Content storage/logs/laravel.log -Tail 30

# CMD
type storage\logs\laravel.log
```

### Solusi 4: Gunakan Routes Tanpa Auth (Untuk Testing)

Jika kesulitan dengan authentication, gunakan routes tanpa auth:

1. Backup `routes/api.php`:
```bash
copy routes\api.php routes\api_backup.php
```

2. Copy routes tanpa auth:
```bash
copy routes\api_no_auth.php routes\api.php
```

3. Clear cache:
```bash
php artisan route:clear
```

4. Sekarang bisa test tanpa token!

---

## 📱 Import Postman Collection

### Cara 1: Manual
Buat request satu per satu sesuai `POSTMAN_GUIDE.md`

### Cara 2: Import Collection (Jika ada)
1. Buka Postman
2. Klik "Import"
3. Pilih file collection (jika disediakan)
4. Set environment variable `base_url` = `http://localhost:8000/api`

---

## ✅ Checklist Setup

Pastikan semua ini sudah dilakukan:

- [ ] `composer install` berhasil
- [ ] File `.env` sudah ada dan dikonfigurasi
- [ ] `php artisan key:generate` sudah dijalankan
- [ ] Database sudah dibuat (MySQL) atau path SQLite sudah benar
- [ ] Laravel Sanctum sudah terinstall
- [ ] `php artisan migrate` berhasil (tidak ada error)
- [ ] `php artisan serve` berjalan
- [ ] Test endpoint `/api/test` berhasil di Postman
- [ ] Bisa register user dan dapat token
- [ ] Bisa create category dengan token

---

## 🆘 Jika Masih Error

### Cek Versi PHP
```bash
php -v
```
Minimal PHP 8.1

### Cek Composer
```bash
composer --version
```

### Cek Extensions PHP
```bash
php -m
```

Pastikan ada:
- pdo
- pdo_sqlite (jika pakai SQLite)
- pdo_mysql (jika pakai MySQL)
- mbstring
- openssl
- tokenizer

### Reinstall Dependencies
```bash
composer install --no-cache
composer dump-autoload
```

---

## 💡 Tips

1. **Gunakan SQLite** untuk setup lebih mudah
2. **Clear cache** setiap kali ada perubahan code
3. **Lihat log error** di `storage/logs/laravel.log`
4. **Gunakan routes tanpa auth** untuk testing awal
5. **Screenshot error** dan share untuk troubleshooting

---

## 📞 Kontak

Jika masih ada masalah, hubungi:
- Share screenshot error
- Share isi file `.env` (tanpa password!)
- Share hasil `php artisan migrate:status`

---

**Selamat Coding! 🎉**
