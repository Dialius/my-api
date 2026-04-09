# 🧪 PANDUAN TESTING API DI POSTMAN

## 📋 Persiapan Awal

### 1. Pastikan Server Laravel Berjalan
```bash
php artisan serve
```
Server akan berjalan di: `http://localhost:8000`

### 2. Base URL untuk Semua Request
```
http://localhost:8000/api
```

---

## 🚀 CARA TESTING DI POSTMAN

### A. TESTING CATEGORIES (Mulai dari sini dulu!)

#### 1️⃣ CREATE CATEGORY (Buat Kategori Baru)

**Method:** `POST`  
**URL:** `http://localhost:8000/api/categories`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body (pilih raw → JSON):**
```json
{
  "name": "Elektronik",
  "description": "Produk elektronik seperti HP, Laptop, TV",
  "is_active": true
}
```

**Response yang Diharapkan:**
```json
{
  "success": true,
  "message": "Category created successfully",
  "data": {
    "id": 1,
    "uuid": "...",
    "name": "Elektronik",
    "slug": "elektronik",
    "description": "Produk elektronik seperti HP, Laptop, TV",
    "is_active": true
  }
}
```

**Buat beberapa kategori lagi:**
```json
{
  "name": "Fashion",
  "description": "Pakaian dan aksesoris",
  "is_active": true
}
```

```json
{
  "name": "Makanan & Minuman",
  "description": "Produk makanan dan minuman",
  "is_active": true
}
```

---

#### 2️⃣ GET ALL CATEGORIES (Lihat Semua Kategori)

**Method:** `GET`  
**URL:** `http://localhost:8000/api/categories`

**Headers:**
```
Accept: application/json
```

**Response:**
```json
{
  "success": true,
  "message": "List of categories",
  "data": [
    {
      "id": 1,
      "name": "Elektronik",
      "slug": "elektronik",
      "products_count": 0
    }
  ]
}
```

---

#### 3️⃣ GET SINGLE CATEGORY (Lihat Detail 1 Kategori)

**Method:** `GET`  
**URL:** `http://localhost:8000/api/categories/1`

**Headers:**
```
Accept: application/json
```

---

#### 4️⃣ UPDATE CATEGORY (Edit Kategori)

**Method:** `PUT`  
**URL:** `http://localhost:8000/api/categories/1`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body:**
```json
{
  "name": "Elektronik & Gadget",
  "description": "Produk elektronik dan gadget terbaru"
}
```

---

#### 5️⃣ DELETE CATEGORY (Hapus Kategori)

**Method:** `DELETE`  
**URL:** `http://localhost:8000/api/categories/1`

**Headers:**
```
Accept: application/json
```

---

### B. TESTING SELLERS (Buat Penjual)

#### 1️⃣ CREATE SELLER

**Method:** `POST`  
**URL:** `http://localhost:8000/api/sellers`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body:**
```json
{
  "name": "Toko Elektronik Jaya",
  "address": "Jl. Sudirman No. 123, Jakarta",
  "phone": "081234567890",
  "email": "elektronik.jaya@example.com",
  "store": "elektronik-jaya"
}
```

**Buat seller lagi:**
```json
{
  "name": "Fashion Store",
  "address": "Jl. Thamrin No. 45, Jakarta",
  "phone": "081234567891",
  "email": "fashion.store@example.com",
  "store": "fashion-store"
}
```

---

#### 2️⃣ GET ALL SELLERS

**Method:** `GET`  
**URL:** `http://localhost:8000/api/sellers`

**Headers:**
```
Accept: application/json
```

---

#### 3️⃣ GET SINGLE SELLER

**Method:** `GET`  
**URL:** `http://localhost:8000/api/sellers/1`

---

#### 4️⃣ UPDATE SELLER

**Method:** `PUT`  
**URL:** `http://localhost:8000/api/sellers/1`

**Body:**
```json
{
  "name": "Toko Elektronik Jaya Abadi",
  "phone": "081234567899"
}
```

---

#### 5️⃣ DELETE SELLER

**Method:** `DELETE`  
**URL:** `http://localhost:8000/api/sellers/1`

---

### C. TESTING CUSTOMERS (Buat Pelanggan)

#### 1️⃣ CREATE CUSTOMER

**Method:** `POST`  
**URL:** `http://localhost:8000/api/customers`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body:**
```json
{
  "name": "Budi Santoso",
  "email": "budi.santoso@example.com",
  "phone": "081234567890",
  "address": "Jl. Merdeka No. 123, Bandung",
  "gender": "male",
  "birth_date": "1990-05-15",
  "is_active": true
}
```

**Buat customer lagi:**
```json
{
  "name": "Siti Nurhaliza",
  "email": "siti.nur@example.com",
  "phone": "081234567892",
  "address": "Jl. Gatot Subroto No. 88, Surabaya",
  "gender": "female",
  "birth_date": "1995-08-20",
  "is_active": true
}
```

---

#### 2️⃣ GET ALL CUSTOMERS

**Method:** `GET`  
**URL:** `http://localhost:8000/api/customers`

---

#### 3️⃣ GET SINGLE CUSTOMER

**Method:** `GET`  
**URL:** `http://localhost:8000/api/customers/1`

---

#### 4️⃣ UPDATE CUSTOMER

**Method:** `PUT`  
**URL:** `http://localhost:8000/api/customers/1`

**Body:**
```json
{
  "name": "Budi Santoso Updated",
  "phone": "081234567899",
  "address": "Jl. Merdeka No. 456, Bandung"
}
```

---

#### 5️⃣ DELETE CUSTOMER

**Method:** `DELETE`  
**URL:** `http://localhost:8000/api/customers/1`

---

### D. TESTING PRODUCTS (Buat Produk)

⚠️ **PENTING:** Pastikan sudah ada Category dan Seller dulu!

#### 1️⃣ CREATE PRODUCT (Tanpa Gambar)

**Method:** `POST`  
**URL:** `http://localhost:8000/api/products`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body:**
```json
{
  "category_id": 1,
  "seller_id": 1,
  "name": "Samsung Galaxy S23",
  "description": "Smartphone flagship Samsung dengan kamera 200MP",
  "price": 12999000,
  "stock": 50,
  "weight": 168,
  "is_active": true
}
```

**Contoh Produk Lain:**
```json
{
  "category_id": 1,
  "seller_id": 1,
  "name": "iPhone 15 Pro Max",
  "description": "iPhone terbaru dengan chip A17 Pro",
  "price": 19999000,
  "stock": 30,
  "weight": 221,
  "is_active": true
}
```

```json
{
  "category_id": 1,
  "seller_id": 1,
  "name": "Laptop ASUS ROG",
  "description": "Laptop gaming dengan RTX 4060",
  "price": 25000000,
  "stock": 15,
  "weight": 2500,
  "is_active": true
}
```

---

#### 2️⃣ CREATE PRODUCT (Dengan Gambar)

**Method:** `POST`  
**URL:** `http://localhost:8000/api/products`

**Headers:**
```
Accept: application/json
```

**Body (pilih form-data):**
```
category_id: 1
seller_id: 1
name: Samsung Galaxy S23
description: Smartphone flagship Samsung
price: 12999000
stock: 50
weight: 168
is_active: true
image: [pilih file gambar - max 2MB, format: jpg/png/jpeg/gif]
```

**Cara di Postman:**
1. Pilih tab "Body"
2. Pilih "form-data"
3. Masukkan key-value seperti di atas
4. Untuk "image", ubah type dari "Text" ke "File", lalu pilih gambar

---

#### 3️⃣ GET ALL PRODUCTS

**Method:** `GET`  
**URL:** `http://localhost:8000/api/products`

**Headers:**
```
Accept: application/json
```

---

#### 4️⃣ GET ALL PRODUCTS (Dengan Filter)

**Filter by Category:**
```
GET http://localhost:8000/api/products?category_id=1
```

**Filter by Seller:**
```
GET http://localhost:8000/api/products?seller_id=1
```

**Search by Name:**
```
GET http://localhost:8000/api/products?search=samsung
```

**Filter Active Products:**
```
GET http://localhost:8000/api/products?is_active=true
```

**Kombinasi Filter:**
```
GET http://localhost:8000/api/products?category_id=1&search=samsung&is_active=true
```

---

#### 5️⃣ GET SINGLE PRODUCT

**Method:** `GET`  
**URL:** `http://localhost:8000/api/products/1`

**Response akan include:**
- Data product lengkap
- Data category
- Data seller

---

#### 6️⃣ UPDATE PRODUCT (Tanpa Gambar)

**Method:** `PUT`  
**URL:** `http://localhost:8000/api/products/1`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body:**
```json
{
  "name": "Samsung Galaxy S23 Ultra",
  "price": 15999000,
  "stock": 40
}
```

---

#### 7️⃣ UPDATE PRODUCT (Dengan Gambar Baru)

**Method:** `POST`  
**URL:** `http://localhost:8000/api/products/1`

**Headers:**
```
Accept: application/json
```

**Body (form-data):**
```
_method: PUT
name: Samsung Galaxy S23 Ultra
price: 15999000
stock: 40
image: [pilih file gambar baru]
```

⚠️ **Catatan:** Gambar lama akan otomatis terhapus!

---

#### 8️⃣ DELETE PRODUCT

**Method:** `DELETE`  
**URL:** `http://localhost:8000/api/products/1`

**Headers:**
```
Accept: application/json
```

⚠️ **Catatan:** Gambar akan otomatis terhapus dari storage!

---

## 📊 URUTAN TESTING YANG BENAR

### Step 1: Buat Data Master Dulu
```
1. Create Category (minimal 2-3 kategori)
2. Create Seller (minimal 2-3 seller)
3. Create Customer (minimal 2-3 customer)
```

### Step 2: Buat Produk
```
4. Create Product (gunakan category_id dan seller_id yang sudah dibuat)
```

### Step 3: Testing CRUD
```
5. Get All (Categories, Sellers, Customers, Products)
6. Get Single (by ID)
7. Update (edit data)
8. Delete (hapus data)
```

### Step 4: Testing Filter & Search
```
9. Filter products by category
10. Filter products by seller
11. Search products by name
12. Kombinasi filter
```

---

## ⚠️ TROUBLESHOOTING

### Error: "The category id field is required"
- Pastikan sudah buat Category dulu
- Gunakan `category_id` yang valid (cek dengan GET /api/categories)

### Error: "The seller id field is required"
- Pastikan sudah buat Seller dulu
- Gunakan `seller_id` yang valid (cek dengan GET /api/sellers)

### Error: "The email has already been taken"
- Email harus unique
- Gunakan email yang berbeda

### Error: "The phone has already been taken"
- Phone harus unique
- Gunakan nomor telepon yang berbeda

### Error: "The image must be an image"
- Pastikan file yang diupload adalah gambar (jpg, png, jpeg, gif)
- Maksimal ukuran 2MB

### Error: 404 Not Found
- Pastikan URL benar
- Pastikan ID yang digunakan ada di database

### Error: 500 Internal Server Error
- Cek `storage/logs/laravel.log` untuk detail error
- Pastikan migration sudah dijalankan
- Pastikan database connection benar

---

## 💡 TIPS POSTMAN

### 1. Simpan Request ke Collection
- Klik "Save" setelah buat request
- Buat collection baru: "My API Testing"
- Simpan semua request di collection tersebut

### 2. Gunakan Environment Variables
- Buat environment baru
- Set variable `base_url` = `http://localhost:8000/api`
- Gunakan `{{base_url}}/products` di URL

### 3. Gunakan Tests untuk Auto-Save ID
Di tab "Tests", tambahkan:
```javascript
if (pm.response.code === 200 || pm.response.code === 201) {
    var jsonData = pm.response.json();
    if (jsonData.data && jsonData.data.id) {
        pm.environment.set("last_id", jsonData.data.id);
    }
}
```

### 4. Export Collection
- Klik collection → Export
- Share dengan tim atau backup

---

## 🎯 CHECKLIST TESTING

### Categories
- [ ] Create category
- [ ] Get all categories
- [ ] Get single category
- [ ] Update category
- [ ] Delete category

### Sellers
- [ ] Create seller
- [ ] Get all sellers
- [ ] Get single seller
- [ ] Update seller
- [ ] Delete seller

### Customers
- [ ] Create customer
- [ ] Get all customers
- [ ] Get single customer
- [ ] Update customer
- [ ] Delete customer

### Products
- [ ] Create product (tanpa gambar)
- [ ] Create product (dengan gambar)
- [ ] Get all products
- [ ] Get single product
- [ ] Filter by category
- [ ] Filter by seller
- [ ] Search by name
- [ ] Update product (tanpa gambar)
- [ ] Update product (dengan gambar)
- [ ] Delete product

---

## 📞 BANTUAN

Jika masih ada error:
1. Cek `storage/logs/laravel.log`
2. Pastikan server Laravel running
3. Pastikan database sudah di-migrate
4. Cek response error message dari API

**Happy Testing! 🚀**
