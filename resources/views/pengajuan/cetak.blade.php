{{-- File: resources/views/pengajuan/cetak.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <title>Cetak Ringkasan - {{ $pengajuan->no_pengajuan }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 14px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .btn-print {
            padding: 10px 20px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
            margin-bottom: 20px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <button onclick="window.print()" class="no-print btn-print">🖨️ Cetak Dokumen</button>

    <div class="header">
        <h3>RINGKASAN PENGAJUAN PEMBAYARAN</h3>
        <h4>KEMENTERIAN KETENAGAKERJAAN - BPVP SURAKARTA</h4>
    </div>

    <p><strong>Nomor Pengajuan:</strong> {{ $pengajuan->no_pengajuan }}</p>
    <p><strong>Tanggal Pengajuan:</strong> {{ $pengajuan->tgl_pengajuan }}</p>
    <p><strong>Status Terakhir:</strong> {{ $pengajuan->status }}</p>

    <table class="table">
        <tr>
            <th width="30%">Bidang / Unit Kerja</th>
            <td>{{ $pengajuan->bidang }}</td>
        </tr>
        <tr>
            <th>Nama Kegiatan</th>
            <td>{{ $pengajuan->nama_kegiatan }}</td>
        </tr>
        <tr>
            <th>Nomor Akun</th>
            <td>{{ $pengajuan->no_akun }}</td>
        </tr>
        <tr>
            <th>Jenis Belanja</th>
            <td>{{ $pengajuan->jenis_belanja }}</td>
        </tr>
        <tr>
            <th>Uraian Pembayaran</th>
            <td>{{ $pengajuan->uraian_pembayaran }}</td>
        </tr>
        <tr>
            <th>Nilai Bruto</th>
            <td>Rp {{ number_format($pengajuan->nilai_bruto, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Nilai Neto (Dibayarkan)</th>
            <td>Rp {{ number_format($pengajuan->nilai_neto, 2, ',', '.') }}</td>
        </tr>
    </table>

    <br><br>
    <table style="width: 100%; text-align: center;">
        <tr>
            <td width="50%">
                <p>Mengetahui,</p>
                <br><br><br>
                <p>( ........................................ )</p>
            </td>
            <td width="50%">
                <p>Surakarta, {{ date('d F Y') }}</p>
                <br><br><br>
                <p>( {{ $pengajuan->user->name ?? 'Pembuat Pengajuan' }} )</p>
            </td>
        </tr>
    </table>

</body>

</html>