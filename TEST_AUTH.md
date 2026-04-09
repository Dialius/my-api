# 🧪 QUICK TEST AUTHENTICATION

## Test di Postman:

### 1. REGISTER USER BARU
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

### 2. LOGIN
```
POST http://localhost:8000/api/login

Headers:
Content-Type: application/json
Accept: application/json

Body (raw JSON):
{
  "email": "test@example.com",
  "password": "password123"
}
```

**Simpan token yang didapat!**

### 3. GET PROFILE (Perlu Token)
```
GET http://localhost:8000/api/me

Headers:
Accept: application/json
Authorization: Bearer YOUR_TOKEN_HERE
```

### 4. CREATE CATEGORY (Perlu Token)
```
POST http://localhost:8000/api/categories

Headers:
Content-Type: application/json
Accept: application/json
Authorization: Bearer YOUR_TOKEN_HERE

Body (raw JSON):
{
  "name": "Fashion",
  "description": "Pakaian dan aksesoris",
  "is_active": true
}
```

### 5. LOGOUT (Perlu Token)
```
POST http://localhost:8000/api/logout

Headers:
Accept: application/json
Authorization: Bearer YOUR_TOKEN_HERE
```

---

## Test Tanpa Token (Harus Error 401)
```
GET http://localhost:8000/api/categories

Response:
{
  "message": "Unauthenticated."
}
```

---

## ✅ Checklist Testing:
- [ ] Register user baru berhasil
- [ ] Login berhasil dan dapat token
- [ ] Get profile dengan token berhasil
- [ ] Create category dengan token berhasil
- [ ] Akses tanpa token dapat error 401
- [ ] Logout berhasil
- [ ] Akses dengan token yang sudah logout dapat error 401
