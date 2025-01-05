<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
   public function index()
   {
       if(auth()->user->role == 'admin') {
           // Load pembayaran dengan relasi pemesanan dan user
           $pembayaran = Pembayaran::with(['pemesanan.user'])->get();
           return view('pages.admin.pembayaran.index', compact('pembayaran'));
       }
       return redirect()->route('home');
   }

   public function show($id)
   {
       if(auth()->user->role == 'admin') {
           // Load detail pembayaran
           $pembayaran = Pembayaran::with(['pemesanan.user', 'pemesanan.detailPemesanan.produk'])->find($id);
           return view('pages.admin.pembayaran.show', compact('pembayaran'));
       }
       return redirect()->route('home');
   }

   public function update(Request $request, $id)
   {
       if(auth()->user->role == 'admin') {
           $request->validate([
               'status' => 'required|in:pending,verified,rejected'
           ]);

           $pembayaran = Pembayaran::find($id);

           // Update status pembayaran
           $pembayaran->update([
               'status' => $request->status
           ]);

           // Jika pembayaran diverifikasi, update status pemesanan jadi processing
           if($request->status == 'verified') {
               $pembayaran->pemesanan->update([
                   'status' => 'processing'
               ]);
           }
           // Jika pembayaran ditolak, update status pemesanan jadi cancelled
           else if($request->status == 'rejected') {
               $pembayaran->pemesanan->update([
                   'status' => 'cancelled'
               ]);
           }

           return redirect()->route('pembayaran.index')
               ->with('success', 'Status pembayaran berhasil diupdate');
       }
       return redirect()->route('home');
   }

   // Function yang tidak digunakan bisa dihapus
   // public function create() {}
   // public function store() {}
   // public function edit() {}
   // public function destroy() {}
}
    