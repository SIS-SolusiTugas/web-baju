<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
   public function index()
   {
       if(auth()->user->role == 'admin') {
           // Load pengiriman beserta relasi pemesanan dan usernya
           $pengiriman = Pengiriman::with(['pemesanan.user'])->get();
           return view('pages.admin.pengiriman.index', compact('pengiriman'));
       }
       return redirect()->route('home');
   }

   public function show($id)
   {
       if(auth()->user->role == 'admin') {
           // Load detail pengiriman
           $pengiriman = Pengiriman::with(['pemesanan.user', 'pemesanan.detailPemesanan.produk'])->find($id);
           return view('pages.admin.pengiriman.show', compact('pengiriman'));
       }
       return redirect()->route('home');
   }

   public function update(Request $request, $id)
   {
       if(auth()->user->role == 'admin') {
           $request->validate([
               'status' => 'required|in:packing,shipped,delivered',
               'alamat' => 'required_if:status,packing' // Alamat wajib diisi saat status packing
           ]);

           $pengiriman = Pengiriman::find($id);
           $pengiriman->update([
               'status' => $request->status,
               'alamat' => $request->alamat ?? $pengiriman->alamat
           ]);

           return redirect()->route('pengiriman.index')->with('success', 'Status pengiriman berhasil diupdate');
       }
       return redirect()->route('home');
   }

   // Function yang tidak digunakan bisa dihapus
   // public function create() {}
   // public function store() {}
   // public function edit() {}
   // public function destroy() {}
}
