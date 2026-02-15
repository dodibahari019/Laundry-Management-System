<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanTransaksiExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Order',
            'Tanggal',
            'Nama Pelanggan',
            'No HP',
            'Layanan',
            'Jenis',
            'Total',
            'Status',
            'Metode',
            'Dibayar',
        ];
    }

    public function map($row): array
    {
        static $no = 1;

        return [
            $no++,
            $row->kode_order,
            $row->tanggal_masuk,
            $row->nama,
            $row->no_hp,
            $row->nama_layanan,
            ucfirst($row->jenis),
            (int) $row->total,        // ❗ HARUS ANGKA
            strtoupper($row->status_order),
            strtoupper($row->metode),
            (int) $row->jumlahBayar,  // ❗ HARUS ANGKA
        ];
    }
}
