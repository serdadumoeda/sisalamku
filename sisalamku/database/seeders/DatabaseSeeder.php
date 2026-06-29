<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Memanggil kedua seeder yang telah kita buat
        $this->call([
            UserSeeder::class,
            PengajuanLsSeeder::class,
        ]);
    }
}