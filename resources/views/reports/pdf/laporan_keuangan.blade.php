<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 10pt;
        margin: 20px;
    }

    h1 {
        text-align: center;
        font-size: 18pt;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th {
        background: #e0e0e0;
        padding: 8px;
        border: 1px solid #000;
        font-size: 9pt;
    }

    td {
        padding: 6px;
        border: 1px solid #ccc;
        font-size: 8.5pt;
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .info {
        margin-bottom: 15px;
        font-size: 9pt;
    }

    .summary {
        margin-top: 20px;
        border: 2px solid #000;
        padding: 15px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin: 5px 0;
    }

    .summary-label {
        font-weight: bold;
    }

    .laba-positif {
        color: green;
        font-weight: bold;
    }

    .laba-negatif {
        color: red;
        font-weight: bold;
    }
    </style>
</head>

<body>
    <h1>LAPORAN KEUANGAN</h1>

    <div class="info">
        <strong>Periode:</strong> {{ $startDate->format('d/m/Y') }} s/d {{ $endDate->format('d/m/Y') }}<br>
        <strong>Total Hari:</strong> {{ count($data) }} hari
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 25%;">Total Pendapatan</th>
                <th style="width: 25%;">Total Pengeluaran</th>
                <th style="width: 30%;">Laba Bersih</th>
            </tr>
        </thead>
        <tbody>
            @php
            $totalPendapatan = 0;
            $totalPengeluaran = 0;
            @endphp
            @foreach($data as $index => $item)
            @php
            $labaBersih = $item->total_pendapatan - $item->total_pengeluaran;
            $totalPendapatan += $item->total_pendapatan;
            $totalPengeluaran += $item->total_pengeluaran;
            @endphp
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                <td class="text-right">Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($item->total_pengeluaran, 0, ',', '.') }}</td>
                <td class="text-right" style="color: {{ $labaBersih >= 0 ? 'green' : 'red' }};">
                    Rp {{ number_format($labaBersih, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot style="background: #f0f0f0; font-weight: bold;">
            <tr>
                <td colspan="2" class="text-right">TOTAL:</td>
                <td class="text-right">Rp {{ number_format($allPendapatan, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($allPengeluaran, 0, ',', '.') }}</td>
                <td class="text-right" style="color: {{ $allLabaBersih >= 0 ? 'green' : 'red' }};">
                    Rp {{ number_format($allLabaBersih, 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="summary">
        <h3 style="margin-top: 0;">RINGKASAN KEUANGAN</h3>
        <div class="summary-row">
            <span class="summary-label">Total Pendapatan:</span>
            <span>Rp {{ number_format($allPendapatan, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Total Pengeluaran:</span>
            <span>Rp {{ number_format($allPengeluaran, 0, ',', '.') }}</span>
        </div>
        <hr>
        <div class="summary-row">
            <span class="summary-label">LABA BERSIH:</span>
            <span class="{{ $allLabaBersih >= 0 ? 'laba-positif' : 'laba-negatif' }}">
                Rp {{ number_format($allLabaBersih, 0, ',', '.') }}

            </span>
        </div>
    </div>
</body>

</html>