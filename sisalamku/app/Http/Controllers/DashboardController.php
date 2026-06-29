<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanLs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Untuk fungsi query lanjutan
use App\Models\Notification;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Siapkan Query Dasar
        $query = PengajuanLs::query();

        // Jika yang login adalah Operator Bidang, dia hanya menghitung data bidangnya saja
        if (Auth::user()->role == 'Operator Bidang') {
            $query->where('bidang', Auth::user()->bidang);
        }

        // 2. Menghitung Statistik Status (Kita gunakan 'clone' agar query dasarnya tidak tertimpa)
        $totalPengajuan = $query->count();
        $menungguVerifikasi = (clone $query)->where('status', 'Menunggu Verifikasi')->count();
        $perluPerbaikan = (clone $query)->where('status', 'Perlu Perbaikan')->count();
        $disetujui = (clone $query)->where('status', 'Disetujui PPK')->count();
        $diajukanSakti = (clone $query)->where('status', 'Diajukan ke SAKTI')->count();
        $menungguSp2d = (clone $query)->where('status', 'Belum Terbit SP2D')->count();
        $dicairkan = (clone $query)->where('status', 'Dicairkan')->count();

        // 3. Menghitung Total Nilai Neto Bulan Ini
        $bulanIni = date('m');
        $tahunIni = date('Y');
        $totalNilaiBulanIni = (clone $query)
            ->whereMonth('tgl_pengajuan', $bulanIni)
            ->whereYear('tgl_pengajuan', $tahunIni)
            ->sum('nilai_neto');

        // 4. Siapkan Data untuk Grafik (Jumlah Pengajuan per Bidang)
        // Kita ambil semua data secara global untuk ditampilkan di grafik
        $dataGrafik = PengajuanLs::select('bidang', DB::raw('count(*) as total'))
            ->groupBy('bidang')
            ->get();

        // Memecah data agar mudah dibaca oleh Javascript (Chart.js)
        $labelBidang = [];
        $angkaBidang = [];
        foreach ($dataGrafik as $data) {
            $labelBidang[] = $data->bidang;
            $angkaBidang[] = $data->total;
        }

        // 5. Kirim semua data tersebut ke file tampilan (view)
        return view('dashboard', compact(
            'totalPengajuan',
            'menungguVerifikasi',
            'perluPerbaikan',
            'disetujui',
            'diajukanSakti',
            'menungguSp2d',
            'dicairkan',
            'totalNilaiBulanIni',
            'labelBidang',
            'angkaBidang'
        ));
    }

    public function markNotificationAsRead($id)
    {
        $notification = Notification::where('user_id', Auth::id())->findOrFail($id);
        $notification->is_read = true;
        $notification->save();

        return back();
    }
}