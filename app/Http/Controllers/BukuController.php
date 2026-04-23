<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori; // 🔥 TAMBAH INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BukuImport;

class BukuController extends Controller
{
   public function index(Request $request)
{
    $kategori = Kategori::all();

    $buku = Buku::with('kategori')
        ->when($request->kategori, function ($query) use ($request) {
            $query->where('kategori_id', $request->kategori);
        })
        ->latest()
        ->get();

    return view('buku.index', compact('buku', 'kategori'));
}

    public function create()
    {
        $kategori = Kategori::all(); // 🔥 ambil kategori
        return view('buku.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id', // 🔥 TAMBAH INI
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
        $kategori = Kategori::all(); // 🔥 TAMBAH INI
        return view('buku.edit', compact('buku', 'kategori'));
    }

    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id', // 🔥 TAMBAH INI
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {

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
        // 🔥 hapus gambar juga
        if ($buku->image) {
            Storage::disk('public')->delete($buku->image);
        }

        $buku->delete();

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil dihapus!');
    }

    public function cari(Request $request)
    {
        $query = $request->q;

        $buku = Buku::with('kategori') // 🔥 TAMBAH INI
            ->when($query, function ($qBuilder) use ($query) {
                $qBuilder->where(function ($sub) use ($query) {
                    $sub->where('judul', 'like', "%$query%")
                        ->orWhere('pengarang', 'like', "%$query%")
                        ->orWhere('penerbit', 'like', "%$query%");
                });
            })
            ->latest()
            ->paginate(8);

        return view('user.cari-buku', compact('buku', 'query'));
    }
public function import(Request $request)
{
    $path = session('import_path');

    if (!$path || !Storage::exists($path)) {
        return back()->withErrors(['file' => 'File tidak ditemukan']);
    }

    $filePath = Storage::path($path);

    $rows = Excel::toArray([], $filePath)[0] ?? [];

    // 🔥 skip header (biasanya baris 0)
    foreach ($rows as $i => $row) {

        if ($i === 0) continue;

        if (!isset($row[0])) continue;

        \App\Models\Buku::create([
            'judul'        => $row[0],
            'pengarang'    => $row[1] ?? null,
            'penerbit'     => $row[2] ?? null,
            'tahun_terbit' => $row[3] ?? null,
            'stok'         => $row[4] ?? 0,
            'kategori_id'  => $row[5] ?? 1,
        ]);
    }

    Storage::delete($path);
    session()->forget(['preview', 'import_path']);

    return back()->with('success', 'Import berhasil 📚');
}
public function preview(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv'
    ]);

    $file = $request->file('file');

    // simpan file
    $path = $file->store('imports');

    // 🔥 GUNAKAN STORAGE PATH (INI KUNCI FIX)
    $fullPath = Storage::path($path);

    if (!file_exists($fullPath)) {
        return back()->withErrors(['file' => 'File gagal disimpan di storage']);
    }

    $data = Excel::toArray([], $fullPath);

    session([
        'preview' => $data[0] ?? [],
        'import_path' => $path
    ]);

    return back();
}
}
