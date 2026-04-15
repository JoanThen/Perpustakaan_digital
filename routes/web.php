<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\TransaksiController;

use App\Models\Buku;
use App\Models\Transaksi;

/*
|--------------------------------------------------------------------------
| LANDING
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home', [
        'totalBuku' => Buku::count(),
        'totalStok' => Buku::sum('stok'),
        'totalDipinjam' => Transaksi::where('status', 'dipinjam')->count()
    ]);
})->name('home');

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function (Request $request) {
    return $request->user()->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
->prefix('admin')
->name('admin.')
->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard', [
            'totalBuku' => Buku::count(),
            'totalDipinjam' => Transaksi::where('status', 'dipinjam')->count(),
            'totalTransaksi' => Transaksi::count(),
            'totalTersedia' => Buku::sum('stok'),
        ]);
    })->name('dashboard');

    Route::resource('users', UserController::class)->except('show');
    Route::resource('buku', BukuController::class)->except('show');

    // ✅ ADMIN TRANSAKSI
    Route::get('/transaksi', [TransaksiController::class, 'adminIndex'])
        ->name('transaksi.index');
});

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])
->prefix('user')
->name('user.')
->group(function () {

    Route::get('/dashboard', function () {
        return view('user.dashboard', [
            'transaksiSaya' => Transaksi::where('user_id', Auth::id())->count()
        ]);
    })->name('dashboard');

    Route::get('/cari-buku', [BukuController::class, 'cari'])
        ->name('buku.cari');
});

/*
|--------------------------------------------------------------------------
| TRANSAKSI (USER)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::resource('transaksi', TransaksiController::class);

    // 🔥 FIX: HARUS POST
    Route::post('/transaksi/{id}/kembali',
        [TransaksiController::class, 'kembali']
    )->name('transaksi.kembali');
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';