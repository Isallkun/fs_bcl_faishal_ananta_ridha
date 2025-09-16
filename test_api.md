# 🧪 API Testing Guide - Fleet Management System

## 📋 Test API Endpoints

Server berjalan di: `http://localhost:8000`

### 1. **Health Check**

```bash
curl -X GET "http://localhost:8000/api/health"
```

### 2. **System Status**

```bash
curl -X GET "http://localhost:8000/api/status"
```

### 3. **Armadas API**

#### Get All Armadas

```bash
curl -X GET "http://localhost:8000/api/armadas"
```

#### Get Armada by ID

```bash
curl -X GET "http://localhost:8000/api/armadas/1"
```

#### Create New Armada

```bash
curl -X POST "http://localhost:8000/api/armadas" \
  -H "Content-Type: application/json" \
  -d '{
    "nomor_armada": "ARM004",
    "jenis_kendaraan": "Van Kecil",
    "kapasitas": 800,
    "status": "tersedia"
  }'
```

#### Update Armada

```bash
curl -X PUT "http://localhost:8000/api/armadas/1" \
  -H "Content-Type: application/json" \
  -d '{
    "nomor_armada": "ARM001",
    "jenis_kendaraan": "Truck Besar",
    "kapasitas": 6000,
    "status": "tidak tersedia"
  }'
```

#### Search Armadas

```bash
curl -X GET "http://localhost:8000/api/search/armadas?q=Truck"
```

### 4. **Pengirimans API**

#### Get All Pengirimans

```bash
curl -X GET "http://localhost:8000/api/pengirimans"
```

#### Get Pengiriman by ID

```bash
curl -X GET "http://localhost:8000/api/pengirimans/1"
```

#### Create New Pengiriman

```bash
curl -X POST "http://localhost:8000/api/pengirimans" \
  -H "Content-Type: application/json" \
  -d '{
    "nomor_pengiriman": "SHIP003",
    "tanggal_pengiriman": "2025-09-18",
    "asal": "Surabaya",
    "tujuan": "Jakarta",
    "status": "tertunda",
    "detail_barang": "Bahan makanan dan minuman",
    "armada_id": 1
  }'
```

#### Track Pengiriman

```bash
curl -X GET "http://localhost:8000/api/pengirimans/track/SHIP001"
```

#### Update Status

```bash
curl -X PATCH "http://localhost:8000/api/pengirimans/1/status" \
  -H "Content-Type: application/json" \
  -d '{
    "status": "perjalanan"
  }'
```

### 5. **Pemesanans API**

#### Get All Pemesanans

```bash
curl -X GET "http://localhost:8000/api/pemesanans"
```

#### Create New Pemesanan

```bash
curl -X POST "http://localhost:8000/api/pemesanans" \
  -H "Content-Type: application/json" \
  -d '{
    "armada_id": 2,
    "tanggal_pemesanan": "2025-09-18",
    "detail_barang": "Peralatan elektronik"
  }'
```

### 6. **Checkins API**

#### Get All Checkins

```bash
curl -X GET "http://localhost:8000/api/checkins"
```

#### Create New Checkin

```bash
curl -X POST "http://localhost:8000/api/checkins" \
  -H "Content-Type: application/json" \
  -d '{
    "armada_id": 1,
    "lat": -6.200000,
    "lng": 106.816666
  }'
```

#### Get Latest Checkins

```bash
curl -X GET "http://localhost:8000/api/checkins/latest?limit=5"
```

#### Get Checkins by Armada

```bash
curl -X GET "http://localhost:8000/api/checkins/armada/1"
```

### 7. **Reports API**

#### Get Shipment Statistics

```bash
curl -X GET "http://localhost:8000/api/reports/shipments"
```

#### Get Status Summary

```bash
curl -X GET "http://localhost:8000/api/reports/status-summary"
```

#### Get Dashboard Data

```bash
curl -X GET "http://localhost:8000/api/reports/dashboard"
```

#### Get Armada Usage

```bash
curl -X GET "http://localhost:8000/api/reports/armada-usage"
```

### 8. **Search API**

#### Global Search

```bash
curl -X GET "http://localhost:8000/api/search/global?q=SHIP&type=all"
```

#### Search Pengirimans

```bash
curl -X GET "http://localhost:8000/api/search/pengirimans?q=Jakarta"
```

## 📱 Expected Responses

### Success Response Format

```json
{
    "ok": true,
    "data": { ... },
    "message": "Success message"
}
```

### Error Response Format

```json
{
    "ok": false,
    "error": "Error message",
    "code": 400
}
```

### Pagination Format

```json
{
    "ok": true,
    "data": [...],
    "pagination": {
        "current_page": 1,
        "last_page": 5,
        "per_page": 10,
        "total": 50,
        "from": 1,
        "to": 10
    }
}
```

## 🔧 Testing Tools

### Postman Collection

Import the following collection for comprehensive testing:

```json
{
    "info": {
        "name": "Fleet Management API",
        "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
    },
    "item": [
        {
            "name": "Health Check",
            "request": {
                "method": "GET",
                "header": [],
                "url": {
                    "raw": "{{base_url}}/api/health",
                    "host": ["{{base_url}}"],
                    "path": ["api", "health"]
                }
            }
        }
    ],
    "variable": [
        {
            "key": "base_url",
            "value": "http://localhost:8000"
        }
    ]
}
```

### Browser Testing

Buka browser dan akses:

-   `http://localhost:8000/api/health`
-   `http://localhost:8000/api/status`
-   `http://localhost:8000/api/armadas`

## ✅ Test Checklist

-   [ ] Health check endpoint
-   [ ] System status endpoint
-   [ ] Armadas CRUD operations
-   [ ] Pengirimans CRUD operations
-   [ ] Pemesanans CRUD operations
-   [ ] Checkins CRUD operations
-   [ ] Reports endpoints
-   [ ] Search endpoints
-   [ ] Error handling
-   [ ] Validation responses
-   [ ] Pagination
-   [ ] JSON response format

---

_Gunakan panduan ini untuk testing API endpoints Fleet Management System secara menyeluruh._
