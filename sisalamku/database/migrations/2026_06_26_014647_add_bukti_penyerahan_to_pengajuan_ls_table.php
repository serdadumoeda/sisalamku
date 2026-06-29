<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengajuan_ls', function (Blueprint $table) {
            $table->string('status', 50)->default('Draft')->change();
            $table->string('bukti_penyerahan', 255)->nullable();
        });

        // Drop check constraint in pgsql to allow status string values
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE pengajuan_ls DROP CONSTRAINT IF EXISTS pengajuan_ls_status_check');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_ls', function (Blueprint $table) {
            $table->dropColumn('bukti_penyerahan');
        });
    }
};
