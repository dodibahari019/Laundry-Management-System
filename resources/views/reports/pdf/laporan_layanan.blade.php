<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Layanan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 9pt;
            color: #000;
            line-height: 1.4;
            margin: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #000;
        }

        .header h1 {
            font-size: 22pt;
            font-weight: bold;
            color: #000;
            margin-bottom: 5px;
            letter-spacing: 2px;
        }

        .header .subtitle {
            font-size: 10pt;
            color: #333;
            margin-top: 5px;
        }

        .info-box {
            background: #f5f5f5;
            border: 1px solid #ccc;
            padding: 12px 15px;
            margin-bottom: 20px;
        }

        .info-row {
            margin-bottom: 5px;
            display: table;
            width: 100%;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-label {
            font-weight: bold;
            width: 140px;
            display: table-cell;
        }

        .info-value {
            display: table-cell;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        thead {
            background: #e8e8e8;
        }

        th {
            padding: 8px 6px;
            text-align: left;
            font-weight: bold;
            font-size: 7.5pt;
            color: #000;
            text-transform: uppercase;
            border: 1px solid #999;
            letter-spacing: 0.3px;
        }

        td {
            padding: 6px 6px;
            font-size: 8pt;
            border: 1px solid #ccc;
        }

        tbody tr:nth-child(even) {
            background: #fafafa;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: bold;
        }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            border: 1px solid #666;
            font-size: 7pt;
            font-weight: bold;
            background: #f0f0f0;
        }

        .small-text {
            font-size: 7pt;
            color: #555;
            display: block;
            margin-top: 2px;
        }

        .summary-box {
            margin-top: 20px;
            background: #f5f5f5;
            border: 2px solid #000;
            padding: 15px;
        }

        .summary-row {
            padding: 6px 0;
            border-bottom: 1px solid #ccc;
            display: flex;
            justify-content: space-between;
        }

        .summary-row:last-child {
            border-bottom: none;
            font-weight: bold;
            font-size: 10pt;
            padding-top: 10px;
            border-top: 2px solid #000;
            margin-top: 5px;
        }

        .summary-label {
            font-weight: bold;
        }

        .summary-value {
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #000;
            text-align: center;
            font-size: 8pt;
            color: #333;
        }

        .footer p {
            margin: 3px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN LAYANAN</h1>
        <div class="subtitle">D`LAUNDRY</div>
    </div>

    <div class="info-box">
        <div class="info-row">
            <div class="info-label">Periode Laporan</div>
            <div class="info-value">: {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal Cetak</div>
            <div class="info-value">: {{ \Carbon\Carbon::now()->format('d F Y, H:i') }} WIB</div>
        </div>
        <div class="info-row">
            <div class="info-label">Total Layanan</div>
            <div class="info-value">: {{ count($data) }} layanan</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 15%;">Nama Layanan</th>
                <th style="width: 8%;" class="text-center">Jenis</th>
                <th style="width: 12%;" class="text-right">Harga</th>
                <th style="width: 10%;" class="text-right">Jml Transaksi</th>
                <th style="width: 12%;" class="text-right">Total Berat/Qty</th>
                <th style="width: 16%;" class="text-right">Total Pendapatan</th>
                <th style="width: 10%;" class="text-right">Popularitas</th>
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
                $beratQty = $item->jenis == 'kiloan' ? $item->total_berat : $item->total_qty;
                $satuan = $item->jenis == 'kiloan' ? 'Kg' : 'Pcs';
            @endphp
            <tr>
                <td class="text-center font-bold">{{ $index + 1 }}</td>
                <td>
                    <div class="font-bold">{{ $item->nama_layanan }}</div>
                </td>
                <td class="text-center">
                    <span class="small-text">{{ strtoupper($item->jenis) }}</span>
                </td>
                <td class="text-right font-bold">Rp {{ number_format($item->harga_layanan, 0, ',', '.') }}</td>
                <td class="text-right font-bold">{{ number_format($item->jumlah_transaksi, 0, ',', '.') }}</td>
                <td class="text-right">
                    <span class="small-text">{{ rtrim(rtrim(number_format($beratQty, 2, ',', '.'), '0'), ',') }} {{ $satuan }}</span>
                </td>
                <td class="text-right font-bold">Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
                <td class="text-right font-bold">{{ number_format($item->popularitas, 1, ',', '.') }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary-box">
        <div class="summary-row">
            <span class="summary-label">Total Layanan</span>
            <span class="summary-value">{{ count($data) }} layanan</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">Total Transaksi</span>
            <span class="summary-value">{{ number_format($totalTransaksi, 0, ',', '.') }} transaksi</span>
        </div>
        <div class="summary-row">
            <span class="summary-label">TOTAL PENDAPATAN</span>
            <span class="summary-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
        </div>
    </div>

</body>
</html>
