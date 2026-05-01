<div align="center">

<img src="public/favicon.ico" alt="Logo Mediatama" width="80"/>

# 📦 SMAS — Sistem Manajemen Aset Sekolah

**Aplikasi web berbasis Laravel untuk pengelolaan aset dan inventaris Sekolah "Maju Bersama" secara terpusat, efisien, dan aman.**

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

</div>

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi Lengkap](#-instalasi-lengkap)
- [Konfigurasi Environment](#️-konfigurasi-environment)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Akun Default & Role](#-akun-default--role)
- [Dokumentasi Fitur Teknis](#-dokumentasi-fitur-teknis)
- [API Endpoint (Sanctum)](#-api-endpoint-sanctum)
- [Struktur Proyek](#-struktur-proyek)
- [Menjalankan Testing](#-menjalankan-testing)
- [Definition of Done](#-definition-of-done)

---

## 📖 Tentang Proyek

**SMAS (Sistem Manajemen Aset Sekolah)** adalah prototipe aplikasi berbasis web yang dibangun menggunakan **Laravel 13** untuk membantu Sekolah "Maju Bersama" dalam mencatat dan mengelola aset digital maupun fisik mereka — seperti Laptop, Proyektor, dan Lisensi Software. Sistem ini mencakup autentikasi berbasis role, manajemen file, serta API endpoint yang diamankan dengan Laravel Sanctum.

---

## ✨ Fitur Utama

| # | Fitur | Deskripsi |
|---|---|---|
| 1 | 🔐 **Autentikasi Lengkap** | Login, Register, Logout, dan Reset Password via Laravel Breeze |
| 2 | 👤 **Role-Based Access Control** | Custom Middleware `CheckLevel` membatasi akses berdasarkan `level` user |
| 3 | 📦 **Manajemen Barang (CRUD)** | Tambah, lihat, edit, hapus barang |
| 4 | 🗂️ **Manajemen Kategori (CRUD)** | Pengelompokan aset ke dalam kategori |
| 5 | 🗑️ **Soft Delete** | Penghapusan data yang aman — data tetap ada di database, hanya terisi `deleted_at` |
| 6 | 🖼️ **Upload Gambar Aset** | Upload gambar hingga **20MB**, tersimpan di `storage/app/public` |
| 7 | 🛡️ **3 Authentication Guards** | Guard `web`, `admin`, dan `api` (Sanctum) terkonfigurasi di `config/auth.php` |
| 8 | 🎨 **Custom Error 404** | Halaman 404 bertema SMAS dengan tautan kembali ke dashboard |

---

## 🛠 Teknologi yang Digunakan

| Teknologi | Versi | Kegunaan |
|---|---|---|
| [Laravel](https://laravel.com/) | `^13.0` | PHP Framework utama |
| [PHP](https://www.php.net/) | `^8.3` | Bahasa pemrograman server-side |
| [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze) | `^2.4` | Starter kit autentikasi (Login, Register, Reset PW) |
| [Tailwind CSS](https://tailwindcss.com/) | `^3.1` | Framework CSS utility-first |
| [Alpine.js](https://alpinejs.dev/) | `^3.4` | Framework JavaScript ringan untuk interaktivitas UI |
| [Vite](https://vitejs.dev/) | `^8.0` | Bundler aset frontend |
| [MySQL](https://www.mysql.com/) | `^8.0` | Database relasional |

---

## ⚙️ Persyaratan Sistem

Pastikan sistem Anda memenuhi persyaratan berikut sebelum instalasi:

| Kebutuhan | Versi Minimum |
|---|---|
| PHP | `^8.3` |
| Composer | `^2.x` |
| MySQL | `^8.0` |
| Git | Versi terbaru |

---

## 🚀 Instalasi Lengkap

Ikuti semua langkah berikut secara **berurutan** untuk menjalankan proyek di lingkungan lokal Anda.

---

### Langkah 1 — Clone Repository

```bash
git clone https://github.com/raidatulzukira/smas_app.git
cd smas_app
```

---

### Langkah 2 — Install Dependensi PHP (Composer)

Mengunduh semua paket PHP yang dibutuhkan berdasarkan `composer.json`:

```bash
composer install
```

> Ini akan membuat folder `vendor/` beserta seluruh isinya.

---

### Langkah 3 — Salin File Konfigurasi Environment

```bash
cp .env.example .env
```

> File `.env` berisi konfigurasi sensitif. **Jangan di-commit ke Git.**

---

### Langkah 4 — Generate Application Key

```bash
php artisan key:generate
```

> Mengisi nilai `APP_KEY` di `.env` secara otomatis. Kunci ini digunakan untuk enkripsi session, cookie, dan data terenkripsi lainnya.

---

### Langkah 5 — Konfigurasi Database

Buat database MySQL terlebih dahulu:

```sql
CREATE DATABASE smas_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Lalu buka file `.env` dan sesuaikan bagian berikut:

```env
APP_NAME="SMAS - Sistem Manajemen Aset Sekolah"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smas_db
DB_USERNAME=root
DB_PASSWORD=
```

---

### Langkah 6 — Konfigurasi Email untuk Reset Password

Fitur **Reset Password** membutuhkan konfigurasi email. Untuk development, gunakan salah satu opsi berikut:

**Opsi B — Mailtrap (simulasi inbox):**
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_FROM_ADDRESS="noreply@smas.sch.id"
MAIL_FROM_NAME="SMAS App"
```

---

### Langkah 7 — Jalankan Migrasi Database

Membuat semua tabel yang dibutuhkan aplikasi:

```bash
php artisan migrate
```

Tabel yang akan dibuat secara otomatis:

| Tabel | Keterangan |
|---|---|
| `users` | Data pengguna + kolom `level` untuk role |
| `categories` | Kategori aset dengan Soft Delete |
| `items` | Data aset/barang (dibuat via 8 file migrasi bertahap) |
| `password_reset_tokens` | Token reset password |
| `cache`, `jobs`, `sessions` | Tabel sistem Laravel |

> Jika ingin mengulangi migrasi dari awal: `php artisan migrate:fresh`

---

### Langkah 8 — Jalankan Database Seeder

Mengisi database dengan akun admin default:

```bash
php artisan db:seed
```

---

### Langkah 9 — Install Dependensi JavaScript (NPM)

```bash
npm install
```

---

### Langkah 10 — Build Aset Frontend

Untuk **production** (kompilasi sekali):
```bash
npm run build
```

Untuk **development** (dengan hot-reload saat mengubah file):
```bash
npm run dev
```

---

### Langkah 11 — Buat Symbolic Link Storage ⚠️ WAJIB

**Langkah ini wajib dijalankan** agar gambar aset yang diupload dapat tampil di browser:

```bash
php artisan storage:link
```

> Perintah ini membuat symlink dari `public/storage` → `storage/app/public`, sehingga file yang tersimpan di `storage/app/public/assets/items/` bisa diakses via URL `http://localhost:8000/storage/assets/items/`.

---

## ▶️ Menjalankan Aplikasi

### Cara 1 — Server Laravel Saja

```bash
php artisan serve
```

Akses di browser: **http://127.0.0.1:8000**

---

---

## 🔑 Akun Default & Role

Setelah menjalankan `php artisan db:seed`:

| Field | Value |
|---|---|
| **Nama** | Test User |
| **Email** | `test@example.com` |
| **Password** | `password` |
| **Level / Role** | `admin` |

> ⚠️ **Segera ganti password** akun ini setelah login pertama, terutama di environment production.

### Halaman yang Dapat Diakses

| URL | Akses | Keterangan |
|---|---|---|
| `/` | Publik | Halaman selamat datang |
| `/login` | Tamu | Form login |
| `/register` | Tamu | Form registrasi |
| `/forgot-password` | Tamu | Form lupa password |
| `/admin/dashboard` | Admin | Dashboard utama |
| `/admin/items` | Admin | Daftar barang/aset |
| `/admin/items/create` | Admin | Tambah barang baru |
| `/admin/categories` | Admin | Kelola kategori |

---

## 📚 Dokumentasi Fitur Teknis

Bagian ini menjelaskan implementasi teknis untuk setiap tugas pada soal ujian.

---

### Tugas 1 — Service Container & Dependency Injection

**`FileManagementService`** (`app/Services/FileManagementService.php`) adalah class service yang bertanggung jawab atas penyimpanan file ke storage.

Service ini didaftarkan ke **Service Container** di `app/Providers/AppServiceProvider.php`:

```php
public function register(): void
{
    $this->app->bind(\App\Services\FileManagementService::class, function ($app) {
        return new \App\Services\FileManagementService();
    });
}
```

Service kemudian di-inject (Dependency Injection) secara otomatis oleh Laravel ke dalam `ItemController`:

```php
public function store(Request $request, FileManagementService $fileService)
{
    // ...
    if ($request->hasFile('image')) {
        $data['image'] = $fileService->saveFile($request->file('image'), 'assets/items');
    }
}
```

---

### Tugas 2 — Migrasi Database Bertahap (5 Perubahan)

Tabel `items` dibentuk melalui **8 file migrasi terpisah**, masing-masing bisa di-rollback secara independen:

| # | File Migrasi | Perubahan |
|---|---|---|
| 1 | `2026_04_29_125920_create_items_table.php` | Membuat tabel `items` awal |
| 2 | `2026_04_29_130148_add_brand_to_items_table.php` | Menambah kolom `brand` |
| 3 | `2026_04_29_130343_add_description_to_items_table.php` | Menambah kolom `description` |
| 4 | `2026_04_29_130504_change_stock_type_in_items_table.php` | Mengubah tipe data kolom `stock` |
| 5 | `2026_04_29_134056_add_name_to_items_table.php` | Menambah kolom `item_name` |
| 6 | `2026_04_29_134245_add_price_to_items_table.php` | Menambah kolom `price` |
| 7 | `2026_04_30_153016_add_soft_delete_to_item_table.php` | Menambah kolom `deleted_at` |
| 8 | `2026_04_30_153031_add_soft_delete_to_categories_table.php` | Menambah `deleted_at` di kategori |

Untuk melakukan rollback migrasi terakhir:
```bash
php artisan migrate:rollback
```

Untuk rollback sejumlah langkah tertentu:
```bash
php artisan migrate:rollback --step=3
```

---

### Tugas 3 — Model Eloquent (Soft Delete, Relasi, Accessor & Mutator)

**Soft Delete** — data yang dihapus tidak hilang dari database, hanya kolom `deleted_at` yang terisi:

```php
// Model Item & Category menggunakan SoftDeletes
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model {
    use SoftDeletes;
}
```

**Relasi Eloquent:**
```php
// Item → belongsTo → Category
public function category(): BelongsTo {
    return $this->belongsTo(Category::class);
}
```

---

### Tugas 4 — Routing, Middleware & Custom Error 404

**Route Group Admin** dengan prefix `/admin` dan middleware `auth` + `checklevel:admin`:

```php
Route::middleware(['auth', 'checklevel:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::resource('items', ItemController::class);
    Route::resource('categories', CategoryController::class);
});
```

**Custom Middleware `CheckLevel`** (`app/Http/Middleware/CheckLevel.php`) memeriksa kolom `level` pada user. Jika tidak sesuai, session dihentikan dan akses ditolak dengan error 403.

Middleware didaftarkan di `bootstrap/app.php`:
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'checklevel' => \App\Http\Middleware\CheckLevel::class,
    ]);
})
```

**Custom Error 404** tersedia di `resources/views/errors/404.blade.php` dengan tampilan bertema SMAS.

---

### Tugas 5 — Form, Validasi & Storage

Form **Edit Barang** menerapkan validasi lengkap:

```php
$request->validate([
    'item_kode' => ['required', Rule::unique('items','item_kode')->ignore($item->id)],
    'image'     => 'nullable|image|mimes:jpg,jpeg,png|max:20480', // Maks 20MB
], [
    'item_kode.unique' => 'Kode item sudah digunakan oleh barang lain.',
    'image.max'        => 'Ukuran gambar maksimal adalah 20MB.',
]);
```

File gambar dikelola menggunakan class `Storage`:
```php
// Simpan gambar baru
$path = $request->file('image')->store('assets/items', 'public');

// Hapus gambar lama sebelum diganti
Storage::disk('public')->delete($item->image);
```

> ⚠️ Pastikan `php artisan storage:link` sudah dijalankan agar gambar tampil di browser.

---

### Tugas 6 — Blade Engine & Keamanan XSS

Aplikasi menggunakan **Template Inheritance** Blade secara konsisten:

```blade
@extends('layouts.app')

@section('content')
    @include('components.alert')

    @forelse($items as $item)
        <tr>...</tr>
    @empty
        <tr><td colspan="6">Belum ada barang.</td></tr>
    @endforelse
@endsection
```

**Halaman Uji XSS** tersedia di `/security-check`. Halaman ini mendemonstrasikan:

| Sintaks Blade | Output | Status |
|---|---|---|
| `{{ $data }}` | `&lt;script&gt;alert(...)&lt;/script&gt;` (teks biasa) | ✅ **Aman** — di-escape oleh Laravel |
| `{!! $data !!}` | Script **dieksekusi** oleh browser | ❌ **Berbahaya** — tidak di-escape |

> **Kesimpulan:** Selalu gunakan `{{ }}` untuk menampilkan data dari pengguna. Gunakan `{!! !!}` hanya untuk konten HTML yang sudah dipercaya dan dibersihkan.

---

### Tugas 7 — Authentication Guards & Reset Password

**3 Authentication Guards** terdefinisi di `config/auth.php`:

| Guard | Driver | Provider | Kegunaan |
|---|---|---|---|
| `web` | `session` | `users` | Guard default untuk pengguna umum |
| `admin` | `session` | `admins` | Guard khusus akses admin |
| `api` | `sanctum` | `users` | Guard untuk REST API dengan token |

**Fitur Reset Password** sudah aktif via Laravel Breeze. Alur penggunaannya:
1. Buka halaman `/forgot-password`
2. Masukkan email yang terdaftar
3. Link reset dikirim ke email (atau dicatat di `storage/logs/laravel.log` jika pakai driver `log`)
4. Klik link → isi password baru di halaman `/reset-password/{token}`

---

### GET /api/items — Daftar Semua Barang

Mengambil seluruh data barang yang aktif (tidak di-soft-delete).

**Response sukses (200 OK):**
```json
{
    "data": [
        {
            "id": 1,
            "item_kode": "LPT-001",
            "item_name": "Laptop Asus VivoBook",
            "brand": "Asus",
            "stock": 10,
            "price": "8500000",
            "category": {
                "id": 1,
                "name": "Elektronik"
            }
        }
    ]
}
```
---

## 📁 Struktur Proyek

```
smas_app/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/                     # Controller autentikasi (Breeze)
│   │   │   ├── CategoryController.php    # CRUD Kategori
│   │   │   ├── ItemController.php        # CRUD Barang + upload gambar
│   │   │   └── ProfileController.php     # Manajemen profil
│   │   └── Middleware/
│   │       └── CheckLevel.php            # Custom middleware role-based access
│   ├── Models/
│   │   ├── Category.php                  # Model Kategori (SoftDeletes, hasMany)
│   │   ├── Item.php                      # Model Barang (SoftDeletes, Accessor, Mutator)
│   │   └── User.php                      # Model Pengguna (kolom level)
│   ├── Providers/
│   │   └── AppServiceProvider.php        # Registrasi FileManagementService
│   └── Services/
│       └── FileManagementService.php     # Service penyimpanan file
│
├── config/
│   └── auth.php                          # Konfigurasi 3 guards (web, admin, api)
│
├── database/
│   ├── migrations/                       # 13 file migrasi (8 untuk tabel items)
│   └── seeders/
│       └── DatabaseSeeder.php            # Seeder akun admin default
│
├── resources/
│   ├── css/                              # File CSS (Tailwind)
│   ├── js/                              # File JavaScript (Alpine.js)
│   └── views/
│       ├── errors/
│       │   └── 404.blade.php            # Halaman error 404 kustom
│       ├── items/                        # View CRUD barang
│       ├── categories/                   # View CRUD kategori
│       ├── layouts/                      # Layout utama (template inheritance)
│       └── security-check.blade.php     # Demonstrasi uji XSS
│
├── routes/
│   ├── web.php                           # Route web utama (admin group, XSS check)
│
├── storage/
│   └── app/public/assets/items/          # Folder penyimpanan gambar aset
│
├── .env.example                          # Template konfigurasi
├── composer.json                         # Dependensi PHP
├── package.json                          # Dependensi JavaScript
└── vite.config.js                        # Konfigurasi Vite
```

---

---

## ✅ Definition of Done

Checklist verifikasi sebelum mengumpulkan proyek:

- [ ] Aplikasi berjalan tanpa error setelah `php artisan migrate`
- [ ] Login dengan `test@example.com` / `password` berhasil dan diarahkan ke dashboard admin
- [ ] Halaman `/admin/items` menampilkan daftar barang dengan pagination
- [ ] Form tambah dan edit barang berfungsi, termasuk upload gambar
- [ ] Gambar aset berhasil ditampilkan di browser (symlink aktif)
- [ ] Data yang di-delete **tidak hilang** dari database — hanya kolom `deleted_at` yang terisi
- [ ] Halaman `/security-check` menampilkan demonstrasi XSS
- [ ] Halaman error 404 menampilkan tampilan kustom bertema SMAS
- [ ] Reset Password berfungsi (link tercatat di log atau Mailtrap)
- [ ] Logo Mediatama tampil di halaman aplikasi

---

<div align="center">

Dibuat untuk **Ujian Praktik Backend Developer** — Sistem Manajemen Aset Sekolah (SMAS)

🏫 Sekolah "Maju Bersama" | Dibangun dengan ❤️ menggunakan [Laravel](https://laravel.com)

</div>
