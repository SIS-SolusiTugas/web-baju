<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
   public function index()
   {
       if(auth()->user->role == 'admin') {
           $pemesanans = Pemesanan::with(['user', 'detailPemesanan'])->get();
           return view('pages.admin.pemesanan.index', compact('pemesanans'));
       }
       return redirect()->route('home');
   }

   public function show($id)
   {
       if(auth()->user->role == 'admin') {
           $pemesanan = Pemesanan::with(['user', 'detailPemesanan.produk'])->find($id);
           return view('pages.admin.pemesanan.show', compact('pemesanan'));
       }
       return redirect()->route('home');
   }

   public function update(Request $request, $id)
   {
       if(auth()->user->role == 'admin') {
           $request->validate([
               'status' => 'required|in:pending,processing,shipping,completed,cancelled'
           ]);

           $pemesanan = Pemesanan::find($id);
           $pemesanan->update([
               'status' => $request->status
           ]);

           return redirect()->route('pemesanan.index')->with('success', 'Status pesanan berhasil diupdate');
       }
       return redirect()->route('home');
   }

   // Function yang tidak digunakan bisa dihapus
   // public function create(){}
   // public function store(){}
   // public function edit(){}
   // public function destroy(){}
}
