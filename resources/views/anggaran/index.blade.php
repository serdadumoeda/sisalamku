{{-- File: resources/views/anggaran/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Ketersediaan Anggaran')

@section('content')
    <div class="card shadow border-0 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Informasi Ketersediaan Anggaran (DIPA)</h4>

            {{-- Tombol Khusus Admin --}}
            @if(Auth::user()->role == 'Admin Keuangan')
                <form action="{{ route('anggaran.upload') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2">
                    @csrf
                    <input type="file" name="file_anggaran" class="form-control form-control-sm" accept="application/pdf"
                        required>
                    <button type="submit" class="btn btn-primary btn-sm">Update PDF</button>
                </form>
            @endif
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="alert alert-info small">
            <strong>Pemberitahuan:</strong> Sebelum mengajukan pembayaran, pastikan ketersediaan pagu anggaran pada
            dokumen di bawah ini mencukupi. Jika pagu habis, pengajuan akan ditolak oleh Verifikator.
        </div>

        {{-- Menampilkan PDF langsung di halaman --}}
        <div class="ratio ratio-16x9 border">
            @if(file_exists(public_path('uploads/anggaran_terbaru.pdf')))
                <iframe src="{{ asset('uploads/anggaran_terbaru.pdf') }}" allowfullscreen></iframe>
            @else
                <div class="d-flex align-items-center justify-content-center bg-light">
                    <p class="text-muted">Dokumen anggaran belum diunggah oleh Admin.</p>
                </div>
            @endif
        </div>
    </div>
@endsection