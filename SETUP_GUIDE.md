# 🚀 SETUP GUIDE - Laravel API Project

## 📋 Checklist Setup

### ✅ Yang Sudah Dibuat:

1. **Migrations:**
   - ✅ `create_sellers_table.php`
   - ✅ `create_customers_table.php`
   - ✅ `create_categories_table.php`
   - ✅ `create_products_table.php`

2. **Models:**
   - ✅ `Seller.php` (dengan relasi ke Products)
   - ✅ `Customer.php` (dengan auto UUID)
   - ✅ `Category.php` (dengan relasi ke Products, auto UUID & slug)
   - ✅ `Product.php` (dengan relasi ke Category & Seller, auto UUID, slug, SKU)

3. **Controllers:**
   - ✅ `SellerController.php` (CRUD lengkap)
   - ✅ `CustomerController.php` (CRUD lengkap)
   - ✅ `CategoryController.php` (CRUD lengkap + product count)
   - ✅ `ProductController.php` (CRUD lengkap + upload image + filter)

4. **Seeders:**
   - ✅ `SellerSeeder.php`
   - ✅ `CustomerSeeder.php`
   - ✅ `CategorySeeder.php` (8 kategori)
   - ✅ `ProductSeeder.php` (10 produk sample)

5. **Routes:**
   - ✅ API Routes untuk semua resource

---

## 🔧 Langkah Setup

### 1. Install Dependencies (jika belum)
```bash
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
DB_CONNECTION=sqlite
DB_DATABASE=D:\APPS\laragon\www\my-api\database\database.sqlite
```

Atau jika pakai MySQL:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=my_api
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Jalankan Migration
```bash
php artisan migrate
```

**Output yang diharapkan:**
```
✓ 0001_01_01_000000_create_users_table
✓ 0001_01_01_000001_create_cache_table
✓ 0001_01_01_000002_create_jobs_table
✓ 2026_01_22_071512_create_sellers_table
✓ 2026_02_05_065922_create_categories_table
✓ 2026_02_05_065922_create_customers_table
✓ 2026_02_05_065922_create_products_table
```

### 5. Jalankan Seeder (Data Dummy)
```bash
php artisan db:seed
```

**Data yang akan dibuat:**
- 1 Test User
- Sellers (dari SellerSeeder yang sudah ada)
- 8 Categories (Elektronik, Fashion, Makanan, dll)
- 5 Customers
- 10 Products (dengan relasi ke category & seller)

### 6. Buat Storage Link (untuk upload gambar)
```bash
php artisan storage:link
```

### 7. Jalankan Server
```bash
php artisan serve
```

Server akan berjalan di: `http://localhost:8000`

---

## 🧪 Testing API

### Cek Route List
```bash
php artisan route:list --path=api
```

### Test dengan cURL

#### 1. Get All Categories
```bash
curl http://localhost:8000/api/categories
```

#### 2. Get All Products
```bash
curl http://localhost:8000/api/products
```

#### 3. Create Category
```bash
curl -X POST http://localhost:8000/api/categories \
  -H "Content-Type: application/json" \
  -d "{\"name\":\"Test Category\",\"description\":\"Test description\"}"
```

#### 4. Get Products by Category
```bash
curl http://localhost:8000/api/products?category_id=1
```

---

## 📊 Struktur Data Setelah Seeding

### Categories (8 items):
1. Elektronik
2. Fashion
3. Makanan & Minuman
4. Kesehatan & Kecantikan
5. Olahraga
6. Buku & Alat Tulis
7. Mainan & Hobi
8. Rumah Tangga

### Customers (5 items):
1. Budi Santoso
2. Siti Nurhaliza
3. Ahmad Rizki
4. Dewi Lestari
5. Eko Prasetyo

### Products (10 items):
- Samsung Galaxy S23 (Elektronik)
- Laptop ASUS ROG Strix G15 (Elektronik)
- Sony WH-1000XM5 (Elektronik)
- Kemeja Batik Pria Premium (Fashion)
- Sepatu Nike Air Max 270 (Fashion)
- Tas Ransel Eiger Original (Fashion)
- Kopi Arabica Gayo 500gr (Makanan)
- Madu Hutan Asli 1kg (Makanan)
- Cokelat Silverqueen 65gr (Makanan)
- Teh Pucuk Harum 350ml (Makanan)

---

## 🔍 Troubleshooting

### Error: "SQLSTATE[HY000]: General error: 1 no such table"
**Solusi:** Jalankan migration
```bash
php artisan migrate
```

### Error: "Class 'App\Models\Category' not found"
**Solusi:** Clear cache
```bash
php artisan config:clear
php artisan cache:clear
composer dump-autoload
```

### Error: "Tidak ada seller! Jalankan SellerSeeder terlebih dahulu"
**Solusi:** Jalankan SellerSeeder dulu
```bash
php artisan db:seed --class=SellerSeeder
php artisan db:seed --class=ProductSeeder
```

### Upload Image Error
**Solusi:** Pastikan storage link sudah dibuat
```bash
php artisan storage:link
```

Dan pastikan folder `storage/app/public` writable:
```bash
chmod -R 775 storage
```

---

## 📝 Reset Database (Fresh Start)

Jika ingin reset database dari awal:

```bash
php artisan migrate:fresh --seed
```

**Warning:** Ini akan menghapus semua data dan membuat ulang dari awal!

---

## 🎯 Next Steps

Setelah setup selesai, kamu bisa:

1. ✅ Test semua endpoint dengan Postman/Thunder Client
2. ✅ Lihat dokumentasi lengkap di `API_DOCUMENTATION.md`
3. ✅ Tambah data custom melalui API
4. ✅ Implementasi fitur tambahan (search, filter, pagination)
5. ✅ Tambah authentication (Sanctum/JWT)
6. ✅ Tambah validation rules lebih detail
7. ✅ Implementasi API Resources untuk format response

---

## 📚 File Penting

- `API_DOCUMENTATION.md` - Dokumentasi lengkap semua endpoint
- `MODUL_TAMBAHAN.md` - Materi pembelajaran Laravel
- `routes/api.php` - Definisi semua API routes
- `app/Models/` - Semua model dengan relasi
- `app/Http/Controllers/Api/` - Semua controller
- `database/migrations/` - Struktur database
- `database/seeders/` - Data dummy

---

**Selamat Belajar! 🎓**
