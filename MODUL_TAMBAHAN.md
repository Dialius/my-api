# MODUL TAMBAHAN: MASTERY BACKEND LARAVEL API
Berikut adalah materi pelengkap untuk minggu-minggu yang belum tertulis di roadmap.

---

## BAGIAN 10: API RESOURCES (Minggu 13)
**Tujuan:** Mengubah format data yang diambil dari database menjadi JSON yang standar dan rapi sebelum dikirim ke pengguna. Hal ini menghindari tereksposnya nama kolom database asli dan memungkinkan kita memformat data (misal: format mata uang).

### 10.1 Masalah Tanpa Resource
Saat kita melakukan `return $product`, Laravel mengembalikan semua kolom mentah-mentah, termasuk `created_at` dan `updated_at` yang mungkin tidak dibutuhkan user.

### 10.2 Membuat Resource
Kita buat "cetakan" pembungkus data produk.
```bash
php artisan make:resource ProductResource
```

### 10.3 Edit File Resource
Buka `app/Http/Resources/ProductResource.php`. Ubah method `toArray`:

```php
public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'nama_barang' => $this->name, // Bisa ubah nama key sesuka hati
        'harga' => $this->price,
        'harga_rupiah' => 'Rp ' . number_format($this->price, 0, ',', '.'), // Custom format
        'stok' => $this->stock,
        'kategori' => new CategoryResource($this->whenLoaded('category')), // Nested Resource
        // created_at tidak kita sertakan
    ];
}
```
*Catatan: Anda perlu membuat `CategoryResource` terlebih dahulu jika ingin menggunakannya di atas.*

### 10.4 Gunakan di Controller
Update `ProductController.php`:
```php
use App\Http\Resources\ProductResource;

public function index()
{
    $products = Product::with('category')->latest()->paginate(10);
    // Otomatis membungkus dengan format 'data' dan meta pagination
    return ProductResource::collection($products);
}

public function show($id)
{
    $product = Product::find($id);
    if (!$product) return response()->json(['message' => 'Not Found'], 404);
    
    return new ProductResource($product);
}
```

---

## BAGIAN 11: EVALUASI TENGAH SEMESTER (Minggu 15)
**Mini Project: Sistem Sederhana Pilihanmu**

**Waktu Pengerjaan:** 1 Minggu
**Tujuan:** Menguji pemahaman tentang Migration, Model, Relasi, dan Basic CRUD.

### Instruksi
Buatlah sebuah sistem API sederhana dengan minimal:
1.  **Dua Tabel yang Berelasi** (One to Many).
2.  **CRUD Lengkap** untuk kedua tabel.
3.  **Validasi** input.

*Contoh Ide:*
*   Sistem Peminjaman Buku (Anggota & Buku)
*   Sistem Absensi (Siswa & Kehadiran)
*   Sistem Penjualan (Pelanggan & Pesanan)

Silakan kerjakan sebagai latihan mandiri sebelum masuk ke materi Final Project.

### 11.1 Tugas Tambahan (Request Guru)
**Fitur: Data Seller (Penjual)**
Implementasi CRUD untuk tabel sellers sesuai request.
*   **Endpoint**: `/api/sellers`
*   **Kolom**: `uuid`, `name`, `address`, `phone`, `email`, `store`
*   **Validasi**: Email, Phone, dan Store harus unik.

---

## BAGIAN 12: ERROR HANDLING & FORM REQUEST (Minggu 17)
**Tujuan:** Memisahkan validasi dari Controller agar kode lebih bersih (Clean Code) dan membuat pesan error lebih ramah.

### 12.1 Membuat Form Request
Daripada validasi menumpuk di controller, kita pindahkan.
```bash
php artisan make:request StoreProductRequest
```

### 12.2 Setup Request
Buka `app/Http/Requests/StoreProductRequest.php`:
```php
public function authorize(): bool
{
    return true; // Ubah jadi true agar bisa dipakai
}

public function rules(): array
{
    return [
        'name' => 'required|min:3',
        'price' => 'required|numeric|min:1000',
        'category_id' => 'required|exists:categories,id'
    ];
}

// Custom pesan error (Opsional)
public function messages(): array
{
    return [
        'name.required' => 'Nama produk wajib diisi bang!',
        'price.min' => 'Harga kemurahan, minimal seceng.'
    ];
}
```

### 12.3 Pakai di Controller
Ganti `Request` biasa dengan class baru kita.
```php
use App\Http\Requests\StoreProductRequest;

public function store(StoreProductRequest $request)
{
    // Tidak perlu $validator->make lagi, otomatis divalidasi laravel.
    // Jika gagal, otomatis return response JSON 422.
    
    $product = Product::create($request->validated()); // Pakai data yang sudah valid saja
    
    return new ProductResource($product);
}
```

### 12.4 Global Error Handling (Model Not Found)
Jika user akses `/api/products/9999` (ID ga ada), Laravel bawaan melempar error HTML. Kita ubah jadi JSON.
Di Laravel 11 (`bootstrap/app.php`):
```php
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

->withExceptions(function (Exceptions $exceptions) {
    $exceptions->render(function (NotFoundHttpException $e, Request $request) {
        if ($request->is('api/*')) {
            return response()->json([
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }
    });
})
```

---

## BAGIAN 13: DEPLOYMENT (Minggu 22)
**Tujuan:** Mengupload API ke internet (Shared Hosting / VPS) agar bisa diakses publik.

### 13.1 Persiapan Aplikasi (Local)
1.  Pastikan tidak ada error di local.
2.  Jalankan optimasi:
    ```bash
    composer install --optimize-autoloader --no-dev
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

### 13.2 Upload ke Hosting (cPanel / Shared Hosting)
Cara paling umum untuk pemula:

1.  **File Zip**: Zip seluruh folder project laravel kamu **KECUALI** folder `node_modules` dan `vendor`. (Vendor nanti diinstall ulang atau ikut diupload jika koneksi cepat, tapi lebih aman install ulang via terminal hosting jika ada akses SSH). Jika tidak ada SSH, upload folder `vendor` juga.
2.  **Struktur Folder**:
    *   Buat folder baru di root directory hosting (sejajar dengan `public_html`), misal: `laravel_api`.
    *   Upload dan Extract isi project di sana.
    *   Pindahkan **ISI** folder `public` (index.php, .htaccess, robots.txt, dll) ke dalam folder `public_html` (atau subfoldernya jika pakai subdomain).
3.  **Edit index.php**:
    Buka file `index.php` yang sudah dipindah ke `public_html`. Edit jalur pemanggilannya:
    ```php
    // Lama
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';

    // Baru (Sesuaikan mundur berapa folder ke folder project)
    require __DIR__.'/../laravel_api/vendor/autoload.php';
    $app = require_once __DIR__.'/../laravel_api/bootstrap/app.php';
    ```

### 13.3 Konfigurasi Environment & Database
1.  Buat Database MySQL baru di panel hosting.
2.  Di folder `laravel_api`, rename `.env.example` jadi `.env` (atau edit file .env yang sudah ada).
3.  Ubah config penting:
    ```env
    APP_ENV=production
    APP_DEBUG=false  <-- PENTING! Agar error tidak mengekspos kodemu
    DB_DATABASE=nama_db_hosting
    DB_USERNAME=user_db_hosting
    DB_PASSWORD=pass_db_hosting
    ```
4.  Jalankan migrasi (jika ada akses terminal):
    `php artisan migrate`
    *Jika tidak ada terminal*, export database local (file .sql) lalu import via PHPMyAdmin di hosting.

### 13.4 Storage Link
Agar gambar bisa diakses, folder `storage/app/public` harus terhubung ke `public_html/storage`.
Jalankan di terminal hosting:
```bash
ln -s /path/to/laravel_api/storage/app/public /path/to/public_html/storage
```
Atau jika tanpa akses terminal, gunakan route khusus di `routes/web.php` untuk sekali jalan:
```php
Route::get('/link-storage', function () {
    Artisan::call('storage:link');
    return 'Link berhasil!';
});
```
Buka `namadomainmu.com/link-storage`, lalu hapus route itu segera.
