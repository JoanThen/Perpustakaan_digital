<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    // ── USER: lihat transaksi milik sendiri ──
    public function index()
    {
        $transaksi = Transaksi::with('buku')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('transaksi.index', compact('transaksi'));
    }

    // ── ADMIN: lihat semua transaksi ──
    public function adminIndex()
    {
        $transaksi = Transaksi::with(['buku', 'user'])
            ->latest()
            ->get();

        return view('admin.transaksi.index', compact('transaksi'));
    }

    // ── USER: form ajukan peminjaman ──
    public function create()
    {
        $buku = Buku::where('stok', '>', 0)->get();
        return view('transaksi.create', compact('buku'));
    }

    // ── USER: simpan pengajuan peminjaman ──
    public function store(Request $request)
    {
        $request->validate([
            'buku_id'                 => 'required|exists:buku,id',
            'tanggal_kembali_rencana' => 'required|date',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis.');
        }

        $userId = Auth::id();

        $aktif = Transaksi::where('user_id', $userId)
            ->whereIn('status', ['pending', 'dipinjam', 'pending_kembali'])
            ->count();

        if ($aktif >= 5) {
            return back()->with('error', 'Maksimal 5 buku sedang dipinjam / diajukan!');
        }

        Transaksi::create([
            'user_id'                 => $userId,
            'buku_id'                 => $request->buku_id,
            'tanggal_pinjam'          => null,
            'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
            'status'                  => 'pending',
            'denda'                   => 0,
            'denda_dibayar'           => false,
            'status_denda'            => 'tidak_ada',
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Pengajuan berhasil dikirim, menunggu persetujuan admin.');
    }

    // ── USER: ajukan pengembalian ──
    public function kembali($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->user_id !== Auth::id()) {
            abort(403);
        }

        if ($transaksi->status !== 'dipinjam') {
            return back()->with('error', 'Tidak bisa mengajukan pengembalian.');
        }

        $transaksi->update([
            'status' => 'pending_kembali',
        ]);

        return back()->with('success', 'Pengajuan pengembalian dikirim, menunggu approval admin.');
    }

    // ── ADMIN: setujui peminjaman ──
    public function approve($id)
    {
        $trx = Transaksi::with('buku')->findOrFail($id);

        if ($trx->status !== 'pending') {
            return back()->with('error', 'Transaksi sudah diproses.');
        }

        if ($trx->buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis.');
        }

        $trx->update([
            'status'         => 'dipinjam',
            'tanggal_pinjam' => now(),
        ]);

        $trx->buku->decrement('stok');

        return back()->with('success', 'Peminjaman disetujui.');
    }

    // ── ADMIN: tolak peminjaman ──
    public function tolak(Request $request, $id)
    {
        $trx = Transaksi::findOrFail($id);

        if ($trx->status !== 'pending') {
            return back()->with('error', 'Transaksi sudah diproses.');
        }

        $request->validate([
            'alasan_tolak' => 'required|string|max:500',
        ]);

        $trx->update([
            'status'       => 'ditolak',
            'alasan_tolak' => $request->alasan_tolak,
        ]);

        return back()->with('success', 'Peminjaman ditolak.');
    }

    // ── ADMIN: tolak pengembalian ──
    public function tolakKembali(Request $request, $id)
    {
        $trx = Transaksi::findOrFail($id);

        if ($trx->status !== 'pending_kembali') {
            return back()->with('error', 'Transaksi sudah diproses.');
        }

        $request->validate([
            'alasan_tolak' => 'required|string|max:500',
        ]);

        $trx->update([
            'status'       => 'dipinjam',
            'alasan_tolak' => $request->alasan_tolak,
        ]);

        return back()->with('success', 'Pengembalian ditolak, status kembali ke dipinjam.');
    }

    // ── ADMIN: setujui pengembalian + hitung denda ──
    public function approveKembali($id)
    {
        $trx = Transaksi::with('buku')->findOrFail($id);

        if ($trx->status !== 'pending_kembali') {
            return back()->with('error', 'Tidak valid.');
        }

        $today         = now()->startOfDay();
        $dendaPerHari  = 1000;
        $hariTerlambat = 0;

        if ($trx->tanggal_kembali_rencana) {
            $batas = Carbon::parse($trx->tanggal_kembali_rencana)->startOfDay();

            if ($today->gt($batas)) {
                $hariTerlambat = (int) $batas->diffInDays($today);
            }
        }

        $denda = $hariTerlambat * $dendaPerHari;

        $trx->update([
            'status'          => 'dikembalikan',
            'tanggal_kembali' => $today,
            'denda'           => $denda,
            'denda_dibayar'   => false,
            'status_denda'    => $denda > 0 ? 'belum_bayar' : 'tidak_ada',
        ]);

        $trx->buku->increment('stok');

        $msg = $denda > 0
            ? 'Pengembalian disetujui. Denda: Rp ' . number_format($denda, 0, ',', '.') . ' (' . $hariTerlambat . ' hari terlambat)'
            : 'Pengembalian disetujui. Tidak ada denda.';

        return back()->with('success', $msg);
    }

    // ── ADMIN: tandai denda lunas ──
    public function bayarDenda($id)
    {
        $trx = Transaksi::findOrFail($id);

        if ($trx->denda <= 0) {
            return back()->with('error', 'Tidak ada denda pada transaksi ini.');
        }

        if ($trx->denda_dibayar) {
            return back()->with('error', 'Denda sudah lunas sebelumnya.');
        }

        $trx->update([
            'denda_dibayar' => true,
            'status_denda'  => 'lunas',
        ]);

        return back()->with('success', 'Denda Rp ' . number_format($trx->denda, 0, ',', '.') . ' berhasil ditandai lunas.');
    }
}