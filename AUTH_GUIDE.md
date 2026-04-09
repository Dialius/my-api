# 🔐 PANDUAN AUTHENTICATION API

## 📋 Persiapan

Sistem authentication menggunakan **Laravel Sanctum** dengan token-based authentication.

---

## 🚀 CARA TESTING AUTHENTICATION

### 1️⃣ REGISTER (Daftar User Baru)

**Method:** `POST`  
**URL:** `http://localhost:8000/api/register`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body (raw JSON):**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Response Success (201):**
```json
{
  "success": true,
  "message": "User registered successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "created_at": "2026-02-12T10:00:00.000000Z",
      "updated_at": "2026-02-12T10:00:00.000000Z"
    },
    "access_token": "1|abcdefghijklmnopqrstuvwxyz...",
    "token_type": "Bearer"
  }
}
```

**⚠️ PENTING:** Simpan `access_token` untuk digunakan di request selanjutnya!

---

### 2️⃣ LOGIN (Masuk)

**Method:** `POST`  
**URL:** `http://localhost:8000/api/login`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body (raw JSON):**
```json
{
  "email": "john@example.com",
  "password": "password123"
}
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    },
    "access_token": "2|xyz123456789...",
    "token_type": "Bearer"
  }
}
```

**Response Error (401):**
```json
{
  "success": false,
  "message": "Email atau password salah"
}
```

---

### 3️⃣ GET USER PROFILE (Lihat Profil)

**Method:** `GET`  
**URL:** `http://localhost:8000/api/me`

**Headers:**
```
Accept: application/json
Authorization: Bearer YOUR_ACCESS_TOKEN_HERE
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "User profile",
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "email_verified_at": null,
    "created_at": "2026-02-12T10:00:00.000000Z",
    "updated_at": "2026-02-12T10:00:00.000000Z"
  }
}
```

---

### 4️⃣ LOGOUT (Keluar)

**Method:** `POST`  
**URL:** `http://localhost:8000/api/logout`

**Headers:**
```
Accept: application/json
Authorization: Bearer YOUR_ACCESS_TOKEN_HERE
```

**Response Success (200):**
```json
{
  "success": true,
  "message": "Logout successful"
}
```

---

## 🔑 CARA MENGGUNAKAN TOKEN DI POSTMAN

### Metode 1: Manual di Headers
Setiap request yang memerlukan authentication, tambahkan header:
```
Authorization: Bearer 1|abcdefghijklmnopqrstuvwxyz...
```

### Metode 2: Menggunakan Authorization Tab (Recommended)
1. Buka tab **Authorization**
2. Pilih Type: **Bearer Token**
3. Paste token di field **Token**
4. Postman akan otomatis menambahkan header `Authorization`

### Metode 3: Menggunakan Environment Variable (Best Practice)
1. Buat Environment baru di Postman
2. Tambahkan variable:
   - `base_url` = `http://localhost:8000/api`
   - `token` = (kosongkan dulu)
3. Setelah login/register, copy token dan paste ke variable `token`
4. Di Authorization tab, gunakan: `Bearer {{token}}`

---

## 📊 TESTING PROTECTED ENDPOINTS

Setelah login dan mendapat token, Anda bisa mengakses semua endpoint yang dilindungi:

### Categories (Perlu Token)
```
GET    http://localhost:8000/api/categories
POST   http://localhost:8000/api/categories
GET    http://localhost:8000/api/categories/{id}
PUT    http://localhost:8000/api/categories/{id}
DELETE http://localhost:8000/api/categories/{id}
```

### Sellers (Perlu Token)
```
GET    http://localhost:8000/api/sellers
POST   http://localhost:8000/api/sellers
GET    http://localhost:8000/api/sellers/{id}
PUT    http://localhost:8000/api/sellers/{id}
DELETE http://localhost:8000/api/sellers/{id}
```

### Customers (Perlu Token)
```
GET    http://localhost:8000/api/customers
POST   http://localhost:8000/api/customers
GET    http://localhost:8000/api/customers/{id}
PUT    http://localhost:8000/api/customers/{id}
DELETE http://localhost:8000/api/customers/{id}
```

### Products (Perlu Token)
```
GET    http://localhost:8000/api/products
POST   http://localhost:8000/api/products
GET    http://localhost:8000/api/products/{id}
PUT    http://localhost:8000/api/products/{id}
DELETE http://localhost:8000/api/products/{id}
```

**⚠️ PENTING:** Semua request di atas HARUS menyertakan token di header Authorization!

---

## ⚠️ ERROR RESPONSES

### 401 Unauthorized (Tidak ada token atau token salah)
```json
{
  "message": "Unauthenticated."
}
```
**Solusi:** Pastikan token valid dan masih aktif

### 422 Validation Error
```json
{
  "message": "The email field is required.",
  "errors": {
    "email": ["The email field is required."]
  }
}
```
**Solusi:** Periksa input sesuai validasi

---

## 💡 TIPS POSTMAN

### 1. Auto-Save Token Setelah Login
Di tab **Tests** pada request Login/Register, tambahkan script:
```javascript
if (pm.response.code === 200 || pm.response.code === 201) {
    var jsonData = pm.response.json();
    if (jsonData.data && jsonData.data.access_token) {
        pm.environment.set("token", jsonData.data.access_token);
        console.log("Token saved:", jsonData.data.access_token);
    }
}
```

### 2. Clear Token Setelah Logout
Di tab **Tests** pada request Logout, tambahkan:
```javascript
if (pm.response.code === 200) {
    pm.environment.unset("token");
    console.log("Token cleared");
}
```

### 3. Buat Collection dengan Pre-request Script
Tambahkan di Collection level:
```javascript
// Auto add token to all requests
if (pm.environment.get("token")) {
    pm.request.headers.add({
        key: "Authorization",
        value: "Bearer " + pm.environment.get("token")
    });
}
```

---

## 🎯 URUTAN TESTING YANG BENAR

### Step 1: Register & Login
```
1. Register user baru
2. Simpan token yang didapat
3. Atau login dengan user yang sudah ada
```

### Step 2: Test Protected Endpoints
```
4. Get user profile (/me)
5. Create category (dengan token)
6. Get all categories (dengan token)
7. Create seller (dengan token)
8. Create product (dengan token)
```

### Step 3: Test Logout
```
9. Logout (token akan dihapus)
10. Coba akses endpoint protected (harus error 401)
```

---

## 🔒 KEAMANAN

1. **Token bersifat personal** - Jangan share token ke orang lain
2. **Token tidak expire otomatis** - Logout untuk menghapus token
3. **Gunakan HTTPS di production** - Jangan gunakan HTTP
4. **Password minimal 8 karakter** - Gunakan password yang kuat

---

## 📞 TROUBLESHOOTING

### Error: "Unauthenticated"
- Pastikan token valid
- Pastikan format: `Bearer TOKEN` (ada spasi setelah Bearer)
- Pastikan token belum di-logout

### Error: "The password confirmation does not match"
- Pastikan `password` dan `password_confirmation` sama persis

### Error: "The email has already been taken"
- Email sudah terdaftar, gunakan email lain atau login

---

**Happy Testing! 🚀**
