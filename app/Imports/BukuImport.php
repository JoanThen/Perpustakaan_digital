<?php
namespace App\Imports;

use App\Models\Buku;
use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BukuImport implements ToModel, WithHeadingRow
{
    public $total = 0;

    public function model(array $row)
    {
        // skip kalau kosong (biar gak error / data sampah)
        if (!isset($row['judul'])) {
            return null;
        }

        $this->total++; // 🔥 hitung disini

        $kategori = null;

        if (isset($row['kategori']) && $row['kategori']) {
            $kategori = Kategori::firstOrCreate([
                'nama_kategori' => $row['kategori']
            ]);
        } elseif (isset($row['kategori_id'])) {
            $kategori = Kategori::find($row['kategori_id']);
        }

        return new Buku([
            'judul' => $row['judul'],
            'pengarang' => $row['pengarang'],
            'penerbit' => $row['penerbit'],
            'tahun_terbit' => $row['tahun_terbit'],
            'stok' => $row['stok'],
            'kategori_id' => $kategori?->id,
        ]);
    }
}
