<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggaranController extends Controller
{
    // Menampilkan halaman PDF Anggaran
    public function index()
    {
        return view('anggaran.index');
    }

    // Proses Admin mengunggah/update PDF
    public function upload(Request $request)
    {
        // Pastikan hanya Admin yang bisa upload
        if (Auth::user()->role != 'Admin Keuangan') {
            abort(403, 'Hanya Admin Keuangan yang dapat mengupdate anggaran.');
        }

        // Validasi file harus PDF
        $request->validate([
            'file_anggaran' => 'required|mimes:pdf|max:5000' // maksimal 5MB
        ]);

        // Simpan file ke folder public/uploads dengan nama tetap agar menimpa file lama
        $request->file('file_anggaran')->move(public_path('uploads'), 'anggaran_terbaru.pdf');

        return back()->with('success', 'Dokumen PDF Anggaran berhasil diperbarui!');
    }
}