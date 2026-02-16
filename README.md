# Sistem Informasi Web Masjid Taqwa

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-3-orange?style=for-the-badge&logo=filament&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

> Sistem Informasi Manajemen Masjid berbasis web untuk memodernisasi pengelolaan data masjid, transparansi keuangan, dan penyebaran informasi kepada jamaah.

---

## 📋 Daftar Isi

- [Tentang Project](#-tentang-project)
- [Fitur Utama](#-fitur-utama)
- [Teknologi](#-teknologi)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi](#-instalasi)
- [Penggunaan](#-penggunaan)
- [Struktur Database](#-struktur-database)
- [Dokumentasi Teknis](#-dokumentasi-teknis)
- [Keamanan](#-keamanan)
- [Kontribusi](#-kontribusi)
- [Lisensi](#-lisensi)

---

## 🕌 Tentang Project

Sistem Informasi Web Masjid Taqwa adalah aplikasi web modern yang dirancang untuk memfasilitasi pengelolaan masjid secara digital. Sistem ini memisahkan antara:

- **Frontend (Publik)**: Interface untuk jamaah mengakses informasi jadwal, keuangan, dan kegiatan masjid
- **Backend (Admin Panel)**: Dashboard khusus pengurus DKM untuk mengelola semua konten dan data

Sistem ini dikembangkan dengan tujuan meningkatkan transparansi, efisiensi pengelolaan, dan kemudahan akses informasi bagi jamaah.

---

## ✨ Fitur Utama

### 🌐 Halaman Publik (Frontend)

#### 🏠 Beranda
- **Jadwal Sholat Live**: Menampilkan 5 waktu sholat harian dengan deteksi otomatis hari Jumat (kolom "Dzuhur" berubah menjadi "Jum'at")
- **Smart Friday Card**: Informasi petugas Jumat terdekat (Khatib & Imam) dengan tabel agenda Jumat mendatang
- **Dashboard Keuangan Real-time**: 
  - Saldo Kas Masjid & Santunan Anak Yatim
  - 6 riwayat transaksi terakhir
- **Kegiatan Terbaru**: Grid 3 berita/kegiatan terbaru

#### 📅 Jadwal Jumat Lengkap
- Arsip dan jadwal masa depan petugas Jumat
- Format tabel dengan pagination

#### 💰 Laporan Keuangan Transparan
- Detail transaksi masuk dan keluar
- Indikator warna: 🟢 Hijau (Pemasukan) | 🔴 Merah (Pengeluaran)
- Pemisahan kategori dana (Masjid vs Yatim)

#### 📰 Berita & Kegiatan
- Arsip berita dalam format grid
- Halaman detail artikel dengan gambar besar
- Rekomendasi berita terkait

### 🔐 Panel Admin (Backend)

#### ⏰ Manajemen Jadwal Sholat
- Input jadwal Subuh hingga Isya
- **Fitur Duplikat**: Salin jadwal hari ini ke tanggal lain dengan satu klik

#### 🕌 Manajemen Jadwal Jumat
- Input Nama Khatib dan Imam
- Terpisah dari jadwal harian untuk struktur data yang lebih baik

#### 💵 Manajemen Keuangan
- Input Pemasukan/Pengeluaran
- Pemilihan kategori (Masjid/Yatim) untuk perhitungan saldo otomatis
- Tracking real-time saldo per kategori

#### 📝 Manajemen Artikel
- Rich Text Editor untuk menulis pengumuman/berita
- Upload gambar dokumentasi
- Slug otomatis untuk SEO-friendly URLs

---

## 🛠 Teknologi

- **Backend Framework**: Laravel 11 (MVC Pattern)
- **Admin Panel**: FilamentPHP v3
- **Frontend Styling**: Tailwind CSS (Blade Templates)
- **Database**: MySQL
- **Asset Bundler**: Vite
- **Authentication**: Laravel Sanctum / Filament Auth

---

## 📦 Persyaratan Sistem

Pastikan sistem Anda memenuhi persyaratan berikut:

- PHP >= 8.2
- Composer
- Node.js >= 16.x
- NPM atau Yarn
- MySQL >= 5.7 atau MariaDB >= 10.3
- Web Server (Apache/Nginx) atau Laravel's built-in server

---

## 🚀 Instalasi

### 1️⃣ Clone Repository

```bash
git clone https://github.com/username/web-masjid.git
cd web-masjid
```

### 2️⃣ Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3️⃣ Konfigurasi Environment

Duplikat file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_masjid
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Generate Key & Setup Storage

```bash
# Generate application key
php artisan key:generate

# Create symbolic link untuk storage
php artisan storage:link
```

> ⚠️ **Penting**: Perintah `storage:link` wajib dijalankan agar gambar kegiatan dapat ditampilkan dengan benar.

### 5️⃣ Migrasi Database & Seeding

Jalankan perintah berikut untuk membuat tabel dan mengisi data dummy (Jadwal, Keuangan, Berita):

```bash
php artisan migrate:fresh --seed
```

### 6️⃣ Jalankan Development Server

Buka **dua terminal terpisah**:

**Terminal 1 - Laravel Server:**
```bash
php artisan serve
```

**Terminal 2 - Vite Assets (Hot Reload):**
```bash
npm run dev
```

Akses aplikasi di browser: **http://localhost:8000**

---

## 🔑 Akun Login Default

Untuk mengakses panel admin:

- **URL**: `/admin`
- **Email**: `admin@admin.com`
- **Password**: `password`

> 🔒 **Keamanan**: Segera ubah kredensial default setelah instalasi pertama!

---

## 📖 Penggunaan

### Untuk Jamaah (Publik)

1. **Lihat Jadwal Sholat**: Kunjungi halaman beranda untuk melihat jadwal sholat hari ini
2. **Cek Keuangan**: Scroll ke bagian Dashboard Keuangan untuk transparansi keuangan masjid
3. **Baca Berita**: Klik pada kartu kegiatan untuk membaca detail artikel
4. **Lihat Jadwal Jumat**: Navigasi ke menu "Jadwal Jumat" untuk melihat petugas Jumat

### Untuk Pengurus DKM (Admin)

1. **Login**: Akses `/admin` dan login dengan kredensial
2. **Kelola Jadwal**: 
   - Gunakan menu "Prayer Schedules" untuk jadwal harian
   - Gunakan menu "Friday Schedules" untuk jadwal Jumat
   - Manfaatkan tombol "Duplicate" untuk menyalin jadwal
3. **Kelola Keuangan**:
   - Tambah transaksi melalui menu "Finances"
   - Pilih tipe (Pemasukan/Pengeluaran) dan kategori (Masjid/Yatim)
4. **Kelola Berita**:
   - Buat artikel baru melalui menu "Activities"
   - Upload gambar dan tulis konten dengan Rich Text Editor

---

## 🗄 Struktur Database

### Tabel: `prayer_schedules`
Menyimpan jadwal sholat harian.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | BigInt | Primary Key |
| `date` | Date | Tanggal (Unique) |
| `subuh` | Time | Waktu Subuh |
| `dzuhur` | Time | Waktu Dzuhur/Jumat |
| `ashar` | Time | Waktu Ashar |
| `maghrib` | Time | Waktu Maghrib |
| `isya` | Time | Waktu Isya |

### Tabel: `friday_schedules`
Menyimpan jadwal petugas Jumat.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | BigInt | Primary Key |
| `date` | Date | Tanggal Jumat (Unique) |
| `waktu` | Time | Waktu pelaksanaan |
| `khatib` | String | Nama Khatib |
| `imam` | String | Nama Imam (Nullable) |

### Tabel: `finances`
Menyimpan transaksi keuangan masjid.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | BigInt | Primary Key |
| `type` | Enum | pemasukan, pengeluaran |
| `category` | Enum | masjid, yatim |
| `amount` | Decimal | Nominal transaksi |
| `description` | String | Keterangan transaksi |
| `date` | Date | Tanggal transaksi |

### Tabel: `activities`
Menyimpan artikel/berita kegiatan masjid.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | BigInt | Primary Key |
| `title` | String | Judul artikel |
| `slug` | String | URL-friendly identifier |
| `content` | Text | Konten artikel (HTML) |
| `image` | String | Path gambar |
| `published_at` | DateTime | Tanggal publikasi |

---

## 📚 Dokumentasi Teknis

### Arsitektur Aplikasi

```
web-masjid/
├── app/
│   ├── Filament/          # Admin Panel Resources
│   ├── Models/            # Eloquent Models
│   └── Providers/
├── database/
│   ├── migrations/        # Database Migrations
│   └── seeders/           # Data Seeders
├── resources/
│   ├── views/             # Blade Templates
│   └── css/               # Tailwind Styles
├── routes/
│   └── web.php            # Route Definitions
└── storage/
    └── app/public/        # Uploaded Files
```

### Custom Implementation

#### 1. Duplikasi Jadwal (Filament Action)

Pada `PrayerScheduleResource`, menggunakan `ReplicateAction` dari Filament:

```php
Actions\ReplicateAction::make()
    ->excludeAttributes(['date'])
    ->successNotificationTitle('Jadwal berhasil diduplikat')
```

`excludeAttributes(['date'])` mencegah duplikasi tanggal yang sama (Unique Constraint).

#### 2. File Upload Handler

Menggunakan FileUpload Filament dengan disk public:

```php
FileUpload::make('image')
    ->disk('public')
    ->directory('activities')
    ->image()
    ->maxSize(2048)
```

#### 3. Saldo Keuangan Real-time

Dihitung on-the-fly menggunakan query aggregation:

```php
$saldoMasjid = Finance::where('category', 'masjid')
    ->sum(DB::raw("CASE WHEN type = 'pemasukan' THEN amount ELSE -amount END"));
```

#### 4. Route Fallback untuk Gambar

Route khusus untuk menangani masalah symlink pada Windows/Laragon:

```php
Route::get('/baca-file/{filepath}', function ($filepath) {
    $path = storage_path('app/public/' . $filepath);
    if (!file_exists($path)) abort(404);
    return response()->file($path);
});
```

### Frontend Components

#### Blade Components
- `navbar.blade.php`: Komponen navigasi dengan active state detection
- `footer.blade.php`: Footer dengan informasi masjid
- Layout structure menggunakan `@include` dan `@extends`

#### Styling
- Menggunakan Tailwind CSS utility classes
- Custom colors dan theme dikonfigurasi di `tailwind.config.js`
- Responsive design untuk mobile, tablet, dan desktop

---

## 🔒 Keamanan

### Implementasi Keamanan

1. **Authentication & Authorization**
   - Halaman admin dilindungi Filament Middleware (Login wajib)
   - Role-based access control (jika dikembangkan lebih lanjut)

2. **Database Security**
   - Input sanitasi via Eloquent ORM (Anti SQL Injection)
   - Prepared statements untuk semua query database

3. **XSS Prevention**
   - Blade escaping otomatis: `{{ $variable }}`
   - Raw HTML hanya untuk konten admin terpercaya: `{!! $content !!}`

4. **CSRF Protection**
   - Laravel CSRF token untuk semua form POST/PUT/DELETE
   - Otomatis dihandle oleh `@csrf` directive

5. **File Upload Security**
   - Validasi tipe file (image only)
   - Maksimal ukuran file (2MB)
   - Storage terpisah dari public directory

### Best Practices

- Gunakan password yang kuat
- Ubah kredensial default segera setelah instalasi
- Backup database secara berkala
- Update dependencies secara rutin: `composer update`, `npm update`

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Jika Anda ingin berkontribusi:

1. Fork repository ini
2. Buat branch fitur baru: `git checkout -b fitur-baru`
3. Commit perubahan: `git commit -m 'Menambahkan fitur baru'`
4. Push ke branch: `git push origin fitur-baru`
5. Buat Pull Request

### Panduan Kontribusi

- Ikuti PSR-12 coding standard untuk PHP
- Gunakan conventional commits untuk pesan commit
- Tambahkan test untuk fitur baru
- Update dokumentasi jika diperlukan

---

## 📝 Changelog

### Version 1.0.0 (2026)
- ✅ Implementasi jadwal sholat harian
- ✅ Manajemen jadwal Jumat dengan petugas
- ✅ Sistem keuangan transparan (Masjid & Yatim)
- ✅ Manajemen berita dan kegiatan
- ✅ Dashboard admin menggunakan FilamentPHP
- ✅ Responsive design untuk semua perangkat

---

## 📄 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

---

## 👨‍💻 Developer

Dikembangkan dengan ❤️ untuk **Masjid Taqwa**

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [FilamentPHP](https://filamentphp.com) - Admin Panel Framework
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS Framework
- Komunitas open source yang telah berkontribusi

---

<div align="center">
  
**⭐ Star project ini jika bermanfaat!**

Made with 💚 for better mosque management

© 2026 Masjid Taqwa. All rights reserved.

</div>
