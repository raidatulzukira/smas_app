<div align="center">

# 📦 SMAS — Sistem Manajemen Aset

**Aplikasi web berbasis Laravel untuk pengelolaan aset dan inventaris secara terpusat, efisien, dan aman.**

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

</div>

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi](#-instalasi)
- [Konfigurasi Database](#️-konfigurasi-database)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Akun Default](#-akun-default)
- [Struktur Proyek](#-struktur-proyek)
- [Menjalankan Testing](#-menjalankan-testing)
- [Kontribusi](#-kontribusi)

---

## 📖 Tentang Proyek

**SMAS (Sistem Manajemen Aset)** adalah aplikasi berbasis web yang dibangun menggunakan framework **Laravel 13** untuk membantu organisasi dalam mengelola aset dan inventaris mereka. Sistem ini menyediakan antarmuka yang bersih dan responsif untuk memantau, mencatat, dan mengelola data aset mulai dari pengadaan hingga penghapusan.

---

## ✨ Fitur Utama

| Fitur | Deskripsi |
|---|---|
| 🔐 **Autentikasi** | Login, Register, dan manajemen sesi menggunakan Laravel Breeze |
| 👤 **Role-Based Access** | Pemisahan hak akses berdasarkan level pengguna (`admin`) |
| 📦 **Manajemen Barang** | CRUD lengkap untuk data aset/item beserta kode, stok, merek, harga, dan gambar |
| 🗂️ **Manajemen Kategori** | Pengelompokan aset berdasarkan kategori |
| 🗑️ **Soft Delete** | Penghapusan data barang dan kategori yang aman (data tidak hilang permanen) |
| 👤 **Manajemen Profil** | Edit data profil pengguna yang sedang login |
| 📱 **Responsive UI** | Tampilan yang adaptif menggunakan Tailwind CSS |

---

## 🛠 Teknologi yang Digunakan

- **[Laravel 13](https://laravel.com/)** — PHP Framework utama
- **[PHP 8.3+](https://www.php.net/)** — Bahasa pemrograman server-side
- **[Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze)** — Starter kit autentikasi
- **[Tailwind CSS v3](https://tailwindcss.com/)** — Framework CSS utility-first
- **[Alpine.js v3](https://alpinejs.dev/)** — Framework JavaScript ringan
- **[Vite](https://vitejs.dev/)** — Bundler aset frontend
- **[MySQL / SQLite](https://www.mysql.com/)** — Database
- **[Pest PHP](https://pestphp.com/)** — Framework pengujian

---

## ⚙️ Persyaratan Sistem

Pastikan sistem Anda telah memenuhi persyaratan berikut sebelum melakukan instalasi:

| Kebutuhan | Versi Minimum |
|---|---|
| PHP | `^8.3` |
| Composer | `^2.x` |
| Node.js | `^18.x` atau lebih baru |
| NPM | `^9.x` atau lebih baru |
| MySQL | `^8.0` (atau SQLite) |
| Git | versi terbaru |

---

## 🚀 Instalasi

Ikuti langkah-langkah berikut secara berurutan untuk menjalankan proyek ini di lingkungan lokal Anda.

### 1. Clone Repository

Clone repositori ini ke direktori lokal Anda menggunakan Git:

```bash
git clone https://github.com/raidatulzukira/smas_app.git
```

Masuk ke direktori proyek:

```bash
cd smas_app
```

---

### 2. Install Dependensi PHP (Composer)

Jalankan perintah berikut untuk mengunduh dan menginstal seluruh paket PHP yang dibutuhkan:

```bash
composer install
```

> 💡 Proses ini akan membaca file `composer.json` dan mengunduh semua library yang diperlukan ke folder `vendor/`.

---

### 3. Salin File Konfigurasi Environment

Buat file `.env` dengan menyalin dari file contoh yang sudah tersedia:

```bash
cp .env.example .env
```

> ⚠️ File `.env` berisi konfigurasi sensitif (database, kunci aplikasi, dll.) dan **tidak** boleh di-commit ke repositori.

---

### 4. Generate Application Key

Buat kunci enkripsi unik untuk aplikasi Anda:

```bash
php artisan key:generate
```

Perintah ini akan mengisi nilai `APP_KEY` di file `.env` secara otomatis. Kunci ini digunakan Laravel untuk enkripsi session dan data lainnya.

---

### 5. Konfigurasi Database

Buka file `.env` dan sesuaikan pengaturan database dengan konfigurasi lokal Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smas_db
DB_USERNAME=root
DB_PASSWORD=
```

> **Menggunakan SQLite (opsional, lebih mudah untuk development):**
>
> ```env
> DB_CONNECTION=sqlite
> ```
> Kemudian buat file database-nya:
> ```bash
> touch database/database.sqlite
> ```

Pastikan database `smas_db` sudah dibuat di MySQL Anda sebelum lanjut ke langkah berikutnya:

```sql
CREATE DATABASE smas_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

### 6. Jalankan Migrasi Database

Buat seluruh tabel yang dibutuhkan aplikasi dengan menjalankan migrasi:

```bash
php artisan migrate
```

Perintah ini akan membuat tabel-tabel berikut secara otomatis:
- `users` — Data pengguna dan level akses
- `categories` — Data kategori aset
- `items` — Data aset/barang
- `cache`, `jobs`, `sessions` — Tabel sistem Laravel

---

### 7. Jalankan Database Seeder (Opsional)

Isi database dengan data awal (termasuk akun admin default):

```bash
php artisan db:seed
```

> Lihat bagian [Akun Default](#-akun-default) untuk informasi akun yang dibuat oleh seeder.

---

### 8. Install Dependensi JavaScript (NPM)

Unduh seluruh paket frontend yang diperlukan:

```bash
npm install
```

---

### 9. Build Aset Frontend

Kompilasi aset CSS dan JavaScript untuk production:

```bash
npm run build
```

Atau untuk development dengan hot-reload:

```bash
npm run dev
```

---

### 10. Buat Symbolic Link Storage (Opsional)

Jika aplikasi mengelola upload file/gambar, jalankan:

```bash
php artisan storage:link
```

---

## ▶️ Menjalankan Aplikasi

Setelah semua langkah instalasi selesai, jalankan server development Laravel:

```bash
php artisan serve
```

Buka browser Anda dan akses aplikasi di:

```
http://127.0.0.1:8000
```

### Menjalankan Semua Sekaligus (Development)

Anda juga dapat menjalankan server Laravel, queue, dan Vite secara bersamaan dengan satu perintah:

```bash
composer run dev
```

---

## 🔑 Akun Default

Setelah menjalankan `php artisan db:seed`, akun berikut akan tersedia untuk login:

| Field | Value |
|---|---|
| **Nama** | Test User |
| **Email** | `test@example.com` |
| **Password** | `password` |
| **Level** | `admin` |

> ⚠️ **Penting:** Segera ganti password akun default ini setelah login pertama kali, terutama di lingkungan production.

### URL Dashboard Admin

Setelah login sebagai admin, akses panel administrasi di:

```
http://127.0.0.1:8000/admin/dashboard
```

---

## 📁 Struktur Proyek

```
smas_app/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/              # Controller khusus admin
│   │   │   ├── CategoryController.php
│   │   │   ├── ItemController.php
│   │   │   └── ProfileController.php
│   │   └── Middleware/             # Middleware (termasuk checklevel)
│   ├── Models/
│   │   ├── Category.php            # Model Kategori
│   │   ├── Item.php                # Model Barang/Aset
│   │   └── User.php                # Model Pengguna
│   ├── Providers/
│   └── Services/
│
├── database/
│   ├── migrations/                 # File migrasi database
│   └── seeders/
│       └── DatabaseSeeder.php      # Seeder akun admin default
│
├── resources/
│   ├── css/                        # File CSS (Tailwind)
│   ├── js/                         # File JavaScript (Alpine.js)
│   └── views/                      # Template Blade
│
├── routes/
│   ├── web.php                     # Definisi route aplikasi
│   └── auth.php                    # Route autentikasi (Breeze)
│
├── .env.example                    # Template konfigurasi environment
├── composer.json                   # Dependensi PHP
├── package.json                    # Dependensi JavaScript
└── vite.config.js                  # Konfigurasi Vite
```

---

## 🧪 Menjalankan Testing

Proyek ini menggunakan **Pest PHP** sebagai framework pengujian. Jalankan seluruh test suite dengan perintah:

```bash
php artisan test
```

Atau menggunakan Composer:

```bash
composer run test
```

---

## 🤝 Kontribusi

Kontribusi sangat diterima dengan tangan terbuka! Untuk berkontribusi:

1. **Fork** repositori ini
2. Buat branch fitur baru: `git checkout -b fitur/nama-fitur`
3. Commit perubahan Anda: `git commit -m 'Menambahkan fitur X'`
4. Push ke branch: `git push origin fitur/nama-fitur`
5. Buka **Pull Request**

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

---

<div align="center">

Dibuat dengan ❤️ menggunakan [Laravel](https://laravel.com)

</div>
