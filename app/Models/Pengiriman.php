<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengirimans';

    protected $fillable = [
        'nomor_pengiriman',
        'tanggal_pengiriman',
        'asal',
        'tujuan',
        'status', // tertunda | perjalanan | tiba
        'detail_barang',
        'armada_id',
    ];

    protected $casts = [
        'tanggal_pengiriman' => 'date',
    ];

    public function armada()
    {
        return $this->belongsTo(Armada::class);
    }
}
