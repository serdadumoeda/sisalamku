<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengajuan_ls', function (Blueprint $table) {
            // Menambah kolom untuk mencatat siapa yang memproses
            $table->unsignedBigInteger('verifikator_id')->nullable();
            $table->unsignedBigInteger('ppk_id')->nullable();
            $table->unsignedBigInteger('operator_pembayaran_id')->nullable();
            $table->unsignedBigInteger('bendahara_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_ls', function (Blueprint $table) {
            $table->dropColumn(['verifikator_id', 'ppk_id', 'operator_pembayaran_id', 'bendahara_id']);
        });
    }
};