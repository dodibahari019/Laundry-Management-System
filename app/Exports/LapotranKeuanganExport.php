<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class LaporanKeuanganExport implements FromView, WithTitle
{
    protected $data;
    protected $startDate;
    protected $endDate;
    protected $totalPendapatan;
    protected $totalPengeluaran;
    protected $labaBersih;

    public function __construct($data, $startDate, $endDate, $totalPendapatan, $totalPengeluaran, $labaBersih)
    {
        $this->data = $data;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->totalPendapatan = $totalPendapatan;
        $this->totalPengeluaran = $totalPengeluaran;
        $this->labaBersih = $labaBersih;
    }

    public function view(): View
    {
        return view('reports.excel.laporan_keuangan', [
            'data' => $this->data,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'totalPendapatan' => $this->totalPendapatan,
            'totalPengeluaran' => $this->totalPengeluaran,
            'labaBersih' => $this->labaBersih,
        ]);
    }

    public function title(): string
    {
        return 'Laporan Keuangan';
    }
}