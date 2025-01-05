<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel user
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->timestamps();
        });

        // Tabel produk
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('deskripsi');
            $table->decimal('harga', 10, 2);
            $table->string('kategori');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('pengiriman');
        Schema::dropIfExists('detail_pesanan');
        Schema::dropIfExists('pemesanan');
        Schema::dropIfExists('keranjang');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('user');
    }
};
