# 📚 API DOCUMENTATION - MY API PROJECT

## 🔐 AUTHENTICATION

API ini menggunakan **Laravel Sanctum** untuk authentication dengan Bearer Token.

### Public Endpoints (Tidak perlu token):
- `POST /api/register` - Daftar user baru
- `POST /api/login` - Login user

### Protected Endpoints (Perlu token):
- `POST /api/logout` - Logout user
- `GET /api/me` - Get user profile
- Semua endpoint CRUD (categories, sellers, customers, products)

**Cara menggunakan token:**
```
Authorization: Bearer YOUR_ACCESS_TOKEN
```

📖 **Lihat panduan lengkap:** [AUTH_GUIDE.md](AUTH_GUIDE.md)

---

## 🗂️ Daftar Tabel yang Sudah Dibuat

### ✅ Tabel yang Sudah Ada:

1. **users** - User authentication (dengan Sanctum tokens)
2. **sellers** - Data penjual/toko
3. **customers** - Data pelanggan
4. **categories** - Kategori produk
5. **products** - Data produk (dengan relasi ke categories dan sellers)

---

## 📊 Struktur Database

### 1. Table: `sellers`
```
- id (bigint, primary key)
- uuid (string, unique)
- name (string, 50)
- address (string, 255)
- phone (string, 15, unique)
- email (string, 50, unique)
- store (string, 20, unique)
- created_at (timestamp)
- updated_at (timestamp)
```

### 2. Table: `customers`
```
- id (bigint, primary key)
- uuid (string, unique)
- name (string, 100)
- email (string, 100, unique)
- phone (string, 15, unique)
- address (text, nullable)
- gender (enum: male/female, nullable)
- birth_date (date, nullable)
- is_active (boolean, default: true)
- created_at (timestamp)
- updated_at (timestamp)
```

### 3. Table: `categories`
```
- id (bigint, primary key)
- uuid (string, unique)
- name (string, 100)
- description (text, nullable)
- slug (string, 100, unique)
- is_active (boolean, default: true)
- created_at (timestamp)
- updated_at (timestamp)
```

### 4. Table: `products`
```
- id (bigint, primary key)
- uuid (string, unique)
- category_id (foreign key -> categories.id)
- seller_id (foreign key -> sellers.id)
- name (string, 150)
- slug (string, 150, unique)
- description (text, nullable)
- price (decimal 15,2)
- stock (integer, default: 0)
- sku (string, 50, unique, nullable)
- image (string, nullable)
- weight (decimal 10,2, nullable) - dalam gram
- is_active (boolean, default: true)
- created_at (timestamp)
- updated_at (timestamp)
```

---

## 🔗 Relasi Antar Tabel

```
categories (1) -----> (many) products
sellers (1) -----> (many) products
```

- **Category** memiliki banyak **Products** (One to Many)
- **Seller** memiliki banyak **Products** (One to Many)
- **Product** belongs to **Category** dan **Seller**

---

## 🚀 API Endpoints

### Base URL
```
http://localhost:8000/api
```

---

## 📦 SELLERS API

### 1. Get All Sellers
```http
GET /api/sellers
```

**Response:**
```json
{
  "success": true,
  "message": "List of sellers",
  "data": {
    "current_page": 1,
    "data": [...]
  }
}
```

### 2. Get Single Seller
```http
GET /api/sellers/{id}
```

### 3. Create Seller
```http
POST /api/sellers
Content-Type: application/json

{
  "name": "Toko Elektronik Jaya",
  "address": "Jl. Sudirman No. 123",
  "phone": "081234567890",
  "email": "toko@example.com",
  "store": "elektronik-jaya"
}
```

### 4. Update Seller
```http
PUT /api/sellers/{id}
Content-Type: application/json

{
  "name": "Toko Elektronik Jaya Updated"
}
```

### 5. Delete Seller
```http
DELETE /api/sellers/{id}
```

---

## 👥 CUSTOMERS API

### 1. Get All Customers
```http
GET /api/customers
```

### 2. Get Single Customer
```http
GET /api/customers/{id}
```

### 3. Create Customer
```http
POST /api/customers
Content-Type: application/json

{
  "name": "Budi Santoso",
  "email": "budi@example.com",
  "phone": "081234567890",
  "address": "Jl. Merdeka No. 123",
  "gender": "male",
  "birth_date": "1990-05-15",
  "is_active": true
}
```

### 4. Update Customer
```http
PUT /api/customers/{id}
Content-Type: application/json

{
  "name": "Budi Santoso Updated",
  "phone": "081234567899"
}
```

### 5. Delete Customer
```http
DELETE /api/customers/{id}
```

---

## 🏷️ CATEGORIES API

### 1. Get All Categories
```http
GET /api/categories
```

**Response:** Includes product count per category

### 2. Get Single Category
```http
GET /api/categories/{id}
```

**Response:** Includes all products in this category

### 3. Create Category
```http
POST /api/categories
Content-Type: application/json

{
  "name": "Elektronik",
  "description": "Produk elektronik seperti HP, Laptop, TV",
  "is_active": true
}
```

**Note:** `slug` akan otomatis di-generate dari `name`

### 4. Update Category
```http
PUT /api/categories/{id}
Content-Type: application/json

{
  "name": "Elektronik & Gadget",
  "description": "Updated description"
}
```

### 5. Delete Category
```http
DELETE /api/categories/{id}
```

**Note:** Tidak bisa delete category yang masih punya products

---

## 🛍️ PRODUCTS API

### 1. Get All Products
```http
GET /api/products
```

**Query Parameters:**
- `category_id` - Filter by category
- `seller_id` - Filter by seller
- `is_active` - Filter by active status (true/false)
- `search` - Search by product name

**Example:**
```http
GET /api/products?category_id=1&search=samsung
```

### 2. Get Single Product
```http
GET /api/products/{id}
```

**Response:** Includes category and seller data

### 3. Create Product
```http
POST /api/products
Content-Type: multipart/form-data

{
  "category_id": 1,
  "seller_id": 1,
  "name": "Samsung Galaxy S23",
  "description": "Smartphone flagship Samsung",
  "price": 12999000,
  "stock": 50,
  "weight": 168,
  "image": [file upload],
  "is_active": true
}
```

**Note:** 
- `uuid`, `slug`, dan `sku` akan otomatis di-generate
- `image` optional, max 2MB (jpeg, png, jpg, gif)

### 4. Update Product
```http
POST /api/products/{id}
Content-Type: multipart/form-data
X-HTTP-Method-Override: PUT

{
  "name": "Samsung Galaxy S23 Ultra",
  "price": 15999000,
  "stock": 30,
  "image": [file upload]
}
```

**Note:** Gambar lama akan otomatis dihapus jika upload gambar baru

### 5. Delete Product
```http
DELETE /api/products/{id}
```

**Note:** Gambar akan otomatis dihapus dari storage

---

## 🎯 Cara Menjalankan Project

### 1. Jalankan Migration
```bash
php artisan migrate
```

### 2. Jalankan Seeder (Data Dummy)
```bash
php artisan db:seed
```

Atau jalankan seeder spesifik:
```bash
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=CustomerSeeder
php artisan db:seed --class=SellerSeeder
php artisan db:seed --class=ProductSeeder
```

### 3. Buat Storage Link (untuk upload gambar)
```bash
php artisan storage:link
```

### 4. Jalankan Server
```bash
php artisan serve
```

---

## 📝 Fitur Otomatis di Model

### Category Model:
- ✅ Auto-generate UUID
- ✅ Auto-generate slug dari name
- ✅ Relasi ke Products

### Product Model:
- ✅ Auto-generate UUID
- ✅ Auto-generate slug dari name
- ✅ Auto-generate SKU (format: PRD-XXXXXXXX)
- ✅ Relasi ke Category dan Seller
- ✅ Accessor `formatted_price` (format Rupiah)
- ✅ Accessor `is_available` (cek stock & active status)

### Customer Model:
- ✅ Auto-generate UUID
- ✅ Cast birth_date ke date
- ✅ Cast is_active ke boolean

### Seller Model:
- ✅ Relasi ke Products

---

## 🧪 Testing dengan Postman/Thunder Client

### Import Collection
Gunakan endpoint-endpoint di atas untuk testing.

### Contoh Flow Testing:
1. Create Category → `POST /api/categories`
2. Create Seller → `POST /api/sellers`
3. Create Product → `POST /api/products` (butuh category_id & seller_id)
4. Get All Products → `GET /api/products`
5. Filter Products → `GET /api/products?category_id=1`

---

## ⚠️ Validasi

### Sellers:
- `email`, `phone`, `store` harus unique

### Customers:
- `email`, `phone` harus unique
- `gender` hanya boleh: male/female

### Categories:
- `slug` harus unique (auto-generate)

### Products:
- `category_id` harus exists di table categories
- `seller_id` harus exists di table sellers
- `sku` harus unique (auto-generate)
- `slug` harus unique (auto-generate)
- `price` minimal 0
- `stock` minimal 0
- `image` max 2MB, format: jpeg, png, jpg, gif

---

## 🎓 Catatan Pembelajaran

### Pertemuan 3: Seller ✅
- Migration, Model, Controller, Routes sudah lengkap

### Pertemuan Selanjutnya:
- **Categories** ✅ - Sudah dibuat lengkap
- **Products** ✅ - Sudah dibuat dengan relasi ke Categories & Sellers
- **Customers** ✅ - Sudah dibuat lengkap

### Relasi Database:
- One to Many: Category → Products
- One to Many: Seller → Products
- Cascade Delete: Jika Category/Seller dihapus, Products ikut terhapus

---

## 📞 Support

Jika ada error atau pertanyaan, cek:
1. `storage/logs/laravel.log` untuk error log
2. Pastikan migration sudah dijalankan
3. Pastikan seeder sudah dijalankan
4. Pastikan storage link sudah dibuat

---

**Happy Coding! 🚀**
