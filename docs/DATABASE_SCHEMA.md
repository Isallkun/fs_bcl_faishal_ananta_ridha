# 🗄️ Database Schema - Fleet Management System

## 📊 Overview Database

Database menggunakan **MySQL** dengan **Laravel Eloquent ORM** untuk manajemen data. Sistem ini terdiri dari 4 tabel utama dengan relasi yang terstruktur.

## 🏗️ Entity Relationship Diagram (ERD)

```
┌─────────────────┐    1:N    ┌─────────────────┐
│     ARMADAS     │──────────▶│   PENGIRIMANS   │
│                 │           │                 │
│ - id (PK)       │           │ - id (PK)       │
│ - nomor_armada  │           │ - nomor_pengiri-│
│ - jenis_kendaraan│          │   man           │
│ - kapasitas     │           │ - tanggal_peng- │
│ - status        │           │   iriman        │
│ - timestamps    │           │ - asal          │
└─────────────────┘           │ - tujuan        │
         │                    │ - status        │
         │                    │ - detail_barang │
         │                    │ - armada_id (FK)│
         │                    │ - timestamps    │
         │                    └─────────────────┘
         │
         │ 1:N
         ▼
┌─────────────────┐    1:N    ┌─────────────────┐
│    PEMESANANS   │           │     CHECKINS    │
│                 │           │                 │
│ - id (PK)       │           │ - id (PK)       │
│ - armada_id (FK)│           │ - armada_id (FK)│
│ - tanggal_pemes-│           │ - lat           │
│   anan          │           │ - lng           │
│ - detail_barang │           │ - timestamps    │
│ - status        │           └─────────────────┘
│ - timestamps    │
└─────────────────┘
```

## 📋 Detail Tabel

### 1. **ARMADAS** - Tabel Armada

```sql
CREATE TABLE armadas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nomor_armada VARCHAR(50) NOT NULL UNIQUE,
    jenis_kendaraan VARCHAR(50) NOT NULL,
    kapasitas INT UNSIGNED NOT NULL,
    status ENUM('tersedia', 'tidak tersedia') DEFAULT 'tersedia',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Field Descriptions:**

-   `id`: Primary key, auto increment
-   `nomor_armada`: Nomor unik armada (UNIQUE constraint)
-   `jenis_kendaraan`: Jenis kendaraan (Truck, Van, dll)
-   `kapasitas`: Kapasitas muatan dalam kg
-   `status`: Status ketersediaan armada
-   `timestamps`: Laravel automatic timestamps

**Indexes:**

-   PRIMARY KEY on `id`
-   UNIQUE INDEX on `nomor_armada`
-   INDEX on `status` (for filtering)

### 2. **PENGIRIMANS** - Tabel Pengiriman

```sql
CREATE TABLE pengirimans (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nomor_pengiriman VARCHAR(50) NOT NULL UNIQUE,
    tanggal_pengiriman DATE NOT NULL,
    asal VARCHAR(100) NOT NULL,
    tujuan VARCHAR(100) NOT NULL,
    status ENUM('tertunda', 'perjalanan', 'tiba') DEFAULT 'tertunda',
    detail_barang TEXT NOT NULL,
    armada_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    FOREIGN KEY (armada_id) REFERENCES armadas(id) ON DELETE CASCADE
);
```

**Field Descriptions:**

-   `id`: Primary key, auto increment
-   `nomor_pengiriman`: Nomor unik pengiriman (UNIQUE constraint)
-   `tanggal_pengiriman`: Tanggal pengiriman (DATE)
-   `asal`: Lokasi asal pengiriman
-   `tujuan`: Lokasi tujuan pengiriman
-   `status`: Status pengiriman dengan 3 state
-   `detail_barang`: Detail barang yang dikirim (TEXT)
-   `armada_id`: Foreign key ke tabel armadas

**Constraints:**

-   FOREIGN KEY constraint ke `armadas.id` dengan CASCADE DELETE
-   UNIQUE constraint pada `nomor_pengiriman`

### 3. **PEMESANANS** - Tabel Pemesanan

```sql
CREATE TABLE pemesanans (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    armada_id BIGINT UNSIGNED NOT NULL,
    tanggal_pemesanan DATE NOT NULL,
    detail_barang TEXT NOT NULL,
    status ENUM('pending', 'confirmed', 'selesai') DEFAULT 'confirmed',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    FOREIGN KEY (armada_id) REFERENCES armadas(id) ON DELETE CASCADE
);
```

**Field Descriptions:**

-   `id`: Primary key, auto increment
-   `armada_id`: Foreign key ke tabel armadas
-   `tanggal_pemesanan`: Tanggal pemesanan (DATE)
-   `detail_barang`: Detail barang yang dipesan
-   `status`: Status pemesanan dengan 3 state

### 4. **CHECKINS** - Tabel Check-in Lokasi

```sql
CREATE TABLE checkins (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    armada_id BIGINT UNSIGNED NOT NULL,
    lat DECIMAL(10,6) NOT NULL,
    lng DECIMAL(10,6) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    FOREIGN KEY (armada_id) REFERENCES armadas(id) ON DELETE CASCADE
);
```

**Field Descriptions:**

-   `id`: Primary key, auto increment
-   `armada_id`: Foreign key ke tabel armadas
-   `lat`: Latitude koordinat (DECIMAL 10,6 untuk presisi tinggi)
-   `lng`: Longitude koordinat (DECIMAL 10,6 untuk presisi tinggi)

## 🔗 Relasi Database

### 1. **Armada → Pengiriman** (One-to-Many)

```php
// Di model Armada
public function pengiriman()
{
    return $this->hasMany(Pengiriman::class);
}

// Di model Pengiriman
public function armada()
{
    return $this->belongsTo(Armada::class);
}
```

### 2. **Armada → Pemesanan** (One-to-Many)

```php
// Di model Armada
public function pemesanan()
{
    return $this->hasMany(Pemesanan::class);
}

// Di model Pemesanan
public function armada()
{
    return $this->belongsTo(Armada::class);
}
```

### 3. **Armada → Checkin** (One-to-Many)

```php
// Di model Armada
public function checkins()
{
    return $this->hasMany(Checkin::class);
}

// Di model Checkin
public function armada()
{
    return $this->belongsTo(Armada::class);
}
```

## 📊 Sample Data

### Armadas Sample Data

```sql
INSERT INTO armadas (nomor_armada, jenis_kendaraan, kapasitas, status) VALUES
('ARM001', 'Truck Besar', 5000, 'tersedia'),
('ARM002', 'Truck Sedang', 3000, 'tersedia'),
('ARM003', 'Van', 1000, 'tidak tersedia');
```

### Pengirimans Sample Data

```sql
INSERT INTO pengirimans (nomor_pengiriman, tanggal_pengiriman, asal, tujuan, status, detail_barang, armada_id) VALUES
('SHIP001', '2025-09-17', 'Jakarta', 'Bandung', 'tertunda', 'Elektronik dan peralatan kantor', 1),
('SHIP002', '2025-09-18', 'Surabaya', 'Malang', 'perjalanan', 'Bahan makanan dan minuman', 2);
```

### Checkins Sample Data

```sql
INSERT INTO checkins (armada_id, lat, lng) VALUES
(1, -6.200000, 106.816666),
(2, -7.250000, 112.750000);
```

## 🔍 Query Examples

### 1. **Laporan Pengiriman per Armada (dengan JOIN & GROUP BY)**

```sql
SELECT
    a.nomor_armada,
    SUM(CASE WHEN p.status = 'perjalanan' THEN 1 ELSE 0 END) AS total_perjalanan
FROM armadas AS a
LEFT JOIN pengirimans AS p ON p.armada_id = a.id
GROUP BY a.nomor_armada
ORDER BY a.nomor_armada;
```

### 2. **Armada yang Sedang Digunakan**

```sql
SELECT a.*
FROM armadas a
INNER JOIN pengirimans p ON p.armada_id = a.id
WHERE p.status IN ('tertunda', 'perjalanan');
```

### 3. **Riwayat Check-in Terbaru**

```sql
SELECT c.*, a.nomor_armada
FROM checkins c
INNER JOIN armadas a ON a.id = c.armada_id
ORDER BY c.created_at DESC
LIMIT 10;
```

### 4. **Statistik Status Pengiriman**

```sql
SELECT
    status,
    COUNT(*) as jumlah
FROM pengirimans
GROUP BY status;
```

## 🛠️ Migration Files

### 1. **Create Armadas Table**

```php
// database/migrations/2025_09_16_024619_create_armadas_table.php
Schema::create('armadas', function (Blueprint $table) {
    $table->id();
    $table->string('nomor_armada')->unique();
    $table->string('jenis_kendaraan');
    $table->unsignedInteger('kapasitas');
    $table->enum('status', ['tersedia','tidak tersedia'])->default('tersedia');
    $table->timestamps();
});
```

### 2. **Create Pengirimans Table**

```php
// database/migrations/2025_09_16_024619_create_pengirimans_table.php
Schema::create('pengirimans', function (Blueprint $table) {
    $table->id();
    $table->string('nomor_pengiriman')->unique();
    $table->date('tanggal_pengiriman');
    $table->string('asal');
    $table->string('tujuan');
    $table->enum('status', ['tertunda','perjalanan','tiba'])->default('tertunda');
    $table->text('detail_barang');
    $table->foreignId('armada_id')->constrained('armadas')->cascadeOnDelete();
    $table->timestamps();
});
```

## 🔧 Database Optimization

### Indexes

-   **Primary Keys**: Auto-increment pada semua tabel
-   **Unique Indexes**: `nomor_armada`, `nomor_pengiriman`
-   **Foreign Key Indexes**: Otomatis dibuat oleh Laravel
-   **Filter Indexes**: `status` fields untuk query filtering

### Constraints

-   **Foreign Key Constraints**: CASCADE DELETE untuk data integrity
-   **Check Constraints**: ENUM values untuk data validation
-   **Unique Constraints**: Mencegah duplikasi data kritis

### Performance Tips

-   **Pagination**: Digunakan untuk data besar
-   **Eager Loading**: `with()` untuk mencegah N+1 queries
-   **Query Optimization**: JOIN queries untuk laporan

---

_Dokumentasi database ini memberikan panduan lengkap tentang struktur, relasi, dan optimasi database untuk Fleet Management System._
