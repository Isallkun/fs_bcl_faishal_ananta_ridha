# 👥 Panduan Pengguna - Fleet Management System

## 🎯 Overview

Fleet Management System adalah aplikasi web untuk mengelola armada, tracking pengiriman, dan monitoring lokasi real-time. Aplikasi ini dirancang untuk memudahkan manajemen logistik dengan fitur-fitur lengkap.

## 🚀 Getting Started

### Akses Aplikasi

1. Buka browser dan akses URL aplikasi
2. Anda akan melihat halaman **Dashboard Tracking**
3. Gunakan menu navigasi di bagian atas untuk mengakses fitur lain

### Login (Jika ada Authentication)

-   **Username**: `test@example.com`
-   **Password**: `password`

## 📋 Menu Utama

### 1. **Dashboard** (Home)

-   **URL**: `/`
-   **Fungsi**: Halaman utama untuk tracking pengiriman
-   **Fitur**:
    -   Form pencarian nomor pengiriman
    -   Tampilan status pengiriman real-time

### 2. **Pengiriman**

-   **URL**: `/pengiriman`
-   **Fungsi**: Manajemen data pengiriman
-   **Fitur**:
    -   Daftar semua pengiriman
    -   Pencarian berdasarkan nomor/tujuan
    -   Tambah pengiriman baru
    -   Update status pengiriman

### 3. **Armada**

-   **URL**: `/armadas`
-   **Fungsi**: Manajemen data armada
-   **Fitur**:
    -   Daftar armada dengan status
    -   Filter berdasarkan jenis/status
    -   CRUD operations armada

### 4. **Pemesanan**

-   **URL**: `/pemesanan/create`
-   **Fungsi**: Form pemesanan armada
-   **Fitur**:
    -   Pilih armada tersedia
    -   Input detail pemesanan
    -   Validasi otomatis

### 5. **Check-in**

-   **URL**: `/checkins`
-   **Fungsi**: Monitoring lokasi armada
-   **Fitur**:
    -   Peta interaktif
    -   Riwayat check-in
    -   API untuk mobile check-in

### 6. **Laporan**

-   **URL**: `/reports`
-   **Fungsi**: Dashboard laporan dan statistik
-   **Fitur**:
    -   Statistik pengiriman per armada
    -   Data analytics

## 📖 Panduan Fitur Detail

### 🔍 **1. Tracking Pengiriman**

#### Cara Menggunakan:

1. Masuk ke halaman **Dashboard** (`/`)
2. Masukkan **nomor pengiriman** di form pencarian
3. Klik tombol **"Lacak"**
4. Sistem akan menampilkan informasi:
    - Nomor pengiriman
    - Tanggal pengiriman
    - Asal dan tujuan
    - Status pengiriman
    - Detail barang
    - Informasi armada

#### Status Pengiriman:

-   **Tertunda**: Pengiriman belum dimulai
-   **Perjalanan**: Sedang dalam perjalanan
-   **Tiba**: Sudah sampai tujuan

### 🚛 **2. Manajemen Armada**

#### Melihat Daftar Armada:

1. Klik menu **"Armada"** di navigasi
2. Sistem menampilkan tabel dengan kolom:
    - Nomor Armada
    - Jenis Kendaraan
    - Kapasitas (kg)
    - Status Ketersediaan
    - Tombol Aksi

#### Filter Armada:

1. Gunakan form filter di bagian atas tabel
2. **Filter Jenis**: Pilih jenis kendaraan
3. **Filter Status**: Pilih status ketersediaan
4. Klik **"Filter"** untuk menerapkan

#### Menambah Armada Baru:

1. Klik tombol **"Tambah"** di halaman armada
2. Isi form dengan data:
    - **Nomor Armada**: Harus unik
    - **Jenis Kendaraan**: Truck, Van, dll
    - **Kapasitas**: Dalam kg
    - **Status**: Tersedia/Tidak Tersedia
3. Klik **"Simpan"**

#### Edit Armada:

1. Klik tombol **"Edit"** pada armada yang ingin diubah
2. Ubah data yang diperlukan
3. Klik **"Update"**

#### Hapus Armada:

1. Klik tombol **"Hapus"** pada armada
2. Konfirmasi penghapusan
3. Armada akan dihapus jika tidak sedang digunakan

### 📦 **3. Manajemen Pengiriman**

#### Melihat Daftar Pengiriman:

1. Klik menu **"Pengiriman"**
2. Tabel menampilkan:
    - Nomor Pengiriman
    - Tanggal
    - Asal & Tujuan
    - Status
    - Armada
    - Tombol Aksi

#### Pencarian Pengiriman:

1. Gunakan form pencarian di bagian atas
2. Masukkan **nomor pengiriman** atau **tujuan**
3. Klik **"Cari"**

#### Menambah Pengiriman:

1. Klik tombol **"Tambah"** di halaman pengiriman
2. Isi form:
    - **Nomor Pengiriman**: Harus unik
    - **Tanggal Pengiriman**: Tidak boleh masa lalu
    - **Asal & Tujuan**: Lokasi pengiriman
    - **Status**: Tertunda/Perjalanan/Tiba
    - **Detail Barang**: Deskripsi barang
    - **Armada**: Pilih dari dropdown
3. Klik **"Simpan"**

#### Update Status Pengiriman:

1. Gunakan tombol **"Update Status"** pada pengiriman
2. Pilih status baru
3. Sistem akan otomatis update status armada

### 📋 **4. Pemesanan Armada**

#### Membuat Pemesanan:

1. Klik menu **"Pemesanan"**
2. Isi form pemesanan:
    - **Armada**: Pilih dari armada tersedia
    - **Tanggal Pemesanan**: Tidak boleh masa lalu
    - **Detail Barang**: Deskripsi barang
3. Klik **"Pesan"**

#### Validasi Otomatis:

-   Sistem akan validasi ketersediaan armada
-   Status armada otomatis berubah ke "Tidak Tersedia"
-   Pemesanan langsung terkonfirmasi

### 📍 **5. Check-in Lokasi**

#### Melihat Dashboard Check-in:

1. Klik menu **"Check-in"**
2. Halaman menampilkan:
    - **Peta Interaktif**: Menampilkan lokasi armada
    - **Riwayat Check-in**: Daftar check-in terbaru

#### Fitur Peta:

-   **Zoom**: Scroll mouse atau tombol +/- untuk zoom
-   **Pan**: Drag peta untuk berpindah lokasi
-   **Marker**: Titik merah menunjukkan lokasi armada
-   **Popup**: Klik marker untuk detail info

#### Check-in via API:

```javascript
// API endpoint untuk check-in
POST /checkins
{
    "armada_id": 1,
    "lat": -6.200000,
    "lng": 106.816666
}
```

### 📊 **6. Laporan & Statistik**

#### Dashboard Laporan:

1. Klik menu **"Laporan"**
2. Tabel menampilkan:
    - **Nomor Armada**: Identifikasi armada
    - **Total Perjalanan**: Jumlah pengiriman dalam perjalanan

#### Interpretasi Data:

-   **0**: Armada tidak sedang digunakan
-   **1+**: Armada sedang mengangkut barang
-   Data real-time berdasarkan status pengiriman

## 🔧 Tips & Best Practices

### ✅ **Dos (Yang Harus Dilakukan)**

1. **Input Data Akurat**: Pastikan semua data input valid
2. **Update Status**: Selalu update status pengiriman secara real-time
3. **Backup Data**: Lakukan backup database secara berkala
4. **Validasi**: Periksa ketersediaan armada sebelum pemesanan
5. **Monitoring**: Pantau lokasi armada secara berkala

### ❌ **Don'ts (Yang Tidak Boleh)**

1. **Jangan Input Data Kosong**: Semua field wajib diisi
2. **Jangan Hapus Armada Aktif**: Armada dengan pengiriman aktif tidak bisa dihapus
3. **Jangan Skip Validasi**: Selalu ikuti proses validasi sistem
4. **Jangan Input Tanggal Masa Lalu**: Untuk pemesanan dan pengiriman
5. **Jangan Duplikasi Data**: Nomor armada dan pengiriman harus unik

## 🚨 Troubleshooting

### Masalah Umum & Solusi

#### 1. **Form Tidak Bisa Submit**

-   **Penyebab**: Ada field yang belum diisi
-   **Solusi**: Periksa semua field wajib (\*) sudah terisi

#### 2. **Armada Tidak Muncul di Dropdown**

-   **Penyebab**: Armada tidak tersedia
-   **Solusi**: Pilih armada dengan status "Tersedia"

#### 3. **Error "Nomor Sudah Ada"**

-   **Penyebab**: Nomor armada/pengiriman duplikat
-   **Solusi**: Gunakan nomor yang berbeda

#### 4. **Peta Tidak Muncul**

-   **Penyebab**: Koneksi internet atau JavaScript error
-   **Solusi**: Refresh halaman atau cek koneksi internet

#### 5. **Data Tidak Update**

-   **Penyebab**: Cache browser
-   **Solusi**: Refresh halaman atau clear cache

## 📱 Mobile Usage

### Responsive Design

-   Aplikasi sudah responsive untuk mobile
-   Gunakan browser mobile terbaru
-   Fitur touch-friendly untuk semua tombol

### Mobile Check-in

-   Gunakan API endpoint untuk check-in mobile
-   Kirim koordinat GPS dari aplikasi mobile
-   Data akan muncul di dashboard web

## 🔒 Security Notes

### Data Protection

-   Semua data dienkripsi dalam database
-   Session management otomatis
-   CSRF protection aktif

### Access Control

-   Gunakan akun dengan privilege sesuai kebutuhan
-   Logout setelah selesai menggunakan aplikasi
-   Jangan share kredensial login

## 📞 Support & Help

### Dokumentasi

-   **README.md**: Overview aplikasi
-   **docs/**: Dokumentasi lengkap
-   **API Documentation**: Endpoint documentation

### Contact

-   **GitHub Issues**: Untuk bug reports
-   **Email**: support@yourcompany.com
-   **Documentation**: Check folder `docs/`

---

_Panduan pengguna ini memberikan informasi lengkap tentang cara menggunakan Fleet Management System secara efektif._
