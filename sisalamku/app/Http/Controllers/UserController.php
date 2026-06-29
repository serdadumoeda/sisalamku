<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Hanya Admin yang boleh masuk
        if (Auth::user()->role != 'Admin Keuangan') {
            abort(403, 'Akses Ditolak');
        }

        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'Admin Keuangan')
            abort(403);

        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'role' => 'required',
            'bidang' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'bidang' => $request->bidang,
        ]);

        return back()->with('success', 'Akun pengguna baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (Auth::user()->role != 'Admin Keuangan') {
            abort(403, 'Akses Ditolak');
        }

        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role != 'Admin Keuangan') {
            abort(403, 'Akses Ditolak');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:users,name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:4',
            'role' => 'required',
            'bidang' => 'required',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->bidang = $request->bidang;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Akun pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (Auth::user()->role != 'Admin Keuangan') {
            abort(403, 'Akses Ditolak');
        }

        if ($id == Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang digunakan!');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Akun pengguna berhasil dihapus!');
    }
}