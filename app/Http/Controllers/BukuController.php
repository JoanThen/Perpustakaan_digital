<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // ✅ INI WAJIB

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::latest()->get();
        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        return view('buku.create');
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'pengarang' => 'required|string|max:255',
        'penerbit' => 'required|string|max:255',
        'tahun_terbit' => 'required|digits:4',
        'stok' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('buku', 'public');
    }

    Buku::create($validated);

    return redirect()->route('admin.buku.index')
        ->with('success', 'Buku berhasil ditambahkan!');
}

    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }



public function update(Request $request, Buku $buku)
{
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'pengarang' => 'required|string|max:255',
        'penerbit' => 'required|string|max:255',
        'tahun_terbit' => 'required|digits:4',
        'stok' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    if ($request->hasFile('image')) {

        // hapus lama
        if ($buku->image) {
            Storage::disk('public')->delete($buku->image);
        }

        $validated['image'] = $request->file('image')->store('buku', 'public');
    }

    $buku->update($validated);

    return redirect()->route('admin.buku.index')
        ->with('success', 'Buku berhasil diperbarui!');
}

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil dihapus!');
    }

    // 🔥 METHOD CARI (HARUS DI DALAM CLASS)
    public function cari(Request $request)
    {
        $query = $request->q;

        $buku = Buku::when($query, function ($qBuilder) use ($query) {
            $qBuilder->where(function ($sub) use ($query) {
                $sub->where('judul', 'like', "%$query%")
                    ->orWhere('pengarang', 'like', "%$query%")
                    ->orWhere('penerbit', 'like', "%$query%");
            });
        })->latest()->paginate(8);

        return view('user.cari-buku', compact('buku', 'query'));
    }
}