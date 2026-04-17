<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KategoriController;

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
            'totalPending' => Transaksi::where('status', 'pending')->count(),
            'totalTransaksi' => Transaksi::count(),
            'totalTersedia' => Buku::sum('stok'),
        ]);
    })->name('dashboard');

    // USER MANAGEMENT
    Route::resource('users', UserController::class)->except('show');

    // BUKU
    Route::resource('buku', BukuController::class)->except('show');
    Route::post('buku/import', [BukuController::class, 'import'])
    ->name('buku.import');
    // KATEGORI
    Route::resource('kategori', KategoriController::class);

 // TRANSAKSI (ADMIN VIEW)
Route::get('/transaksi', [TransaksiController::class, 'adminIndex'])
    ->name('transaksi.index');

// ✅ TAMBAHAN
Route::post('/transaksi/{id}/approve',
    [TransaksiController::class, 'approve']
)->name('transaksi.approve');

Route::post('/transaksi/{id}/tolak',
    [TransaksiController::class, 'tolak']
)->name('transaksi.tolak');
});


/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])
->prefix('user')
->name('user.')
->group(function () {

Route::get('/dashboard', function () {

    $userId = Auth::id();

    $transaksiSaya = \App\Models\Transaksi::where('user_id', $userId)->count();

    $dipinjam = \App\Models\Transaksi::where('user_id', $userId)
        ->where('status', 'dipinjam')
        ->count();

    $dikembalikan = \App\Models\Transaksi::where('user_id', $userId)
        ->where('status', 'dikembalikan')
        ->count();

    return view('user.dashboard', compact(
        'transaksiSaya',
        'dipinjam',
        'dikembalikan'
    ));
})->name('dashboard');
    // CARI BUKU
    Route::get('/cari-buku', [BukuController::class, 'cari'])
        ->name('cari');
});


/*
|--------------------------------------------------------------------------
| TRANSAKSI (USER)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::resource('transaksi', TransaksiController::class);

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