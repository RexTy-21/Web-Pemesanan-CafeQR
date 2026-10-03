# ☕ Cafe QR - System Pemesanan Cafe berbasis QR Code

Aplikasi web pemesanan menu kafe/restoran berbasis QR Code yang dibangun menggunakan framework **Laravel**. Sistem ini memudahkan pelanggan untuk memesan makanan dan minuman secara langsung dari meja mereka melalui pemindaian kode QR, serta memberikan kemudahan bagi kasir/admin dalam mengelola pesanan.

---

## 🚀 Fitur Utama

- **Pelanggan (Customer):**
  - Pemindaian QR Code meja untuk mengakses menu secara langsung.
  - Ringkasan pesanan dan keranjang belanja (Cart).
  - Formulir pemesanan yang responsif dan interaktif.
  - Halaman konfirmasi / status pemesanan.

- **Kasir & Manajemen (Admin/Cashier):**
  - Panel pengelolaan pesanan masuk secara *real-time*.
  - Pengelolaan data menu makanan & minuman.
  - Pembuatan dan manajemen QR Code meja.

---

## 🛠️ Teknologi yang Digunakan

- **Framework:** [Laravel](https://laravel.com/)
- **Frontend:** Blade Templating, Tailwind CSS / JavaScript (Alpine.js / Vite)
- **Database:** MySQL
- **Web Server:** Laragon / Apache

---

## 💻 Cara Instalasi & Menjalankan Project

Ikuti langkah-langkah di bawah ini untuk menjalankan project ini di lingkungan lokal Anda:

### 1. Clone Repositori
```bash
git clone [https://github.com/RexTy-21/Web-Pemesanan-CafeQR.git](https://github.com/RexTy-21/Web-Pemesanan-CafeQR.git)
cd Web-Pemesanan-CafeQR
2. Install Dependensi PHP & JavaScript
composer install
npm install
3. Salin File Environtment
cp .env.example .env
4. Generasi Application Key
php artisan key:generate
5. Konfigurasi Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_cafe_qr
DB_USERNAME=root
DB_PASSWORD=
6. Jalankan Migrasi Database
php artisan migrate --seed
7. Jalankan Server
php artisan serve
npm run dev
👤 Penulis / Pengembang
Ammar Zahran Herlambang