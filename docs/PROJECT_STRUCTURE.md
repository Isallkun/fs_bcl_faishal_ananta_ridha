# 📁 Struktur Proyek Fleet Management System

## 🏗️ Arsitektur Aplikasi

```
fs_bcl_faishal_ananta_ridha/
├── 📁 app/                          # Core Application Logic
│   ├── 📁 Http/                     # HTTP Layer
│   │   └── 📁 Controllers/          # Application Controllers
│   │       ├── ArmadaController.php     # Manajemen Armada
│   │       ├── CheckinController.php    # Check-in Lokasi
│   │       ├── PemesananController.php  # Pemesanan Armada
│   │       ├── PengirimanController.php # Pengiriman & Tracking
│   │       └── ReportController.php     # Laporan & Statistik
│   ├── 📁 Models/                   # Eloquent Models
│   │   ├── Armada.php                  # Model Armada
│   │   ├── Checkin.php                 # Model Check-in
│   │   ├── Pemesanan.php               # Model Pemesanan
│   │   ├── Pengiriman.php              # Model Pengiriman
│   │   └── User.php                     # Model User
│   └── 📁 Providers/                # Service Providers
│       └── AppServiceProvider.php       # Main Service Provider
├── 📁 bootstrap/                    # Application Bootstrap
│   ├── app.php                         # Application Entry Point
│   └── 📁 cache/                       # Bootstrap Cache
├── 📁 config/                       # Configuration Files
│   ├── app.php                         # App Configuration
│   ├── database.php                    # Database Configuration
│   ├── filesystems.php                 # File System Configuration
│   └── ...                            # Other Config Files
├── 📁 database/                     # Database Layer
│   ├── 📁 factories/                 # Model Factories
│   │   ├── ArmadaFactory.php           # Armada Factory
│   │   ├── CheckinFactory.php          # Check-in Factory
│   │   ├── PemesananFactory.php        # Pemesanan Factory
│   │   ├── PengirimanFactory.php       # Pengiriman Factory
│   │   └── UserFactory.php             # User Factory
│   ├── 📁 migrations/                # Database Migrations
│   │   ├── 2025_09_16_024619_create_armadas_table.php
│   │   ├── 2025_09_16_024619_create_pengirimans_table.php
│   │   ├── 2025_09_16_024620_create_checkins_table.php
│   │   ├── 2025_09_16_024620_create_pemesanans_table.php
│   │   └── 2025_09_16_032148_update_armada_status_format.php
│   └── 📁 seeders/                  # Database Seeders
│       ├── DatabaseSeeder.php          # Main Seeder
│       └── SampleSeeder.php            # Sample Data Seeder
├── 📁 public/                       # Public Assets
│   ├── index.php                       # Application Entry Point
│   ├── favicon.ico                     # Site Icon
│   └── robots.txt                      # Robots File
├── 📁 resources/                    # Resources & Views
│   ├── 📁 css/                      # Stylesheets
│   │   └── app.css                     # Main CSS
│   ├── 📁 js/                       # JavaScript
│   │   ├── app.js                       # Main JS
│   │   └── bootstrap.js                 # Bootstrap JS
│   └── 📁 views/                    # Blade Templates
│       ├── 📁 armadas/              # Armada Views
│       │   ├── index.blade.php          # Daftar Armada
│       │   ├── create.blade.php         # Form Tambah Armada
│       │   └── edit.blade.php           # Form Edit Armada
│       ├── 📁 checkins/             # Check-in Views
│       │   └── index.blade.php          # Dashboard Check-in
│       ├── 📁 layouts/              # Layout Templates
│       │   └── app.blade.php            # Main Layout
│       ├── 📁 pemesanan/            # Pemesanan Views
│       │   └── create.blade.php         # Form Pemesanan
│       ├── 📁 pengiriman/           # Pengiriman Views
│       │   ├── index.blade.php          # Daftar Pengiriman
│       │   ├── create.blade.php         # Form Tambah Pengiriman
│       │   └── track.blade.php          # Tracking Pengiriman
│       ├── 📁 reports/              # Report Views
│       │   └── index.blade.php          # Dashboard Laporan
│       └── welcome.blade.php            # Welcome Page
├── 📁 routes/                       # Route Definitions
│   ├── web.php                         # Web Routes
│   └── console.php                     # Console Routes
├── 📁 storage/                      # Storage & Cache
│   ├── 📁 app/                      # Application Storage
│   ├── 📁 framework/                # Framework Cache
│   └── 📁 logs/                     # Application Logs
├── 📁 tests/                        # Test Suite
│   ├── 📁 Feature/                  # Feature Tests
│   └── 📁 Unit/                     # Unit Tests
├── 📁 vendor/                       # Composer Dependencies
├── 📁 docs/                         # Documentation
│   ├── PROJECT_STRUCTURE.md            # This File
│   ├── DATABASE_SCHEMA.md              # Database Documentation
│   ├── API_DOCUMENTATION.md            # API Documentation
│   ├── INSTALLATION_GUIDE.md           # Installation Guide
│   └── USER_MANUAL.md                  # User Manual
├── .env.example                     # Environment Template
├── .gitignore                       # Git Ignore Rules
├── artisan                          # Laravel CLI
├── composer.json                    # Composer Dependencies
├── package.json                     # NPM Dependencies
├── phpunit.xml                      # PHPUnit Configuration
├── README.md                        # Main Documentation
└── vite.config.js                   # Vite Configuration
```

## 🔧 Komponen Utama

### 1. **Controllers (app/Http/Controllers/)**

-   **ArmadaController**: CRUD operations untuk manajemen armada
-   **PengirimanController**: Manajemen pengiriman dan tracking
-   **PemesananController**: Proses pemesanan armada
-   **CheckinController**: API untuk check-in lokasi
-   **ReportController**: Generate laporan dan statistik

### 2. **Models (app/Models/)**

-   **Armada**: Model untuk data armada
-   **Pengiriman**: Model untuk data pengiriman
-   **Pemesanan**: Model untuk data pemesanan
-   **Checkin**: Model untuk data check-in lokasi
-   **User**: Model untuk data user

### 3. **Views (resources/views/)**

-   **Blade Templates**: Menggunakan Laravel Blade templating engine
-   **Responsive Design**: Tailwind CSS untuk styling
-   **Component-based**: Layout terstruktur dengan inheritance

### 4. **Database (database/)**

-   **Migrations**: Database schema definitions
-   **Seeders**: Sample data untuk development
-   **Factories**: Model factories untuk testing

## 🔄 Flow Aplikasi

### 1. **Request Flow**

```
User Request → Route → Controller → Model → Database
                ↓
User Response ← View ← Controller ← Model ← Database
```

### 2. **MVC Pattern**

-   **Model**: Business logic dan data access
-   **View**: Presentation layer (Blade templates)
-   **Controller**: Request handling dan business logic coordination

### 3. **Data Flow**

```
Form Input → Validation → Controller Logic → Database Update → Response
```

## 🎯 Fitur Utama

### 1. **Dashboard Tracking** (`/`)

-   Landing page dengan form tracking
-   Real-time pengiriman status

### 2. **Manajemen Armada** (`/armadas`)

-   CRUD operations lengkap
-   Status management
-   Filter dan pencarian

### 3. **Pengiriman Management** (`/pengiriman`)

-   Create, read, update pengiriman
-   Status tracking
-   Search functionality

### 4. **Pemesanan System** (`/pemesanan/create`)

-   Form pemesanan armada
-   Validasi ketersediaan
-   Auto-update status armada

### 5. **Check-in System** (`/checkins`)

-   Real-time location tracking
-   Map visualization
-   History check-in

### 6. **Reporting** (`/reports`)

-   Statistik pengiriman
-   Dashboard laporan
-   Data analytics

## 🔒 Security Features

-   **CSRF Protection**: Semua form protected
-   **Input Validation**: Comprehensive validation rules
-   **SQL Injection Protection**: Eloquent ORM
-   **XSS Protection**: Blade templating
-   **Authentication**: User management system

## 📱 Responsive Design

-   **Mobile-first**: Tailwind CSS approach
-   **Breakpoints**: Responsive grid system
-   **Touch-friendly**: Mobile interface optimization
-   **Cross-browser**: Compatible dengan semua browser modern

## 🚀 Performance

-   **Eloquent ORM**: Optimized database queries
-   **Pagination**: Efficient data loading
-   **Caching**: Laravel cache system
-   **Asset Optimization**: Vite build system

---

_Dokumentasi ini memberikan gambaran lengkap tentang struktur dan arsitektur aplikasi Fleet Management System._
