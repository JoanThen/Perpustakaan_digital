<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Transaksi;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Attribute yang boleh diisi mass assignment
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Attribute yang disembunyikan saat serialize
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting attribute
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // 1 User bisa punya banyak transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'user_id');
    }
}
