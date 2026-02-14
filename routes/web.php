<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\TransaksiController;

use App\Models\Buku;
use App\Models\Transaksi;

/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $totalBuku = Buku::count();
    $totalStok = Buku::sum('stok');
    $totalDipinjam = Transaksi::where('status', 'dipinjam')->count();

    return view('home', compact(
        'totalBuku',
        'totalStok',
        'totalDipinjam'
    ));

})->name('home');


/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->get('/dashboard', function (Request $request) {

    if ($request->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');

})->name('dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {

            $totalBuku = Buku::count();
            $totalDipinjam = Transaksi::where('status', 'dipinjam')->count();
            $totalTransaksi = Transaksi::count();
            $totalTersedia = Buku::sum('stok');

            return view('admin.dashboard', compact(
                'totalBuku',
                'totalDipinjam',
                'totalTersedia',
                'totalTransaksi'
            ));

        })->name('dashboard');

        Route::resource('users', UserController::class)->except(['show']);

        Route::resource('buku', BukuController::class)->except(['show']);
});



/*
|--------------------------------------------------------------------------
| USER AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('/dashboard', function () {

            $transaksiSaya = Transaksi::where(
                'user_id',
                Auth::id()
            )->count();

            return view('user.dashboard', compact('transaksiSaya'));

        })->name('dashboard');

});


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| TRANSAKSI
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::resource('transaksi', TransaksiController::class);

    Route::get('/transaksi/{id}/kembali',
        [TransaksiController::class, 'kembali']
    )->name('transaksi.kembali');
});


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
