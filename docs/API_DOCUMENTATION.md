# 🔌 API Documentation - Fleet Management System

## 📋 Overview

Fleet Management System menyediakan RESTful API untuk integrasi dengan aplikasi mobile dan sistem eksternal. API ini menggunakan JSON format dan mengikuti standar HTTP methods.

## 🔗 Base URL

```
Development: http://localhost:8000/api
Production: https://yourdomain.com/api
```

## 🔐 Authentication

Saat ini API menggunakan session-based authentication. Untuk production, disarankan menggunakan API tokens atau JWT.

## 📊 Response Format

### Success Response

```json
{
    "ok": true,
    "data": { ... },
    "message": "Success message"
}
```

### Error Response

```json
{
    "ok": false,
    "error": "Error message",
    "code": 400
}
```

## 🚛 Endpoints

### 1. **Armadas (Fleet Management)**

#### GET `/armadas`

Get list of all armadas

**Response:**

```json
{
    "ok": true,
    "data": [
        {
            "id": 1,
            "nomor_armada": "ARM001",
            "jenis_kendaraan": "Truck Besar",
            "kapasitas": 5000,
            "status": "tersedia",
            "created_at": "2025-09-16T10:00:00.000000Z",
            "updated_at": "2025-09-16T10:00:00.000000Z"
        }
    ]
}
```

#### POST `/armadas`

Create new armada

**Request Body:**

```json
{
    "nomor_armada": "ARM004",
    "jenis_kendaraan": "Van Kecil",
    "kapasitas": 800,
    "status": "tersedia"
}
```

**Response:**

```json
{
    "ok": true,
    "data": {
        "id": 4,
        "nomor_armada": "ARM004",
        "jenis_kendaraan": "Van Kecil",
        "kapasitas": 800,
        "status": "tersedia",
        "created_at": "2025-09-16T10:00:00.000000Z",
        "updated_at": "2025-09-16T10:00:00.000000Z"
    },
    "message": "Armada created successfully"
}
```

#### PUT `/armadas/{id}`

Update armada

**Request Body:**

```json
{
    "nomor_armada": "ARM004",
    "jenis_kendaraan": "Van Sedang",
    "kapasitas": 1200,
    "status": "tidak tersedia"
}
```

#### DELETE `/armadas/{id}`

Delete armada

**Response:**

```json
{
    "ok": true,
    "message": "Armada deleted successfully"
}
```

### 2. **Pengirimans (Shipments)**

#### GET `/pengirimans`

Get list of all shipments

**Query Parameters:**

-   `q`: Search by nomor_pengiriman or tujuan
-   `status`: Filter by status (tertunda, perjalanan, tiba)
-   `page`: Page number for pagination

**Example:**

```
GET /pengirimans?q=SHIP001&status=perjalanan&page=1
```

**Response:**

```json
{
    "ok": true,
    "data": [
        {
            "id": 1,
            "nomor_pengiriman": "SHIP001",
            "tanggal_pengiriman": "2025-09-17",
            "asal": "Jakarta",
            "tujuan": "Bandung",
            "status": "perjalanan",
            "detail_barang": "Elektronik dan peralatan kantor",
            "armada_id": 1,
            "armada": {
                "id": 1,
                "nomor_armada": "ARM001",
                "jenis_kendaraan": "Truck Besar"
            },
            "created_at": "2025-09-16T10:00:00.000000Z",
            "updated_at": "2025-09-16T10:00:00.000000Z"
        }
    ],
    "pagination": {
        "current_page": 1,
        "last_page": 1,
        "per_page": 10,
        "total": 1
    }
}
```

#### POST `/pengirimans`

Create new shipment

**Request Body:**

```json
{
    "nomor_pengiriman": "SHIP003",
    "tanggal_pengiriman": "2025-09-18",
    "asal": "Surabaya",
    "tujuan": "Jakarta",
    "status": "tertunda",
    "detail_barang": "Bahan makanan dan minuman",
    "armada_id": 2
}
```

#### PATCH `/pengirimans/{id}/status`

Update shipment status

**Request Body:**

```json
{
    "status": "tiba"
}
```

### 3. **Pemesanans (Bookings)**

#### POST `/pemesanans`

Create new booking

**Request Body:**

```json
{
    "armada_id": 1,
    "tanggal_pemesanan": "2025-09-18",
    "detail_barang": "Peralatan elektronik"
}
```

**Response:**

```json
{
    "ok": true,
    "data": {
        "id": 1,
        "armada_id": 1,
        "tanggal_pemesanan": "2025-09-18",
        "detail_barang": "Peralatan elektronik",
        "status": "confirmed",
        "created_at": "2025-09-16T10:00:00.000000Z",
        "updated_at": "2025-09-16T10:00:00.000000Z"
    },
    "message": "Booking created successfully"
}
```

### 4. **Check-ins (Location Tracking)**

#### GET `/checkins`

Get recent check-ins

**Response:**

```json
{
    "ok": true,
    "data": [
        {
            "id": 1,
            "armada_id": 1,
            "lat": "-6.200000",
            "lng": "106.816666",
            "armada": {
                "id": 1,
                "nomor_armada": "ARM001"
            },
            "created_at": "2025-09-16T10:00:00.000000Z",
            "updated_at": "2025-09-16T10:00:00.000000Z"
        }
    ]
}
```

#### POST `/checkins`

Create new check-in

**Request Body:**

```json
{
    "armada_id": 1,
    "lat": -6.2,
    "lng": 106.816666
}
```

**Response:**

```json
{
    "ok": true,
    "data": {
        "id": 2,
        "armada_id": 1,
        "lat": "-6.200000",
        "lng": "106.816666",
        "created_at": "2025-09-16T10:00:00.000000Z",
        "updated_at": "2025-09-16T10:00:00.000000Z"
    },
    "message": "Check-in recorded successfully"
}
```

### 5. **Reports**

#### GET `/reports/shipments`

Get shipment statistics

**Response:**

```json
{
    "ok": true,
    "data": [
        {
            "nomor_armada": "ARM001",
            "total_perjalanan": 2
        },
        {
            "nomor_armada": "ARM002",
            "total_perjalanan": 1
        }
    ]
}
```

#### GET `/reports/status-summary`

Get status summary

**Response:**

```json
{
    "ok": true,
    "data": {
        "tertunda": 5,
        "perjalanan": 3,
        "tiba": 12
    }
}
```

## 🔍 Search & Filter

### Global Search

```
GET /search?q=keyword&type=all
```

**Query Parameters:**

-   `q`: Search keyword
-   `type`: Search type (armadas, pengirimans, all)

### Filter Options

#### Armadas Filter

```
GET /armadas?jenis_kendaraan=Truck&status=tersedia
```

#### Pengirimans Filter

```
GET /pengirimans?status=perjalanan&asal=Jakarta
```

## 📄 Pagination

All list endpoints support pagination:

**Query Parameters:**

-   `page`: Page number (default: 1)
-   `per_page`: Items per page (default: 10, max: 100)

**Response includes:**

```json
{
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

## ⚠️ Error Handling

### HTTP Status Codes

-   `200`: Success
-   `201`: Created
-   `400`: Bad Request
-   `401`: Unauthorized
-   `403`: Forbidden
-   `404`: Not Found
-   `422`: Validation Error
-   `500`: Internal Server Error

### Validation Errors

```json
{
    "ok": false,
    "error": "Validation failed",
    "errors": {
        "nomor_armada": ["The nomor armada field is required."],
        "kapasitas": ["The kapasitas must be at least 1."]
    }
}
```

## 🔒 Security

### CSRF Protection

All POST/PUT/PATCH/DELETE requests require CSRF token:

**Header:**

```
X-CSRF-TOKEN: your_csrf_token
```

### Rate Limiting

API endpoints are rate limited to prevent abuse:

-   60 requests per minute per IP
-   1000 requests per hour per user

## 📱 Mobile Integration

### Check-in API for Mobile Apps

```javascript
// Example JavaScript integration
const checkIn = async (armadaId, lat, lng) => {
    const response = await fetch("/api/checkins", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({
            armada_id: armadaId,
            lat: lat,
            lng: lng,
        }),
    });

    const data = await response.json();
    return data;
};
```

### Real-time Updates (WebSocket)

```javascript
// Listen for real-time updates
const ws = new WebSocket("ws://localhost:8000/ws");
ws.onmessage = function (event) {
    const data = JSON.parse(event.data);
    console.log("Real-time update:", data);
};
```

## 🧪 Testing

### Postman Collection

Import the following collection for testing:

```json
{
    "info": {
        "name": "Fleet Management API",
        "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
    },
    "item": [
        {
            "name": "Get Armadas",
            "request": {
                "method": "GET",
                "header": [],
                "url": {
                    "raw": "{{base_url}}/armadas",
                    "host": ["{{base_url}}"],
                    "path": ["armadas"]
                }
            }
        }
    ]
}
```

### cURL Examples

#### Get All Armadas

```bash
curl -X GET "http://localhost:8000/api/armadas" \
  -H "Accept: application/json"
```

#### Create New Shipment

```bash
curl -X POST "http://localhost:8000/api/pengirimans" \
  -H "Content-Type: application/json" \
  -H "X-CSRF-TOKEN: your_token" \
  -d '{
    "nomor_pengiriman": "SHIP003",
    "tanggal_pengiriman": "2025-09-18",
    "asal": "Surabaya",
    "tujuan": "Jakarta",
    "status": "tertunda",
    "detail_barang": "Bahan makanan",
    "armada_id": 2
  }'
```

## 📊 API Usage Analytics

### Metrics Tracked

-   Request count per endpoint
-   Response time
-   Error rates
-   User activity

### Monitoring

-   Health check endpoint: `GET /api/health`
-   System status: `GET /api/status`

---

_Dokumentasi API ini memberikan panduan lengkap untuk integrasi dengan Fleet Management System melalui RESTful API._
