# 🚀 Panduan Instalasi - Fleet Management System

## 📋 Prerequisites

Sebelum memulai instalasi, pastikan sistem Anda memenuhi requirements berikut:

### System Requirements

-   **PHP**: 8.1 atau lebih tinggi
-   **Composer**: Latest version
-   **Node.js**: 16.x atau lebih tinggi
-   **NPM**: Latest version
-   **Database**: MySQL 8.0+ atau PostgreSQL 13+
-   **Web Server**: Apache/Nginx (opsional untuk development)

### Development Tools

-   **Git**: Untuk version control
-   **Text Editor**: VS Code, PhpStorm, atau editor lainnya
-   **Database Client**: phpMyAdmin, MySQL Workbench, atau DBeaver

## 🔧 Instalasi Step-by-Step

### Step 1: Clone Repository

```bash
# Clone repository dari Git
git clone https://github.com/your-username/fs_bcl_faishal_ananta_ridha.git

# Atau jika menggunakan GitLab
git clone https://gitlab.com/your-username/fs_bcl_faishal_ananta_ridha.git

# Masuk ke direktori project
cd fs_bcl_faishal_ananta_ridha
```

### Step 2: Install Dependencies

```bash
# Install PHP dependencies dengan Composer
composer install

# Install Node.js dependencies
npm install
```

### Step 3: Environment Setup

```bash
# Copy environment template
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Database Configuration

#### 4.1 Buat Database

```sql
-- Login ke MySQL
mysql -u root -p

-- Buat database
CREATE DATABASE fs_bcl CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Buat user (opsional)
CREATE USER 'fs_bcl_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON fs_bcl.* TO 'fs_bcl_user'@'localhost';
FLUSH PRIVILEGES;
```

#### 4.2 Konfigurasi .env

Edit file `.env` dan sesuaikan konfigurasi database:

```env
# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fs_bcl
DB_USERNAME=root
DB_PASSWORD=your_password

# Application Configuration
APP_NAME="Fleet Management System"
APP_ENV=local
APP_KEY=base64:your_generated_key
APP_DEBUG=true
APP_URL=http://localhost:8000

# Cache Configuration
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
```

### Step 5: Database Migration & Seeding

```bash
# Jalankan migration untuk membuat tabel
php artisan migrate

# Seed database dengan sample data
php artisan db:seed

# Atau jalankan keduanya sekaligus
php artisan migrate:fresh --seed
```

### Step 6: Compile Assets

```bash
# Development build
npm run dev

# Production build (untuk deployment)
npm run build
```

### Step 7: Start Development Server

```bash
# Jalankan Laravel development server
php artisan serve

# Server akan berjalan di http://localhost:8000
```

## 🐳 Docker Installation (Alternative)

Jika Anda menggunakan Docker, berikut panduan instalasi dengan Docker:

### Step 1: Clone & Setup

```bash
git clone https://github.com/your-username/fs_bcl_faishal_ananta_ridha.git
cd fs_bcl_faishal_ananta_ridha
```

### Step 2: Docker Setup

```bash
# Install dependencies
docker run --rm -v $(pwd):/app composer install
docker run --rm -v $(pwd):/app -w /app node:16 npm install
```

### Step 3: Environment Setup

```bash
cp .env.example .env
docker run --rm -v $(pwd):/app php:8.1-cli php artisan key:generate
```

### Step 4: Database Setup

```bash
# Start MySQL container
docker run -d --name mysql-db -e MYSQL_ROOT_PASSWORD=password -e MYSQL_DATABASE=fs_bcl -p 3306:3306 mysql:8.0

# Run migrations
docker run --rm -v $(pwd):/app --link mysql-db:mysql php:8.1-cli php artisan migrate:fresh --seed
```

## 🔧 Troubleshooting

### Common Issues & Solutions

#### 1. **Composer Issues**

```bash
# Clear composer cache
composer clear-cache

# Update composer
composer self-update

# Reinstall dependencies
rm -rf vendor composer.lock
composer install
```

#### 2. **Permission Issues**

```bash
# Set proper permissions
chmod -R 755 storage bootstrap/cache

# Change ownership (Linux/Mac)
sudo chown -R www-data:www-data storage bootstrap/cache
```

#### 3. **Database Connection Issues**

```bash
# Test database connection
php artisan tinker
>>> DB::connection()->getPdo();

# Check database configuration
php artisan config:show database
```

#### 4. **Migration Issues**

```bash
# Reset migrations
php artisan migrate:reset

# Fresh migration
php artisan migrate:fresh --seed

# Check migration status
php artisan migrate:status
```

#### 5. **Asset Compilation Issues**

```bash
# Clear node modules
rm -rf node_modules package-lock.json

# Reinstall
npm install

# Clear cache
npm cache clean --force
```

## 🧪 Testing Installation

### 1. **Check Routes**

```bash
php artisan route:list
```

### 2. **Test Database Connection**

```bash
php artisan tinker
>>> DB::table('armadas')->count();
```

### 3. **Check Sample Data**

```bash
php artisan tinker
>>> App\Models\Armada::count();
>>> App\Models\Pengiriman::count();
```

### 4. **Access Application**

-   Buka browser dan akses `http://localhost:8000`
-   Test semua fitur utama:
    -   ✅ Dashboard tracking
    -   ✅ Manajemen armada
    -   ✅ Pengiriman
    -   ✅ Pemesanan
    -   ✅ Check-in
    -   ✅ Laporan

## 🚀 Production Deployment

### 1. **Environment Configuration**

```bash
# Production environment
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database (production)
DB_CONNECTION=mysql
DB_HOST=your_production_host
DB_DATABASE=fs_bcl_production
DB_USERNAME=production_user
DB_PASSWORD=secure_production_password
```

### 2. **Optimization**

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

### 3. **Web Server Configuration**

#### Apache (.htaccess)

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

#### Nginx

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/fs_bcl_faishal_ananta_ridha/public;

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

## 📱 Mobile Development

### PWA Setup (Optional)

```bash
# Install PWA plugin
npm install @vite-pwa/laravel

# Configure PWA
php artisan vendor:publish --tag=laravel-pwa
```

## 🔒 Security Checklist

-   [ ] Change default database password
-   [ ] Set `APP_DEBUG=false` in production
-   [ ] Use HTTPS in production
-   [ ] Configure proper file permissions
-   [ ] Enable firewall rules
-   [ ] Regular backup database
-   [ ] Update dependencies regularly

## 📞 Support

Jika mengalami masalah dalam instalasi:

1. **Check Documentation**: Baca dokumentasi lengkap di folder `docs/`
2. **GitHub Issues**: Buat issue di repository GitHub
3. **Log Files**: Check log files di `storage/logs/laravel.log`
4. **Debug Mode**: Enable debug mode untuk troubleshooting

---

_Panduan instalasi ini memberikan langkah-langkah lengkap untuk setup Fleet Management System dari development hingga production._
