{{-- File: resources/views/pengajuan/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Pengajuan')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-custom p-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold text-dark mb-0">Daftar Pengajuan Pembayaran</h4>
                <p class="text-muted mb-0 small">Kelola dan lacak posisi berkas pengajuan SPJ Anda</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm rounded-pill px-3">
                    <i class="bi bi-arrow-left-short"></i> Dashboard
                </a>
                <a href="{{ route('pengajuan.excel') }}" class="btn btn-success btn-sm rounded-pill px-3">
                    <i class="bi bi-file-earmark-excel"></i> Ekspor ke Excel
                </a>
                @if(Auth::user()->role == 'Operator Bidang')
                    <a href="{{ route('pengajuan.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                        <i class="bi bi-plus-lg"></i> Tambah Pengajuan
                    </a>
                @endif
            </div>
        </div>

        <!-- Filter Form -->
        <form method="GET" class="row g-3 mb-4 bg-light p-3 rounded border border-light-subtle shadow-sm mx-0">
            <div class="col-md-5">
                <label class="form-label small fw-semibold text-secondary">Filter Bidang</label>
                <select name="bidang" class="form-select form-select-sm border-0 shadow-sm">
                    <option value="">-- Semua Bidang --</option>
                    @foreach($daftarBidang as $b)
                        <option value="{{ $b }}" {{ request('bidang') == $b ? 'selected' : '' }}>{{ $b }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label class="form-label small fw-semibold text-secondary">Filter Status</label>
                <select name="status" class="form-select form-select-sm border-0 shadow-sm">
                    <option value="">-- Semua Status --</option>
                    @foreach(['Draft', 'Menunggu Verifikasi', 'Perlu Perbaikan', 'Disetujui PPK', 'Diajukan ke SAKTI', 'Belum Terbit SP2D', 'Dicairkan'] as $s)
                        <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-dark btn-sm w-100 rounded-pill shadow-sm">
                    <i class="bi bi-funnel"></i> Saring Data
                </button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark rounded-top">
                    <tr>
                        <th class="ps-3">No Pengajuan</th>
                        <th>Tanggal</th>
                        <th>Bidang</th>
                        <th>Nama Kegiatan</th>
                        <th>Nilai Neto</th>
                        <th>Status Tracking</th>
                        <th class="text-center pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($daftarPengajuan as $p)
                        <tr>
                            <td class="ps-3"><strong>{{ $p->no_pengajuan }}</strong></td>
                            <td>{{ \Carbon\Carbon::parse($p->tgl_pengajuan)->format('d/m/Y') }}</td>
                            <td><span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-2 py-1 rounded">{{ $p->bidang }}</span></td>
                            <td><div class="text-truncate" style="max-width: 200px;" title="{{ $p->nama_kegiatan }}">{{ $p->nama_kegiatan }}</div></td>
                            <td class="fw-bold text-success">Rp {{ number_format($p->nilai_neto, 0, ',', '.') }}</td>
                            <td>
                                @if($p->status == 'Draft') 
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-50 px-2 py-1 rounded-pill"><i class="bi bi-pencil-square"></i> Draft</span>
                                @elseif($p->status == 'Menunggu Verifikasi') 
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-50 px-2 py-1 rounded-pill"><i class="bi bi-clock"></i> Verifikasi Keuangan</span>
                                @elseif($p->status == 'Perlu Perbaikan') 
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-50 px-2 py-1 rounded-pill"><i class="bi bi-exclamation-octagon"></i> Perlu Perbaikan</span>
                                @elseif($p->status == 'Disetujui PPK') 
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-50 px-2 py-1 rounded-pill"><i class="bi bi-person-check"></i> Disetujui PPK</span>
                                @elseif($p->status == 'Diajukan ke SAKTI') 
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-50 px-2 py-1 rounded-pill"><i class="bi bi-send-check"></i> Proses SAKTI</span>
                                @elseif($p->status == 'Belum Terbit SP2D') 
                                    <span class="badge bg-dark bg-opacity-10 text-dark border border-dark border-opacity-50 px-2 py-1 rounded-pill"><i class="bi bi-hourglass-split"></i> Menunggu SP2D</span>
                                @elseif($p->status == 'Dicairkan') 
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-50 px-2 py-1 rounded-pill"><i class="bi bi-check-circle-fill"></i> Sudah Cair</span>
                                @endif
                            </td>
                            <td class="text-center pe-3">
                                <a href="{{ route('pengajuan.show', $p->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold">
                                    <i class="bi bi-eye"></i> Detail / Proses
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i> Tidak ada data pengajuan pembayaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $daftarPengajuan->appends(request()->query())->links() }}
        </div>
    </div>
@endsection