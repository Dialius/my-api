# 🗄️ DATABASE STRUCTURE

## 📊 Entity Relationship Diagram (ERD)

```
CATEGORIES (1) ──hasMany──> PRODUCTS (many)
SELLERS (1) ──hasMany──> PRODUCTS (many)
PRODUCTS (many) ──belongsTo──> CATEGORIES (1)
PRODUCTS (many) ──belongsTo──> SELLERS (1)
```

---

## 🔗 Relasi Detail

### Categories → Products (One to Many)
- 1 Category bisa punya banyak Products
- Cascade delete: hapus category → hapus semua products-nya

### Sellers → Products (One to Many)
- 1 Seller bisa punya banyak Products
- Cascade delete: hapus seller → hapus semua products-nya

---

## 📋 Tabel Structure

### 1. CATEGORIES
```
id              bigint (PK)
uuid            string (unique)
name            string(100)
description     text (nullable)
slug            string(100, unique)
is_active       boolean
created_at      timestamp
updated_at      timestamp
```

### 2. CUSTOMERS
```
id              bigint (PK)
uuid            string (unique)
name            string(100)
email           string(100, unique)
phone           string(15, unique)
address         text (nullable)
gender          enum (male/female)
birth_date      date (nullable)
is_active       boolean
created_at      timestamp
updated_at      timestamp
```

### 3. PRODUCTS
```
id              bigint (PK)
uuid            string (unique)
category_id     bigint (FK → categories.id)
seller_id       bigint (FK → sellers.id)
name            string(150)
slug            string(150, unique)
description     text (nullable)
price           decimal(15,2)
stock           integer
sku             string(50, unique)
image           string (nullable)
weight          decimal(10,2) - dalam gram
is_active       boolean
created_at      timestamp
updated_at      timestamp
```

### 4. SELLERS
```
id              bigint (PK)
uuid            string (unique)
name            string(50)
address         string(255)
phone           string(15, unique)
email           string(50, unique)
store           string(20, unique)
created_at      timestamp
updated_at      timestamp
```

---

## 🎯 Auto-Generated Fields

- **UUID**: Semua tabel (format: 550e8400-e29b-41d4-a716-446655440000)
- **Slug**: Categories & Products (dari name, SEO friendly)
- **SKU**: Products (format: PRD-XXXXXXXX)

---

## 📊 Sample Data (Setelah Seeding)

- Categories: 8 items
- Customers: 5 items
- Products: 10 items
- Sellers: (dari seeder sebelumnya)

---
