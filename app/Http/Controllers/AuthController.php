<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Memproses data login yang diinput
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        // Tentukan field login: 'email' jika input format email, selain itu 'name'
        $loginField = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $credentials = [
            $loginField => $request->name,
            'password' => $request->password,
        ];

        // Cek apakah nama/email dan password cocok di database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard'); // Jika berhasil, arahkan ke dashboard
        }

        // Jika salah, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'name' => 'Nama pengguna/Email atau password salah!',
        ]);
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Setelah logout kembali ke halaman awal (login)
    }
}