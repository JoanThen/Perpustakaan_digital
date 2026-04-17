<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::table('transaksi', function (Blueprint $table) {

        if (!Schema::hasColumn('transaksi', 'tanggal_kembali_rencana')) {
            $table->date('tanggal_kembali_rencana')->nullable();
        }

        if (!Schema::hasColumn('transaksi', 'denda')) {
            $table->integer('denda')->default(0);
        }

    });
}

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::table('transaksi', function (Blueprint $table) {
        $table->dropColumn(['tanggal_kembali_rencana', 'denda']);

        $table->enum('status', ['dipinjam', 'dikembalikan'])
              ->default('dipinjam')
              ->change();
    });
}
};