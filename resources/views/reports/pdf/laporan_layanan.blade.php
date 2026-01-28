<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Layanan</title>
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
    </style>
</head>

<body>
    <h1>LAPORAN LAYANAN</h1>

    <div class="info">
        <strong>Periode:</strong> {{ $startDate->format('d/m/Y') }} s/d {{ $endDate->format('d/m/Y') }}<br>
        <strong>Total Layanan:</strong> {{ count($data) }} layanan
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Nama Layanan</th>
                <th style="width: 10%;">Jenis</th>
                <th style="width: 12%;">Harga</th>
                <th style="width: 10%;">Jumlah Transaksi</th>
                <th style="width: 12%;">Total Berat</th>
                <th style="width: 10%;">Total Qty</th>
                <th style="width: 16%;">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @php
            $totalTransaksi = 0;
            $totalPendapatan = 0;
            @endphp
            @foreach($data as $index => $item)
            @php
            $totalTransaksi += $item->jumlah_transaksi;
            $totalPendapatan += $item->total_pendapatan;
            @endphp
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->nama_layanan }}</td>
                <td class="text-center">{{ ucfirst($item->jenis) }}</td>
                <td class="text-right">Rp {{ number_format($item->harga_layanan, 0, ',', '.') }}</td>
                <td class="text-center">{{ $item->jumlah_transaksi }}</td>
                <td class="text-right">
                    {{ $item->jenis == 'kiloan' ? number_format($item->total_berat, 2, ',', '.') . ' Kg' : '-' }}</td>
                <td class="text-center">{{ $item->jenis == 'satuan' ? $item->total_qty . ' Pcs' : '-' }}</td>
                <td class="text-right">Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr style="background: #f0f0f0; font-weight: bold;">
                <td colspan="4" class="text-right">TOTAL:</td>
                <td class="text-center">{{ $totalTransaksi }}</td>
                <td colspan="2"></td>
                <td class="text-right">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>