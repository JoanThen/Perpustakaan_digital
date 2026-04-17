<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;
use App\Models\Kategori;

class Buku extends Model
{
    protected $table = 'buku'; // ⚠️ pastiin ini sesuai nama tabel di DB

    protected $fillable = [
        'judul',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'stok',
        'image',
        'kategori_id' // 🔥 WAJIB TAMBAH INI
    ];

    // 🔥 RELASI KE TRANSAKSI
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'buku_id');
    }

    // 🔥 RELASI KE KATEGORI
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}