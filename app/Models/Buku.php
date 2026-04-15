<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;

class Buku extends Model
{
    protected $table = 'buku';

   protected $fillable = [
    'judul',
    'pengarang',
    'penerbit',
    'tahun_terbit',
    'stok',
    'image' // ⬅️ INI YANG KURANG
];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'buku_id');
    }
}
