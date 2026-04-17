<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // USER
    public function index()
    {
        $transaksi = Transaksi::with('buku')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('transaksi.index', compact('transaksi'));
    }

    // ADMIN
    public function adminIndex()
    {
        $transaksi = Transaksi::with(['buku', 'user'])
            ->latest()
            ->get();

        return view('admin.transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $buku = Buku::where('stok', '>', 0)->get();
        return view('transaksi.create', compact('buku'));
    }

public function store(Request $request)
{
    $request->validate([
        'buku_id' => 'required|exists:buku,id'
    ]);

    $buku = Buku::findOrFail($request->buku_id);

    if ($buku->stok <= 0) {
        return back()->with('error', 'Stok buku habis!');
    }

   Transaksi::create([
    'user_id' => Auth::id(),
    'buku_id' => $buku->id,
    'status' => 'pending'
]);

    return redirect()->route('transaksi.index')
        ->with('success', 'Permintaan peminjaman dikirim, menunggu persetujuan admin.');
}

    public function kembali($id)
    {
        $transaksi = Transaksi::with('buku')->findOrFail($id);

        // 🔐 proteksi
if (strtolower(Auth::user()->role) !== 'admin' && $transaksi->user_id !== Auth::id()) { 
            abort(403);
        }

        if ($transaksi->status === 'dikembalikan') {
            return back()->with('error', 'Buku sudah dikembalikan.');
        }

        $transaksi->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()
        ]);

        $transaksi->buku->increment('stok');

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }
  public function approve($id)
{
    $trx = Transaksi::with('buku')->findOrFail($id);

    if ($trx->status !== 'pending') {
        return back()->with('error', 'Transaksi sudah diproses.');
    }

    if ($trx->buku->stok <= 0) {
        return back()->with('error', 'Stok habis.');
    }

    $trx->update([
        'status' => 'dipinjam',
        'tanggal_pinjam' => now(),
        'tanggal_kembali_rencana' => now()->addDays(7) // ⬅️ ini penting
    ]);

    $trx->buku->decrement('stok');

    return back()->with('success', 'Peminjaman disetujui.');
}

public function tolak($id)
{
    $trx = Transaksi::findOrFail($id);

    if ($trx->status !== 'pending') {
        return back()->with('error', 'Transaksi sudah diproses.');
    }

    $trx->update([
        'status' => 'ditolak'
    ]);

    return back()->with('success', 'Peminjaman ditolak.');
}
}
