<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if(auth()->user->role == 'admin') {
            $users = User::all();
            return view('pages.admin.user.index', compact('users'));
        }
        return redirect()->route('home');
    }

    public function create()
    {
        if(auth()->user->role == 'admin') {
            return view('pages.admin.user.create');
        }
        return redirect()->route('home');
    }

    public function store(Request $request)
    {
        if(auth()->user->role == 'admin') {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:user'],
                'password' => ['required', 'confirmed'],
                'role' => ['required', 'in:admin,pelanggan']
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);

            return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
        }
        return redirect()->route('home');
    }

    public function edit($id)
    {
        if(auth()->user->role == 'admin') {
            $user = User::find($id);
            return view('pages.admin.user.edit', compact('user'));
        }
        return redirect()->route('home');
    }

    public function update(Request $request, $id)
    {
        if(auth()->user->role == 'admin') {
            $user = User::find($id);

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:user,email,'.$id],
                'role' => ['required', 'in:admin,pelanggan']
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role
            ]);

            return redirect()->route('user.index')->with('success', 'User berhasil diupdate');
        }
        return redirect()->route('home');
    }

    public function destroy($id)
    {
        if(auth()->user->role == 'admin') {
            $user = User::find($id);
            $user->delete();
            return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
        }
        return redirect()->route('home');
    }
}
