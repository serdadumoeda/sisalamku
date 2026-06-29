<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PengajuanLs;

class PengajuanLsSeeder extends Seeder
{
    public function run(): void
    {
        $tglBulanTahun = date('dmY');

        // 1. Skenario: SUDAH CAIR & SELESAI (Alur Selesai 100%)
        PengajuanLs::create([
            'no_pengajuan' => "KU-$tglBulanTahun-001",
            'tgl_pengajuan' => now()->subDays(5),
            'user_id' => 2, // Budi Penyelenggaraan
            'bidang' => 'Penyelenggara',
            'nama_kegiatan' => 'Honorarium Instruktur Pelatihan Barista Angkatan I',
            'no_akun' => '521211',
            'jenis_belanja' => 'Honorarium',
            'nilai_bruto' => 10000000,
            'nilai_neto' => 9500000,
            'uraian_pembayaran' => 'Pembayaran honor 2 instruktur pelatihan barista selama 10 hari.',
            'link_google_drive' => 'https://drive.google.com/folderview?id=dummy1',
            'status' => 'Selesai',
            'no_spm' => '260541X',
            'kategori_pengajuan' => 'LS Kontrak',
            'tgl_spm' => now()->subDays(3)->format('Y-m-d'),
            'no_sp2d' => '100299388A',
            'tgl_cair' => now()->subDays(1),
            'bukti_penyerahan' => 'https://drive.google.com/file/d/dummy-receipt/view',
        ]);

        // 2. Skenario: MENUNGGU SP2D (Di Bendahara)
        PengajuanLs::create([
            'no_pengajuan' => "KU-$tglBulanTahun-002",
            'tgl_pengajuan' => now()->subDays(4),
            'user_id' => 3, // Ani Pemberdayaan
            'bidang' => 'Pemberdayaan',
            'nama_kegiatan' => 'Pembayaran Uang Saku Peserta Pelatihan Menjahit',
            'no_akun' => '521213',
            'jenis_belanja' => 'Pembayaran Uang Saku Peserta',
            'nilai_bruto' => 15000000,
            'nilai_neto' => 15000000,
            'uraian_pembayaran' => 'Uang saku untuk 16 peserta pelatihan menjahit.',
            'link_google_drive' => 'https://drive.google.com/folderview?id=dummy2',
            'status' => 'Belum Terbit SP2D',
            'no_spm' => '260542Y',
            'kategori_pengajuan' => 'GU/UP/TUP',
            'tgl_spm' => now()->subDays(2)->format('Y-m-d'),
        ]);

        // 3. Skenario: PROSES SAKTI (Di Operator Pembayaran)
        PengajuanLs::create([
            'no_pengajuan' => "KU-$tglBulanTahun-003",
            'tgl_pengajuan' => now()->subDays(3),
            'user_id' => 4, // Joko Umum
            'bidang' => 'Umum',
            'nama_kegiatan' => 'Pemeliharaan AC Gedung Aula BPVP',
            'no_akun' => '523111',
            'jenis_belanja' => 'Pemeliharaan',
            'nilai_bruto' => 4500000,
            'nilai_neto' => 4410000,
            'uraian_pembayaran' => 'Service cuci AC dan tambah freon untuk 5 unit di Aula.',
            'link_google_drive' => 'https://drive.google.com/folderview?id=dummy3',
            'status' => 'Diajukan ke SAKTI',
        ]);

        // 4. Skenario: DISETUJUI PPK (Menunggu Input SPM)
        PengajuanLs::create([
            'no_pengajuan' => "KU-$tglBulanTahun-004",
            'tgl_pengajuan' => now()->subDays(2),
            'user_id' => 2, // Budi Penyelenggaraan
            'bidang' => 'Penyelenggara',
            'nama_kegiatan' => 'Pengadaan Modul Pelatihan Desain Grafis',
            'no_akun' => '521211',
            'jenis_belanja' => 'Pengadaan Barang',
            'nilai_bruto' => 2000000,
            'nilai_neto' => 2000000,
            'uraian_pembayaran' => 'Cetak modul warna sebanyak 20 buku.',
            'link_google_drive' => 'https://drive.google.com/folderview?id=dummy4',
            'status' => 'Disetujui PPK',
        ]);

        // 5. Skenario: PERLU PERBAIKAN (Dikembalikan oleh Verifikator ke Pemohon)
        PengajuanLs::create([
            'no_pengajuan' => "KU-$tglBulanTahun-005",
            'tgl_pengajuan' => now()->subDays(1),
            'user_id' => 3, // Ani Pemberdayaan
            'bidang' => 'Pemberdayaan',
            'nama_kegiatan' => 'Konsumsi Rapat Evaluasi Pemberdayaan',
            'no_akun' => '521219',
            'jenis_belanja' => 'Lainnya',
            'nilai_bruto' => 800000,
            'nilai_neto' => 800000,
            'uraian_pembayaran' => 'Snack dan makan siang rapat internal bidang.',
            'link_google_drive' => 'https://drive.google.com/folderview?id=dummy5',
            'status' => 'Perlu Perbaikan',
            'catatan_koreksi' => 'Mohon lampirkan nota kwitansi asli dan daftar hadir rapat yang sudah ditandatangani. Di link Google Drive belum ada.',
        ]);

        // 6. Skenario: MENUNGGU VERIFIKASI (Baru saja diajukan)
        PengajuanLs::create([
            'no_pengajuan' => "KU-$tglBulanTahun-006",
            'tgl_pengajuan' => now(),
            'user_id' => 4, // Joko Umum
            'bidang' => 'Umum',
            'nama_kegiatan' => 'Pembelian ATK Bulanan Kantor',
            'no_akun' => '521211',
            'jenis_belanja' => 'Pengadaan Barang',
            'nilai_bruto' => 3500000,
            'nilai_neto' => 3500000,
            'uraian_pembayaran' => 'Kertas HVS, Tinta Printer, dan Pulpen.',
            'link_google_drive' => 'https://drive.google.com/folderview?id=dummy6',
            'status' => 'Menunggu Verifikasi',
        ]);

        // 7. Skenario: DRAFT (Belum dikirim oleh pemohon)
        PengajuanLs::create([
            'no_pengajuan' => "KU-$tglBulanTahun-007",
            'tgl_pengajuan' => now(),
            'user_id' => 2, // Budi Penyelenggaraan
            'bidang' => 'Penyelenggara',
            'nama_kegiatan' => 'Sewa Tenda Penutupan Pelatihan',
            'no_akun' => '522141',
            'jenis_belanja' => 'Lainnya',
            'nilai_bruto' => 1500000,
            'nilai_neto' => 1470000,
            'uraian_pembayaran' => 'Sewa tenda dan kursi untuk acara penutupan.',
            'link_google_drive' => 'https://drive.google.com/folderview?id=dummy7',
            'status' => 'Draft',
        ]);

        // 8. Skenario: DICAIRKAN (Menunggu Serah Terima Uang oleh Bendahara)
        PengajuanLs::create([
            'no_pengajuan' => "KU-$tglBulanTahun-008",
            'tgl_pengajuan' => now()->subDays(6),
            'user_id' => 3, // Ani Pemberdayaan
            'bidang' => 'Pemberdayaan',
            'nama_kegiatan' => 'Pembelian Konsumsi Diklat Kewirausahaan',
            'no_akun' => '521211',
            'jenis_belanja' => 'Lainnya',
            'nilai_bruto' => 5000000,
            'nilai_neto' => 5000000,
            'uraian_pembayaran' => 'Konsumsi makan dan snack diklat kewirausahaan.',
            'link_google_drive' => 'https://drive.google.com/folderview?id=dummy8',
            'status' => 'Dicairkan',
            'no_spm' => '260548Z',
            'kategori_pengajuan' => 'LS Non Kontrak',
            'tgl_spm' => now()->subDays(3)->format('Y-m-d'),
            'no_sp2d' => '100299389B',
            'tgl_cair' => now()->subDays(1),
        ]);
    }
}