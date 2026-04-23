<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksi', 'alasan_tolak')) {
                $table->text('alasan_tolak')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            if (Schema::hasColumn('transaksi', 'alasan_tolak')) {
                $table->dropColumn('alasan_tolak');
            }
        });
    }
};