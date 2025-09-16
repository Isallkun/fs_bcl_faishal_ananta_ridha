<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armada extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_armada',
        'jenis_kendaraan',
        'kapasitas',
        'status', // tersedia | tidak tersedia
    ];

    public function pengiriman()
    {
        return $this->hasMany(Pengiriman::class);
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function checkins()
    {
        return $this->hasMany(Checkin::class);
    }
}
