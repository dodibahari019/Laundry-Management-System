<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: Arial, sans-serif; font-size: 9pt; margin:10px; }
        .header { text-align:center; margin-bottom:25px; padding-bottom:15px; border-bottom:3px solid #000; }
        .header h1 { font-size:22pt; letter-spacing:2px; }
        .subtitle { font-size:10pt; color:#333; }

        .info-box { background:#f5f5f5; border:1px solid #ccc; padding:12px 15px; margin-bottom:20px; }
        .info-row { display:table; width:100%; margin-bottom:5px; }
        .info-label { font-weight:bold; width:150px; display:table-cell; }
        .info-value { display:table-cell; }

        table { width:100%; border-collapse:collapse; }
        thead { background:#e8e8e8; }
        th { border:1px solid #999; padding:8px 6px; font-size:7.5pt; text-transform:uppercase; }
        td { border:1px solid #ccc; padding:6px; font-size:8pt; }
        tbody tr:nth-child(even) { background:#fafafa; }

        .text-right { text-align:right; }
        .text-center { text-align:center; }
        .font-bold { font-weight:bold; }

        .summary-box { margin-top:20px; background:#f5f5f5; border:2px solid #000; padding:15px; }
        .summary-row { display:flex; justify-content:space-between; padding:6px 0; border-bottom:1px solid #ccc; }
        .summary-row:last-child { border-top:2px solid #000; border-bottom:none; font-size:10pt; font-weight:bold; }

        .laba-positif { color:green; }
        .laba-negatif { color:red; }
    </style>
</head>
<body>

<div class="header">
    <h1>LAPORAN KEUANGAN</h1>
    <div class="subtitle">D`LAUNDRY</div>
</div>

<div class="info-box">
    <div class="info-row">
        <div class="info-label">Periode Laporan</div>
        <div class="info-value">
            : {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }}
            s/d {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}
        </div>
    </div>
    <div class="info-row">
        <div class="info-label">Tanggal Cetak</div>
        <div class="info-value">: {{ now()->format('d F Y, H:i') }} WIB</div>
    </div>
    <div class="info-row">
        <div class="info-label">Total Hari</div>
        <div class="info-value">: {{ count($data) }} hari</div>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="15%">Tanggal</th>
            <th width="25%">Pendapatan</th>
            <th width="25%">Pengeluaran</th>
            <th width="30%">Laba Bersih</th>
        </tr>
    </thead>
    <tbody>
        @php $totalPendapatan = 0; $totalPengeluaran = 0; @endphp
        @foreach($data as $i => $row)
        @php
            $laba = $row->total_pendapatan - $row->total_pengeluaran;
            $totalPendapatan += $row->total_pendapatan;
            $totalPengeluaran += $row->total_pengeluaran;
        @endphp
        <tr>
            <td class="text-center font-bold">{{ $i+1 }}</td>
            <td class="text-center">{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
            <td class="text-right">Rp {{ number_format($row->total_pendapatan,0,',','.') }}</td>
            <td class="text-right">Rp {{ number_format($row->total_pengeluaran,0,',','.') }}</td>
            <td class="text-right font-bold {{ $laba >= 0 ? 'laba-positif' : 'laba-negatif' }}">
                Rp {{ number_format($laba,0,',','.') }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="summary-box">
    <div class="summary-row">
        <span>Total Pendapatan</span>
        <span>Rp {{ number_format($totalPendapatan,0,',','.') }}</span>
    </div>
    <div class="summary-row">
        <span>Total Pengeluaran</span>
        <span>Rp {{ number_format($totalPengeluaran,0,',','.') }}</span>
    </div>
    <div class="summary-row">
        <span>LABA BERSIH</span>
        <span class="{{ ($totalPendapatan-$totalPengeluaran)>=0?'laba-positif':'laba-negatif' }}">
            Rp {{ number_format($totalPendapatan-$totalPengeluaran,0,',','.') }}
        </span>
    </div>
</div>

</body>
</html>
