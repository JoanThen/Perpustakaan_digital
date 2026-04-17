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
Schema::create('transaksi', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('buku_id')->constrained('buku')->onDelete('cascade');

    $table->date('tanggal_pinjam')->nullable();
    $table->date('tanggal_kembali')->nullable();
    $table->date('tanggal_kembali_rencana')->nullable();

    $table->integer('denda')->default(0);

    $table->enum('status', ['pending', 'dipinjam', 'dikembalikan'])->default('pending');

    $table->timestamps();
});
}

public function down(): void
{
    Schema::dropIfExists('transaksi');
}


};
