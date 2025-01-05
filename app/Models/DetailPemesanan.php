<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    /** @use HasFactory<\Database\Factories\DetailPemesananFactory> */
    use HasFactory;

    protected $table = 'detail_pesanan';

    protected $fillable = [
        'pemesanan_id',
        'produk_id',
        'kuantitas',
        'harga'
    ];

    // Relationships
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
