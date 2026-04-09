# 🚨 FIX ERROR 500 - PANDUAN CEPAT

## ⚡ Solusi Cepat (Jalankan Semua)

```bash
# 1. Clear semua cache
php artisan optimize:clear

# 2. Install/Update dependencies
composer install

# 3. Jalankan migration
php artisan migrate

# 4. Restart server
# Tekan Ctrl+C untuk stop server, lalu:
php artisan serve
```

---

## 🔍 Cek Error Spesifik

### Langkah 1: Lihat Error Detail
```bash
# Windows PowerShell
Get-Content storage/logs/laravel.log -Tail 50

# Windows CMD
type storage\logs\laravel.log
```

### Langkah 2: Identifikasi Error

---

## 📋 Error Umum & Solusi

### ❌ Error: "SQLSTATE[HY000] [1049] Unknown database"

**Penyebab:** Database belum dibuat

**Solusi:**

#### Jika pakai MySQL:
```sql
mysql -u root -p
CREATE DATABASE db_toko_online;
exit;
```

#### Jika pakai SQLite (LEBIH MUDAH):
Edit `.env`:
```env
DB_CONNECTION=sqlite
DB_DATABASE=D:/APPS/laragon/www/my-api/database/database.sqlite
```

Sesuaikan path! Lalu:
```bash
php artisan migrate
```

---

### ❌ Error: "SQLSTATE[42S02]: Base table or view not found"

**Penyebab:** Tabel belum dibuat (migration belum dijalankan)

**Solusi:**
```bash
php artisan migrate:status
php artisan migrate
```

---

### ❌ Error: "Class 'Laravel\Sanctum\HasApiTokens' not found"

**Penyebab:** Laravel Sanctum belum terinstall

**Solusi:**
```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
php artisan config:clear
```

---

### ❌ Error: "Duplicate entry 'elektronik' for key 'categories_slug_unique'"

**Penyebab:** Data sudah ada di database

**Solusi:** Gunakan nama yang berbeda, atau hapus data lama:
```bash
php artisan migrate:fresh
```

⚠️ **HATI-HATI:** Ini akan menghapus semua data!

---

### ❌ Error: "The name field is required"

**Penyebab:** Body request tidak terkirim dengan benar

**Solusi di Postman:**
1. Pilih tab "Body"
2. Pilih "raw"
3. Pilih "JSON" (bukan Text)
4. Pastikan Headers ada:
   - `Content-Type: application/json`
   - `Accept: application/json`

---

### ❌ Error: "Unauthenticated"

**Penyebab:** Token tidak ada atau tidak valid

**Solusi:**
1. Login dulu: `POST /api/login`
2. Copy token yang didapat
3. Tambahkan header: `Authorization: Bearer TOKEN`

**Atau gunakan routes tanpa auth** (lihat di bawah)

---

## 🔓 Opsi: Nonaktifkan Authentication (Untuk Testing)

Jika teman-teman kesulitan dengan authentication, bisa dinonaktifkan sementara:

### Cara 1: Backup dan Replace Routes

```bash
# Backup routes asli
copy routes\api.php routes\api_with_auth.php

# Gunakan routes tanpa auth
copy routes\api_no_auth.php routes\api.php

# Clear cache
php artisan route:clear
```

Sekarang semua endpoint bisa diakses tanpa token!

### Cara 2: Edit Manual

Edit `routes/api.php`, hapus `->middleware('auth:sanctum')`:

**SEBELUM:**
```php
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class);
});
```

**SESUDAH:**
```php
Route::apiResource('categories', CategoryController::class);
```

Jangan lupa:
```bash
php artisan route:clear
```

---

## 🧪 Test Endpoint Sederhana

### Test 1: Cek Server
Buka browser: http://localhost:8000

Harus muncul halaman Laravel

### Test 2: Cek API
```
GET http://localhost:8000/api/test

Response:
{
  "success": true,
  "message": "API is working!",
  "timestamp": "...",
  "laravel_version": "11.x"
}
```

✅ **Jika berhasil, API sudah jalan!**

### Test 3: Cek Database
```bash
php artisan tinker --execute="echo 'Database OK';"
```

Jika tidak error, database connection OK.

---

## 🔄 Reset Lengkap (Jika Semua Gagal)

```bash
# 1. Hapus semua cache
php artisan optimize:clear

# 2. Hapus vendor dan reinstall
rmdir /s /q vendor
composer install

# 3. Reset database
php artisan migrate:fresh

# 4. Generate key baru
php artisan key:generate

# 5. Restart server
php artisan serve
```

---

## 📊 Checklist Debugging

Cek satu per satu:

- [ ] Server Laravel running (`php artisan serve`)
- [ ] URL benar: `http://localhost:8000/api/...`
- [ ] Method HTTP benar (GET/POST/PUT/DELETE)
- [ ] Headers di Postman:
  - [ ] `Content-Type: application/json`
  - [ ] `Accept: application/json`
  - [ ] `Authorization: Bearer TOKEN` (jika perlu)
- [ ] Body format JSON (pilih "raw" dan "JSON")
- [ ] Database connection OK
- [ ] Migration sudah dijalankan
- [ ] Sanctum terinstall (jika pakai auth)
- [ ] Cache sudah di-clear

---

## 🆘 Masih Error?

### Kirim Info Ini:

1. **Screenshot error di Postman**
2. **Error dari log:**
   ```bash
   Get-Content storage/logs/laravel.log -Tail 30
   ```
3. **Migration status:**
   ```bash
   php artisan migrate:status
   ```
4. **Routes list:**
   ```bash
   php artisan route:list --path=api
   ```
5. **PHP version:**
   ```bash
   php -v
   ```
6. **Isi .env** (tanpa password!)

---

## 💡 Tips Mencegah Error 500

1. **Selalu clear cache** setelah update code
2. **Cek log error** sebelum tanya
3. **Test endpoint sederhana** dulu (`/api/test`)
4. **Gunakan SQLite** untuk setup lebih mudah
5. **Nonaktifkan auth** untuk testing awal
6. **Jalankan migration** setelah pull/clone project

---

**Good Luck! 🚀**
