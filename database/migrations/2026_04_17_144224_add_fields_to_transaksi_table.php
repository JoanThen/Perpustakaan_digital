<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksi', 'tanggal_kembali_rencana')) {
                $table->dateTime('tanggal_kembali_rencana')->nullable()->after('tanggal_pinjam');
            }
            if (!Schema::hasColumn('transaksi', 'denda')) {
                $table->integer('denda')->default(0)->after('tanggal_kembali_rencana');
            }
            if (!Schema::hasColumn('transaksi', 'denda_dibayar')) {
                $table->boolean('denda_dibayar')->default(false)->after('denda');
            }
            if (!Schema::hasColumn('transaksi', 'status_denda')) {
                $table->enum('status_denda', ['tidak_ada', 'belum_bayar', 'lunas'])
                      ->default('tidak_ada')
                      ->after('denda_dibayar');
            }
            if (!Schema::hasColumn('transaksi', 'alasan_tolak')) {
                $table->string('alasan_tolak')->nullable()->after('status_denda');
            }
            if (!Schema::hasColumn('transaksi', 'status')) {
                $table->enum('status', ['pending', 'dipinjam', 'pending_kembali', 'dikembalikan', 'ditolak'])
                      ->default('pending')
                      ->after('alasan_tolak');
            }
        });
    }

    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_kembali_rencana',
                'denda',
                'denda_dibayar',
                'status_denda',
                'alasan_tolak',
                'status',
            ]);
        });
    }
};