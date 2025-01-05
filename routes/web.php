<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\UserDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// route user (pelanggan)
Route::middleware('auth', 'userRole', 'verified')->group(function () {
    Route::get('/dashboard/user', [UserDashboard::class, 'index'])->name('dashboard');
});

// route admin
Route::middleware('auth', 'adminRole')->group(function () {
    Route::get('/dashboard/admin', [AdminDashboard::class, 'index'])->name('dashboard.admin');
});


// Tambahkan route admin basic
Route::middleware(['auth'])->group(function () {
    Route::resource('admin/produk', ProdukController::class);
});

// Profile routes tetap sama
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
