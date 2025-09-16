<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;

    protected $fillable = [
        'armada_id',
        'lat',
        'lng',
    ];

    public function armada()
    {
        return $this->belongsTo(Armada::class);
    }
}
