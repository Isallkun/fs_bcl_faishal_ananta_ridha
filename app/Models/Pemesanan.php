<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'armada_id',
        'tanggal_pemesanan',
        'detail_barang',
        'status', // pending | confirmed | selesai
    ];

    protected $casts = [
        'tanggal_pemesanan' => 'date',
    ];

    public function armada()
    {
        return $this->belongsTo(Armada::class);
    }
}
