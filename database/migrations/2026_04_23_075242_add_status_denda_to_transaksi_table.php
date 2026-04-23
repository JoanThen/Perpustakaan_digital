<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksi', 'denda_dibayar')) {
                $table->boolean('denda_dibayar')->default(false)->after('denda');
            }
            if (!Schema::hasColumn('transaksi', 'status_denda')) {
                $table->enum('status_denda', ['tidak_ada', 'belum_bayar', 'lunas'])
                      ->default('tidak_ada')
                      ->after('denda_dibayar');
            }
        });
    }

    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            if (Schema::hasColumn('transaksi', 'denda_dibayar')) {
                $table->dropColumn('denda_dibayar');
            }
            if (Schema::hasColumn('transaksi', 'status_denda')) {
                $table->dropColumn('status_denda');
            }
        });
    }
};