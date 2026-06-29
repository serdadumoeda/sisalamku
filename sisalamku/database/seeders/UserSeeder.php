<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Keuangan (Bisa kelola master data & user)
        User::create(['name' => 'Siti_Admin', 'email' => 'admin@bpvp.go.id', 'password' => Hash::make('12345'), 'role' => 'Admin Keuangan', 'bidang' => 'Keuangan']);

        // 2. Operator Bidang (Yang membuat pengajuan)
        User::create(['name' => 'Budi_Penyelenggara', 'email' => 'budi@bpvp.go.id', 'password' => Hash::make('12345'), 'role' => 'Operator Bidang', 'bidang' => 'Penyelenggara']);
        User::create(['name' => 'Ani_Pemberdayaan', 'email' => 'ani@bpvp.go.id', 'password' => Hash::make('12345'), 'role' => 'Operator Bidang', 'bidang' => 'Pemberdayaan']);
        User::create(['name' => 'Joko_Umum', 'email' => 'joko@bpvp.go.id', 'password' => Hash::make('12345'), 'role' => 'Operator Bidang', 'bidang' => 'Umum']);

        // 3. Verifikator Keuangan (Yang mengecek nota/SPJ)
        User::create(['name' => 'Rina_Verifikator', 'email' => 'rina@bpvp.go.id', 'password' => Hash::make('12345'), 'role' => 'Verifikator Keuangan', 'bidang' => 'Keuangan']);

        // 4. PPK (Pejabat Pembuat Komitmen - Penyetuju akhir internal)
        User::create(['name' => 'Bapak_Agus_PPK', 'email' => 'agus.ppk@bpvp.go.id', 'password' => Hash::make('12345'), 'role' => 'PPK', 'bidang' => 'None']);

        // 5. Operator Pembayaran (Yang input ke Aplikasi SAKTI Kemenkeu)
        User::create(['name' => 'Randi_Sakti', 'email' => 'randi@bpvp.go.id', 'password' => Hash::make('12345'), 'role' => 'Operator Pembayaran', 'bidang' => 'Keuangan']);

        // 6. Bendahara (Yang mencairkan dan input SP2D)
        User::create(['name' => 'Ibu_Diana_Bendahara', 'email' => 'diana@bpvp.go.id', 'password' => Hash::make('12345'), 'role' => 'Bendahara', 'bidang' => 'Keuangan']);
    }
}