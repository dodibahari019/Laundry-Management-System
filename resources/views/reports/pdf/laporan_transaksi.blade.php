<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 10pt; margin: 20px; }
        h1 { text-align: center; font-size: 18pt; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #e0e0e0; padding: 8px; border: 1px solid #000; font-size: 9pt; }
        td { padding: 6px; border: 1px solid #ccc; font-size: 8.5pt; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .info { margin-bottom: 15px; font-size: 9pt; }
    </style>
</head>
<body>
    <h1>LAPORAN TRANSAKSI</h1>
    
    <div class="info">
        <strong>Periode:</strong> {{ $startDate->format('d/m/Y') }} s/d {{ $endDate->format('d/m/Y') }}<br>
        <strong>Total Transaksi:</strong> {{ count($data) }} transaksi
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Kode Order</th>
                <th style="width: 15%;">Pelanggan</th>
                <th style="width: 15%;">Layanan</th>
                <th style="width: 10%;">Berat/Qty</th>
                <th style="width: 12%;">Total</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 10%;">Metode</th>
                <th style="width: 8%;">Kembalian</th>
            </tr>
        </thead>
        <tbody>
            @php $totalPendapatan = 0; @endphp
            @foreach($data as $index => $item)
            @php
            $totalPendapatan += $item->total;
            $beratQty = $item->jenis == 'kiloan' ? $item->berat . ' Kg' : $item->jumlah . ' Pcs';
            @endphp
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->kode_order }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nama_layanan }}</td>
                <td class="text-center">{{ $beratQty }}</td>
                <td class="text-right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                <td class="text-center">{{ strtoupper($item->status_order) }}</td>
                <td class="text-center">{{ strtoupper($item->metode) }}</td>
                <td class="text-right">Rp {{ number_format($item->kembalian, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr style="background: #f0f0f0; font-weight: bold;">
                <td colspan="5" class="text-right">TOTAL PENDAPATAN:</td>
                <td class="text-right">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                <td colspan="3"></td>
            </tr>
        </tbody>
    </table>
</body>
</html>