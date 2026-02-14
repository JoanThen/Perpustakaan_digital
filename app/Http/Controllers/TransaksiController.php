<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Buku;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['buku', 'user'])
                        ->latest()
                        ->get();

        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $buku = Buku::where('stok', '>', 0)->get();

        return view('transaksi.create', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required'
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }

        Transaksi::create([
            'user_id' => auth()->id(),
            'buku_id' => $buku->id,
            'tanggal_pinjam' => now(),
            'status' => 'dipinjam'
        ]);

        $buku->decrement('stok');

        return redirect()->route('transaksi.index')
            ->with('success', 'Buku berhasil dipinjam!');
    }

    public function kembali($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status == 'dikembalikan') {
            return back()->with('error', 'Buku sudah dikembalikan.');
        }

        $transaksi->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()
        ]);

        $transaksi->buku->increment('stok');

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }
}
