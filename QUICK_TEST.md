# ⚡ QUICK TEST GUIDE

## 🚀 Langkah Cepat Testing

### 1. Setup Database (Sekali Saja)
```bash
# Pastikan MySQL/Laragon sudah running
php artisan migrate
php artisan db:seed
php artisan storage:link
```

### 2. Jalankan Server
```bash
php artisan serve
```

Server: `http://localhost:8000`

---

## 🧪 Test dengan cURL (Copy-Paste)

### CATEGORIES

#### Get All Categories
```bash
curl http://localhost:8000/api/categories
```

#### Create Category
```bash
curl -X POST http://localhost:8000/api/categories -H "Content-Type: application/json" -d "{\"name\":\"Otomotif\",\"description\":\"Produk otomotif dan spare part\"}"
```

#### Get Category by ID
```bash
curl http://localhost:8000/api/categories/1
```

---

### CUSTOMERS

#### Get All Customers
```bash
curl http://localhost:8000/api/customers
```

#### Create Customer
```bash
curl -X POST http://localhost:8000/api/customers -H "Content-Type: application/json" -d "{\"name\":\"John Doe\",\"email\":\"john@example.com\",\"phone\":\"081234567899\",\"address\":\"Jl. Test No. 123\",\"gender\":\"male\"}"
```

#### Get Customer by ID
```bash
curl http://localhost:8000/api/customers/1
```

---

### PRODUCTS

#### Get All Products
```bash
curl http://localhost:8000/api/products
```

#### Get Products by Category
```bash
curl "http://localhost:8000/api/products?category_id=1"
```

#### Search Products
```bash
curl "http://localhost:8000/api/products?search=samsung"
```

#### Get Product by ID
```bash
curl http://localhost:8000/api/products/1
```

#### Create Product (JSON)
```bash
curl -X POST http://localhost:8000/api/products -H "Content-Type: application/json" -d "{\"category_id\":1,\"seller_id\":1,\"name\":\"iPhone 15 Pro\",\"description\":\"Latest iPhone\",\"price\":19999000,\"stock\":30,\"weight\":187}"
```

---

### SELLERS

#### Get All Sellers
```bash
curl http://localhost:8000/api/sellers
```

#### Get Seller by ID
```bash
curl http://localhost:8000/api/sellers/1
```

---

## 📱 Test dengan Postman/Thunder Client

### Import Collection

#### 1. Categories
```
GET    http://localhost:8000/api/categories
POST   http://localhost:8000/api/categories
GET    http://localhost:8000/api/categories/1
PUT    http://localhost:8000/api/categories/1
DELETE http://localhost:8000/api/categories/1
```

**Body POST/PUT:**
```json
{
  "name": "Elektronik",
  "description": "Produk elektronik",
  "is_active": true
}
```

---

#### 2. Customers
```
GET    http://localhost:8000/api/customers
POST   http://localhost:8000/api/customers
GET    http://localhost:8000/api/customers/1
PUT    http://localhost:8000/api/customers/1
DELETE http://localhost:8000/api/customers/1
```

**Body POST/PUT:**
```json
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

---

#### 3. Products
```
GET    http://localhost:8000/api/products
GET    http://localhost:8000/api/products?category_id=1
GET    http://localhost:8000/api/products?search=samsung
POST   http://localhost:8000/api/products
GET    http://localhost:8000/api/products/1
PUT    http://localhost:8000/api/products/1
DELETE http://localhost:8000/api/products/1
```

**Body POST/PUT (JSON):**
```json
{
  "category_id": 1,
  "seller_id": 1,
  "name": "Samsung Galaxy S23",
  "description": "Smartphone flagship",
  "price": 12999000,
  "stock": 50,
  "weight": 168,
  "is_active": true
}
```

**Body POST/PUT (Form-Data untuk upload image):**
```
category_id: 1
seller_id: 1
name: Samsung Galaxy S23
description: Smartphone flagship
price: 12999000
stock: 50
weight: 168
image: [pilih file gambar]
is_active: true
```

---

#### 4. Sellers
```
GET    http://localhost:8000/api/sellers
POST   http://localhost:8000/api/sellers
GET    http://localhost:8000/api/sellers/1
PUT    http://localhost:8000/api/sellers/1
DELETE http://localhost:8000/api/sellers/1
```

**Body POST/PUT:**
```json
{
  "name": "Toko Elektronik Jaya",
  "address": "Jl. Sudirman No. 123",
  "phone": "081234567890",
  "email": "toko@example.com",
  "store": "elektronik-jaya"
}
```

---

## 🔍 Cek Data di Database

### Via Artisan Tinker
```bash
php artisan tinker
```

```php
// Cek jumlah data
App\Models\Category::count();
App\Models\Customer::count();
App\Models\Product::count();
App\Models\Seller::count();

// Lihat semua categories
App\Models\Category::all();

// Lihat products dengan relasi
App\Models\Product::with(['category', 'seller'])->get();

// Cari product by name
App\Models\Product::where('name', 'like', '%samsung%')->get();

// Exit
exit
```

---

## 📊 Expected Results Setelah Seeding

### Categories: 8 items
```
1. Elektronik
2. Fashion
3. Makanan & Minuman
4. Kesehatan & Kecantikan
5. Olahraga
6. Buku & Alat Tulis
7. Mainan & Hobi
8. Rumah Tangga
```

### Customers: 5 items
```
1. Budi Santoso
2. Siti Nurhaliza
3. Ahmad Rizki
4. Dewi Lestari
5. Eko Prasetyo
```

### Products: 10 items
```
1. Samsung Galaxy S23 (Elektronik)
2. Laptop ASUS ROG Strix G15 (Elektronik)
3. Sony WH-1000XM5 (Elektronik)
4. Kemeja Batik Pria Premium (Fashion)
5. Sepatu Nike Air Max 270 (Fashion)
6. Tas Ransel Eiger Original (Fashion)
7. Kopi Arabica Gayo 500gr (Makanan)
8. Madu Hutan Asli 1kg (Makanan)
9. Cokelat Silverqueen 65gr (Makanan)
10. Teh Pucuk Harum 350ml (Makanan)
```

---

## ⚠️ Common Issues

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

### Error: "Validation failed"
**Solusi:** Cek format data, pastikan:
- Email & phone unique
- category_id & seller_id exists
- Required fields tidak kosong

---

## 🎯 Quick Commands

```bash
# Lihat semua routes
php artisan route:list --path=api

# Clear cache
php artisan config:clear
php artisan cache:clear

# Reset database (HATI-HATI: hapus semua data!)
php artisan migrate:fresh --seed

# Jalankan seeder spesifik
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=ProductSeeder
```

---

**Happy Testing! 🚀**
