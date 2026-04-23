<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // 🔥 INI WAJIB
return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    DB::statement("
        ALTER TABLE transaksi 
        MODIFY status ENUM(
            'pending',
            'dipinjam',
            'pending_kembali',
            'dikembalikan',
            'ditolak'
        ) DEFAULT 'pending'
    ");
}

public function down(): void
{
    DB::statement("
        ALTER TABLE transaksi 
        MODIFY status ENUM(
            'pending',
            'dipinjam',
            'dikembalikan'
        ) DEFAULT 'pending'
    ");
}
};
