<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    public $timestamps = true;


    protected $fillable = [
        'name',
        'deskripsi',
        'harga',
        'kategori',
        'gambar'
    ];

    // Relationships
    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function detailPemesanans()
    {
        return $this->hasMany(DetailPemesanan::class);
    }
}
