<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        if(auth()->user->role == 'admin') {
            $produks = Produk::all();
            return view('pages.admin.produk.index', compact('produks'));
        }
        return redirect()->route('home');
    }

    public function create()
    {
        if(auth()->user->role == 'admin') {
            return view('pages.admin.produk.create');
        }
        return redirect()->route('home');
    }

    public function store(Request $request)
    {
        if(auth()->user->role == 'admin') {
            $request->validate([
                'name' => 'required',
                'deskripsi' => 'required',
                'harga' => 'required|numeric',
                'kategori' => 'required',
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);

            Produk::create([
                'name' => $request->name,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'kategori' => $request->kategori,
                'gambar' => $imageName
            ]);

            return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
        }
        return redirect()->route('home');
    }

    public function edit($id)
    {
        if(auth()->user->role == 'admin') {
            $produk = Produk::find($id);
            return view('pages.admin.produk.edit', compact('produk'));
        }
        return redirect()->route('home');
    }

    public function update(Request $request, $id)
    {
        if(auth()->user->role == 'admin') {
            $produk = Produk::find($id);

            $request->validate([
                'name' => 'required',
                'deskripsi' => 'required',
                'harga' => 'required|numeric',
                'kategori' => 'required'
            ]);

            $updateData = [
                'name' => $request->name,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'kategori' => $request->kategori
            ];

            // Jika ada gambar baru
            if ($request->hasFile('gambar')) {
                $request->validate([
                    'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
                ]);

                $imageName = time().'.'.$request->gambar->extension();
                $request->gambar->move(public_path('images'), $imageName);
                $updateData['gambar'] = $imageName;
            }

            $produk->update($updateData);

            return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate');
        }
        return redirect()->route('home');
    }

    public function destroy($id)
    {
        if(auth()->user->role == 'admin') {
            $produk = Produk::find($id);
            $produk->delete();
            return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
        }
        return redirect()->route('home');
    }
}
