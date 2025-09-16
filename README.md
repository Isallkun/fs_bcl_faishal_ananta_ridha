# Fleet Management System (BCL)

Sistem manajemen armada untuk tracking pengiriman, pemesanan armada, dan monitoring lokasi real-time.

## 📋 Fitur Utama

### 1. **Pelacakan Pengiriman**

-   Pencarian pengiriman berdasarkan nomor pengiriman
-   Informasi lengkap: status, tanggal, asal, tujuan, detail barang
-   Status pengiriman: tertunda, perjalanan, tiba

### 2. **Manajemen Armada**

-   CRUD lengkap untuk data armada
-   Informasi: nomor armada, jenis kendaraan, kapasitas, status
-   Status ketersediaan: tersedia, tidak tersedia
-   Validasi armada tidak sedang digunakan

### 3. **Pemesanan Armada**

-   Form pemesanan dengan validasi lengkap
-   Update otomatis status armada setelah pemesanan
-   Validasi tanggal tidak boleh masa lalu

### 4. **Lokasi Check-in Real-time**

-   Sistem check-in lokasi dengan koordinat GPS
-   Visualisasi peta menggunakan Leaflet
-   Riwayat check-in terbaru

### 5. **Pencarian dan Filter**

-   Pencarian pengiriman berdasarkan nomor/tujuan
-   Filter armada berdasarkan jenis kendaraan dan status
-   Pagination untuk performa optimal

### 6. **Laporan Pengiriman**

-   Statistik pengiriman dalam perjalanan per armada
-   Query MySQL dengan JOIN dan GROUP BY
-   Dashboard laporan real-time

## 🗄️ Database Schema

### Tabel Utama:

-   **armadas**: Data armada (nomor, jenis, kapasitas, status)
-   **pengirimans**: Data pengiriman (nomor, tanggal, asal, tujuan, status)
-   **pemesanans**: Data pemesanan armada
-   **checkins**: Data lokasi check-in armada (lat, lng)

### Relasi:

-   Armada → Pengiriman (One to Many)
-   Armada → Pemesanan (One to Many)
-   Armada → Checkin (One to Many)

## 🚀 Instalasi dan Setup

### Prerequisites:

-   PHP 8.1+
-   Composer
-   MySQL/PostgreSQL
-   Node.js (untuk asset compilation)

### Langkah Instalasi:

1. **Clone repository:**

```bash
git clone <repository-url>
cd fs_bcl_faishal_ananta_ridha
```

2. **Install dependencies:**

```bash
composer install
npm install
```

3. **Setup environment:**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi database di .env:**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fs_bcl
DB_USERNAME=root
DB_PASSWORD=
```

5. **Jalankan migration dan seeder:**

```bash
php artisan migrate:fresh --seed
```

6. **Compile assets:**

```bash
npm run dev
```

7. **Jalankan server:**

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 🛠️ Teknologi yang Digunakan

-   **Backend**: Laravel 11.x
-   **Database**: MySQL dengan Eloquent ORM
-   **Frontend**: Blade templates dengan Tailwind CSS
-   **Maps**: Leaflet.js untuk visualisasi peta
-   **Validation**: Laravel Form Request Validation

## 📁 Struktur Project

```
app/
├── Http/Controllers/          # Controller untuk semua fitur
├── Models/                   # Eloquent models
└── Providers/               # Service providers

database/
├── migrations/              # Database migrations
├── seeders/                # Database seeders
└── factories/              # Model factories

resources/
├── views/                  # Blade templates
│   ├── armadas/           # Views untuk manajemen armada
│   ├── pengiriman/        # Views untuk pengiriman
│   ├── checkins/          # Views untuk check-in
│   └── layouts/           # Layout templates
└── css/js/                # Frontend assets

docs/
├── PROJECT_STRUCTURE.md   # Detail struktur project
├── DATABASE_SCHEMA.md     # Dokumentasi database
├── API_DOCUMENTATION.md   # Dokumentasi API
├── INSTALLATION_GUIDE.md  # Panduan instalasi
└── USER_MANUAL.md         # Panduan pengguna

routes/
└── web.php                # Web routes
```

## 📚 Dokumentasi Lengkap

-   **[📁 Struktur Project](docs/PROJECT_STRUCTURE.md)** - Detail arsitektur dan struktur aplikasi
-   **[🗄️ Database Schema](docs/DATABASE_SCHEMA.md)** - Dokumentasi lengkap database dan relasi
-   **[🔌 API Documentation](docs/API_DOCUMENTATION.md)** - Panduan lengkap RESTful API
-   **[🚀 Installation Guide](docs/INSTALLATION_GUIDE.md)** - Panduan instalasi step-by-step
-   **[👥 User Manual](docs/USER_MANUAL.md)** - Panduan penggunaan untuk end users

## 🔧 API Endpoints

### Pengiriman:

-   `GET /` - Dashboard tracking
-   `GET /pengiriman` - Daftar pengiriman
-   `POST /pengiriman` - Buat pengiriman baru
-   `GET /track` - Track pengiriman

### Armada:

-   `GET /armadas` - Daftar armada
-   `POST /armadas` - Tambah armada
-   `PUT /armadas/{id}` - Update armada
-   `DELETE /armadas/{id}` - Hapus armada

### Check-in:

-   `GET /checkins` - Dashboard check-in
-   `POST /checkins` - API check-in lokasi

### Laporan:

-   `GET /reports` - Laporan pengiriman

## ✅ Validasi dan Security

-   ✅ Validasi input lengkap di semua form
-   ✅ Validasi tanggal tidak boleh masa lalu
-   ✅ Validasi armada tidak sedang digunakan
-   ✅ CSRF protection di semua form
-   ✅ SQL injection protection dengan Eloquent ORM
-   ✅ XSS protection dengan Blade templating

## 📱 Responsive Design

-   ✅ Mobile-first design dengan Tailwind CSS
-   ✅ Responsive navigation
-   ✅ Responsive tables dan forms
-   ✅ Touch-friendly interface

## 🧪 Testing

```bash
# Jalankan tests
php artisan test

# Jalankan dengan coverage
php artisan test --coverage
```

## 📝 Dokumentasi API

API documentation tersedia di `/api/docs` setelah setup selesai.

## 🤝 Kontribusi

1. Fork repository
2. Buat feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📄 License

Project ini menggunakan MIT License.

## 👨‍💻 Developer

**Faishal Ananta Ridha**

-   Repository: `fs_bcl_faishal_ananta_ridha`
-   Framework: Laravel 11.x
-   Database: MySQL

---

_Dibuat untuk memenuhi requirements BCL (Business Case Learning) dengan implementasi lengkap semua fitur yang diminta._
