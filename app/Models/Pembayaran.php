<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    /** @use HasFactory<\Database\Factories\PembayaranFactory> */
    use HasFactory;

    protected $table = 'pembayaran';
    public $timestamps = true;


    protected $fillable = [
        'pemesanan_id',
        'status',
        'bukti_pembayaran'
    ];

    // Relationships
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
