<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    /** @use HasFactory<\Database\Factories\PengirimanFactory> */
    use HasFactory;

    protected $table = 'pengiriman';
    public $timestamps = true;


    protected $fillable = [
        'pemesanan_id',
        'status',
        'alamat'
    ];

    // Relationships
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
