<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use carbon\Carbon;

class Transaksi extends Model
{
    protected $table = 'transaksi';

  protected $fillable = [
    'user_id',
    'buku_id',
    'tanggal_pinjam',
    'tanggal_kembali',
    'tanggal_kembali_rencana',
    'denda',
    'denda_dibayar',
    'status_denda',   // ← tambah ini
    'status',
    'alasan_tolak',
];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

public function getIsLateAttribute()
{
    if (!$this->tanggal_kembali_rencana || $this->status !== 'dipinjam') {
        return false;
    }

    return now()->gt(Carbon::parse($this->tanggal_kembali_rencana));
}

public function getHariTerlambatAttribute()
{
    if (!$this->is_late) return 0;

    return Carbon::parse($this->tanggal_kembali_rencana)
        ->diffInDays(now());
}
}

