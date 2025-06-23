# Aplikasi Sistem Kasir

<p align="center">
  <img src="https://laravel.com/img/logomark.min.svg" width="100" alt="Laravel">
  <img src="https://cdn.jsdelivr.net/gh/filamentphp/filament@3.x/resources/img/filament-mark.svg" width="100" alt="Filament">
</p>

## Tentang Aplikasi

Aplikasi Sistem Kasir adalah solusi manajemen penjualan dan inventaris yang dibangun dengan Laravel dan Filament PHP. Aplikasi ini dirancang untuk membantu UMKM dan toko ritel dalam mengelola transaksi penjualan, stok barang, dan laporan keuangan dengan mudah dan efisien.

## Fitur Utama

- Manajemen Produk & Kategori
- Transaksi Penjualan (POS)
- Manajemen Stok Barang
- Laporan Penjualan Harian/Bulanan
- Manajemen Pelanggan
- User Role & Permission
- Dashboard Analitik

## Teknologi yang Digunakan

- **Backend**: Laravel 10.x
- **Frontend**: Filament PHP 3.x
- **Database**: MySQL 8.0+
- **Server**: PHP 8.2+
- **Lainnya**:
  - Livewire 2.x
  - Alpine.js
  - Tailwind CSS 3.x
  - Spatie Laravel Permission

## Persyaratan Sistem

- PHP 8.2 atau lebih baru
- Composer
- MySQL 8.0 atau lebih baru
- Node.js & NPM (untuk aset frontend)
- Web Server (Apache/Nginx)

## Cara Instalasi

1. Clone repository ini:
   ```bash
   git clone https://github.com/username/filament-kasir.git
   cd filament-kasir
   ```

2. Install dependensi PHP:
   ```bash
   composer install
   ```

3. Salin file .env:
   ```bash
   cp .env.example .env
   ```

4. Generate key aplikasi:
   ```bash
   php artisan key:generate
   ```

5. Konfigurasi database di file .env:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=username_db
   DB_PASSWORD=password_db
   ```

6. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate --seed
   ```

7. Install dependensi frontend:
   ```bash
   npm install
   npm run build
   ```

8. Generate storage link:
   ```bash
   php artisan storage:link
   ```

9. Jalankan server development:
   ```bash
   php artisan serve
   ```

10. Buka browser dan akses:
    ```
    http://localhost:8000/admin
    ```

## Login Awal

- **Email**: admin@example.com
- **Password**: password

## Kontribusi

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b fitur-baru`)
3. Commit perubahan Anda (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## Lisensi

© 2025 Muhammad Fahri.

## Dukungan

Jika menemui kendala atau memiliki pertanyaan, silakan buat [issue baru](https://github.com/username/filament-kasir/issues).

