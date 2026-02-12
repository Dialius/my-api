# 🛍️ MY API - Laravel E-Commerce API

> Laravel REST API untuk sistem e-commerce dengan fitur lengkap CRUD untuk Sellers, Customers, Categories, dan Products.

---

## 📋 Daftar Isi

- [Tentang Project](#-tentang-project)
- [Fitur](#-fitur)
- [Teknologi](#-teknologi)
- [Struktur Database](#-struktur-database)
- [Quick Start](#-quick-start)
- [Dokumentasi](#-dokumentasi)
- [API Endpoints](#-api-endpoints)
- [Testing](#-testing)

---

## 📖 Tentang Project

Project ini adalah REST API untuk sistem e-commerce yang dibangun dengan Laravel 11. API ini menyediakan endpoint lengkap untuk mengelola:

- **Sellers** (Penjual/Toko)
- **Customers** (Pelanggan)
- **Categories** (Kategori Produk)
- **Products** (Produk dengan upload gambar)

---

## ✨ Fitur

### 🎯 Fitur Utama
- ✅ CRUD lengkap untuk 4 resource (20 endpoints)
- ✅ Relasi database (One to Many, Belongs To)
- ✅ Upload & delete image untuk products
- ✅ Filter & search products
- ✅ Auto-generate UUID, Slug, dan SKU
- ✅ Validasi input lengkap
- ✅ Response JSON standar
- ✅ Cascade delete
- ✅ Eager loading relasi

### 🔧 Fitur Teknis
- Auto-generate UUID untuk semua tabel
- Auto-generate Slug dari name (SEO friendly)
- Auto-generate SKU untuk products (format: PRD-XXXXXXXX)
- Image upload dengan validasi (max 2MB)
- Accessor untuk format harga Rupiah
- Product count per category
- Soft validation untuk update

---

## 🛠️ Teknologi

- **Framework:** Laravel 11
- **Database:** MySQL / SQLite
- **PHP:** 8.2+
- **API:** RESTful JSON API

---

## 🗄️ Struktur Database

### Tabel yang Tersedia:

1. **sellers** - Data penjual/toko
2. **customers** - Data pelanggan
3. **categories** - Kategori produk
4. **products** - Data produk (dengan relasi)
5. **users** - User authentication (default Laravel)

### Relasi:
```
categories (1) ──hasMany──> products (many)
sellers (1) ──hasMany──> products (many)
products (many) ──belongsTo──> categories (1)
products (many) ──belongsTo──> sellers (1)
```

**Detail lengkap:** Lihat [DATABASE_STRUCTURE.md](DATABASE_STRUCTURE.md)

---

## 🚀 Quick Start

### 1. Clone & Install
```bash
git clone <repository-url>
cd my-api
composer install
```

### 2. Setup Environment
```bash
copy .env.example .env
php artisan key:generate
```

### 3. Konfigurasi Database
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_toko_online
DB_USERNAME=root
DB_PASSWORD=root
```

### 4. Jalankan Migration & Seeder
```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

### 5. Jalankan Server
```bash
php artisan serve
```

Server berjalan di: `http://localhost:8000`

### 6. Test API
```bash
curl http://localhost:8000/api/categories
curl http://localhost:8000/api/products
```

**Panduan lengkap:** Lihat [SETUP_GUIDE.md](SETUP_GUIDE.md)

---

## 📚 Dokumentasi

| File | Deskripsi |
|------|-----------|
| [API_DOCUMENTATION.md](API_DOCUMENTATION.md) | Dokumentasi lengkap semua endpoint dengan contoh |
| [SETUP_GUIDE.md](SETUP_GUIDE.md) | Panduan setup step-by-step |
| [QUICK_TEST.md](QUICK_TEST.md) | Panduan testing cepat dengan cURL |
| [SUMMARY.md](SUMMARY.md) | Ringkasan semua tabel dan fitur |
| [DATABASE_STRUCTURE.md](DATABASE_STRUCTURE.md) | Struktur database dan ERD |
| [CHECKLIST.md](CHECKLIST.md) | Checklist lengkap semua yang sudah dibuat |
| [MODUL_TAMBAHAN.md](MODUL_TAMBAHAN.md) | Materi pembelajaran Laravel |

---

## 🌐 API Endpoints

### Base URL: `http://localhost:8000/api`

### Sellers
```
GET    /api/sellers          - List semua sellers
POST   /api/sellers          - Create seller baru
GET    /api/sellers/{id}     - Detail seller
PUT    /api/sellers/{id}     - Update seller
DELETE /api/sellers/{id}     - Delete seller
```

### Customers
```
GET    /api/customers        - List semua customers
POST   /api/customers        - Create customer baru
GET    /api/customers/{id}   - Detail customer
PUT    /api/customers/{id}   - Update customer
DELETE /api/customers/{id}   - Delete customer
```

### Categories
```
GET    /api/categories       - List semua categories (+ product count)
POST   /api/categories       - Create category baru
GET    /api/categories/{id}  - Detail category (+ products)
PUT    /api/categories/{id}  - Update category
DELETE /api/categories/{id}  - Delete category
```

### Products
```
GET    /api/products                    - List semua products
GET    /api/products?category_id=1      - Filter by category
GET    /api/products?search=samsung     - Search by name
POST   /api/products                    - Create product (+ upload image)
GET    /api/products/{id}               - Detail product
PUT    /api/products/{id}               - Update product
DELETE /api/products/{id}               - Delete product (+ hapus image)
```

**Detail lengkap:** Lihat [API_DOCUMENTATION.md](API_DOCUMENTATION.md)

---

## 🧪 Testing

### Dengan cURL
```bash
# Get all categories
curl http://localhost:8000/api/categories

# Create category
curl -X POST http://localhost:8000/api/categories \
  -H "Content-Type: application/json" \
  -d '{"name":"Elektronik","description":"Produk elektronik"}'

# Get products by category
curl "http://localhost:8000/api/products?category_id=1"
```

### Dengan Postman/Thunder Client
Import collection dari [QUICK_TEST.md](QUICK_TEST.md)

### Dengan Artisan Tinker
```bash
php artisan tinker

# Cek data
App\Models\Category::count();
App\Models\Product::with(['category', 'seller'])->get();
```

**Panduan lengkap:** Lihat [QUICK_TEST.md](QUICK_TEST.md)

---

## 📊 Data Dummy (Setelah Seeding)

- **8 Categories:** Elektronik, Fashion, Makanan & Minuman, dll
- **5 Customers:** Budi, Siti, Ahmad, Dewi, Eko
- **10 Products:** Samsung Galaxy, ASUS Laptop, Nike Shoes, Kopi Arabica, dll
- **Sellers:** Dari SellerSeeder yang sudah ada

---

## 🔍 Troubleshooting

### Error: "No connection could be made"
**Solusi:** Pastikan MySQL/Laragon sudah running

### Error: "Table not found"
**Solusi:** Jalankan migration
```bash
php artisan migrate
```

### Error: "No data found"
**Solusi:** Jalankan seeder
```bash
php artisan db:seed
```

### Upload Image Error
**Solusi:** Buat storage link
```bash
php artisan storage:link
```

**Troubleshooting lengkap:** Lihat [SETUP_GUIDE.md](SETUP_GUIDE.md)

---

## 📝 Catatan Pembelajaran

### Pertemuan 3: Seller ✅
Migration, Model, Controller, Routes sudah lengkap

### Pertemuan Selanjutnya: ✅
- **Categories** - Sudah dibuat lengkap dengan relasi
- **Products** - Sudah dibuat dengan relasi ke Categories & Sellers
- **Customers** - Sudah dibuat lengkap

---

## 🤝 Contributing

Jika ingin berkontribusi:
1. Fork repository
2. Create feature branch
3. Commit changes
4. Push to branch
5. Create Pull Request

---

## 📄 License

Project ini menggunakan [MIT License](https://opensource.org/licenses/MIT).

---

## 👨‍💻 Author

Dibuat untuk pembelajaran Laravel REST API

---

## 📞 Support

Jika ada pertanyaan atau issue:
1. Cek dokumentasi di folder docs
2. Lihat `storage/logs/laravel.log` untuk error log
3. Buka issue di repository

---

**Happy Coding! 🚀**
