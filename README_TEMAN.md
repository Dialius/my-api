# 📚 PANDUAN LENGKAP - MY API PROJECT

## 🎯 Untuk Teman-Teman yang Baru Setup

Halo! Ini adalah project API Laravel dengan fitur CRUD lengkap. Ikuti panduan ini step by step.

---

## 📖 Daftar File Panduan

| File | Untuk Apa |
|------|-----------|
| **SETUP_UNTUK_TEMAN.md** | 🚀 Setup project dari awal (MULAI DARI SINI!) |
| **FIX_ERROR_500.md** | 🚨 Solusi jika dapat error 500 |
| **TROUBLESHOOTING.md** | 🔧 Troubleshooting lengkap semua error |
| **AUTH_GUIDE.md** | 🔐 Panduan authentication (register/login) |
| **POSTMAN_GUIDE.md** | 🧪 Panduan testing di Postman |
| **TEST_AUTH.md** | ⚡ Quick test authentication |
| **API_DOCUMENTATION.md** | 📚 Dokumentasi API lengkap |

---

## ⚡ Quick Start (3 Langkah)

### 1. Install & Setup
```bash
composer install
copy .env.example .env
php artisan key:generate
```

### 2. Setup Database & Migration
```bash
# Edit .env, gunakan SQLite (paling mudah):
DB_CONNECTION=sqlite

# Jalankan migration
php artisan migrate
```

### 3. Jalankan Server
```bash
php artisan serve
```

Buka: http://localhost:8000/api/test

---

## 🧪 Testing di Postman

### Opsi A: Dengan Authentication (Recommended)

1. **Register User**
   ```
   POST http://localhost:8000/api/register
   Body: { "name": "Test", "email": "test@example.com", "password": "password123", "password_confirmation": "password123" }
   ```

2. **Simpan Token** yang didapat

3. **Create Category** (dengan token)
   ```
   POST http://localhost:8000/api/categories
   Headers: Authorization: Bearer YOUR_TOKEN
   Body: { "name": "Elektronik", "description": "Produk elektronik", "is_active": true }
   ```

📖 **Panduan lengkap:** Baca `AUTH_GUIDE.md` dan `POSTMAN_GUIDE.md`

### Opsi B: Tanpa Authentication (Untuk Testing)

Jika kesulitan dengan token, bisa nonaktifkan auth:

```bash
# Backup routes asli
copy routes\api.php routes\api_backup.php

# Gunakan routes tanpa auth
copy routes\api_no_auth.php routes\api.php

# Clear cache
php artisan route:clear
```

Sekarang bisa test tanpa token!

---

## 🚨 Jika Error 500

### Solusi Cepat:
```bash
php artisan optimize:clear
php artisan migrate
php artisan serve
```

### Masih Error?
Baca: **FIX_ERROR_500.md** untuk solusi lengkap

---

## 📋 Checklist Setup

- [ ] PHP 8.1+ terinstall
- [ ] Composer terinstall
- [ ] `composer install` berhasil
- [ ] File `.env` sudah ada
- [ ] `php artisan key:generate` sudah dijalankan
- [ ] Database sudah dikonfigurasi
- [ ] `php artisan migrate` berhasil
- [ ] Server running (`php artisan serve`)
- [ ] Test endpoint `/api/test` berhasil

---

## 🎓 Urutan Belajar

1. ✅ Setup project → `SETUP_UNTUK_TEMAN.md`
2. ✅ Test API berjalan → `GET /api/test`
3. ✅ Pelajari authentication → `AUTH_GUIDE.md`
4. ✅ Test di Postman → `POSTMAN_GUIDE.md`
5. ✅ Jika error → `FIX_ERROR_500.md`

---

## 🔧 Command Penting

```bash
# Jalankan server
php artisan serve

# Cek migration
php artisan migrate:status

# Jalankan migration
php artisan migrate

# Clear cache
php artisan optimize:clear

# Cek routes
php artisan route:list --path=api

# Cek setup (Windows)
check-setup.bat
```

---

## 📊 Endpoint API

### Public (Tanpa Token)
- `GET /api/test` - Test API
- `POST /api/register` - Daftar user
- `POST /api/login` - Login user

### Protected (Perlu Token)
- `GET /api/me` - Profile user
- `POST /api/logout` - Logout
- `GET/POST/PUT/DELETE /api/categories` - CRUD Categories
- `GET/POST/PUT/DELETE /api/sellers` - CRUD Sellers
- `GET/POST/PUT/DELETE /api/customers` - CRUD Customers
- `GET/POST/PUT/DELETE /api/products` - CRUD Products

---

## 💡 Tips

1. **Gunakan SQLite** untuk database (lebih mudah setup)
2. **Clear cache** jika ada perubahan code
3. **Lihat log error** di `storage/logs/laravel.log`
4. **Test endpoint sederhana** dulu (`/api/test`)
5. **Nonaktifkan auth** untuk testing awal
6. **Baca dokumentasi** sesuai kebutuhan

---

## 🆘 Butuh Bantuan?

1. Cek file panduan yang sesuai (lihat tabel di atas)
2. Jalankan `check-setup.bat` untuk cek setup
3. Baca `FIX_ERROR_500.md` jika error
4. Screenshot error dan share

---

## 📱 Struktur Project

```
my-api/
├── app/
│   ├── Http/Controllers/Api/
│   │   ├── AuthController.php       # Authentication
│   │   ├── CategoryController.php   # CRUD Categories
│   │   ├── SellerController.php     # CRUD Sellers
│   │   ├── CustomerController.php   # CRUD Customers
│   │   └── ProductController.php    # CRUD Products
│   └── Models/
│       ├── User.php
│       ├── Category.php
│       ├── Seller.php
│       ├── Customer.php
│       └── Product.php
├── routes/
│   ├── api.php              # Routes dengan auth
│   └── api_no_auth.php      # Routes tanpa auth (backup)
├── database/
│   ├── migrations/          # Database schema
│   └── seeders/             # Data dummy
└── Panduan/
    ├── SETUP_UNTUK_TEMAN.md
    ├── FIX_ERROR_500.md
    ├── AUTH_GUIDE.md
    └── POSTMAN_GUIDE.md
```

---

## 🎉 Selamat Belajar!

Jika sudah berhasil setup dan test, selamat! Anda sudah punya API yang berfungsi.

Selanjutnya bisa:
- Tambah fitur baru
- Customize sesuai kebutuhan
- Deploy ke server

**Happy Coding! 🚀**
