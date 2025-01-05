<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    /** @use HasFactory<\Database\Factories\PemesananFactory> */
    use HasFactory;

    protected $table = 'pemesanan';
    public $timestamps = true;


    protected $fillable = [
        'user_id',
        'total_price',
        'status'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailPemesanan()
    {
        return $this->hasMany(DetailPemesanan::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class);
    }
}
