<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'tb_pengeluaran';
    
    // Primary key
    protected $primaryKey = 'id_pengeluaran';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_pengeluaran',
        'deskripsi',
        'jumlah',
        'tanggal_pengeluaran',
        'kategori',
        'status',
        'bukti_pengeluaran'
    ];

    // Konversi tipe data
    protected $casts = [
        'tanggal_pengeluaran' => 'date',
        'jumlah' => 'decimal:2'
    ];

    // Format Rupiah (untuk tampilan)
    public function getJumlahFormatAttribute()
    {
        return 'Rp ' . number_format($this->jumlah, 0, ',', '.');
    }

    // Nama Kategori (untuk tampilan)
    public function getKategoriNamaAttribute()
    {
        $kategori = [
            'operasional' => 'Operasional',
            'peralatan' => 'Peralatan',
            'bahan' => 'Bahan Baku',
            'gaji' => 'Gaji Karyawan',
            'utilitas' => 'Utilitas (Listrik, Air)',
            'lainnya' => 'Lainnya'
        ];

        return $kategori[$this->kategori] ?? $this->kategori;
    }
}