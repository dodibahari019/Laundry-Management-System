<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pengeluaran</title>
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

        .total-row {
            background: #f0f0f0;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>LAPORAN PENGELUARAN</h1>

    <div class="info">
        <strong>Periode:</strong> {{ $startDate->format('d/m/Y') }} s/d {{ $endDate->format('d/m/Y') }}<br>
        <strong>Total Data:</strong> {{ count($data) }} pengeluaran
    </div>

    @if(count($data) > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 12%;">Tanggal</th>
                    <th style="width: 20%;">Nama Pengeluaran</th>
                    <th style="width: 12%;">Kategori</th>
                    <th style="width: 28%;">Deskripsi</th>
                    <th style="width: 15%;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @php $totalPengeluaran = 0; @endphp
                @foreach($data as $index => $item)
                    @php $totalPengeluaran += $item->jumlah; @endphp
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d/m/Y') }}
                        </td>
                        <td>{{ $item->nama_pengeluaran ?? 'Tidak ada nama' }}</td>
                        <td class="text-center">
                            {{ ucfirst($item->kategori_pengeluaran ?? '-') }}
                        </td>
                        <td>{{ $item->deskripsi ?? '-' }}</td>
                        <td class="text-right">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="5" class="text-right">TOTAL PENGELUARAN:</td>
                    <td class="text-right">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 40px; color: #999;">
            <p>Tidak ada data pengeluaran pada periode ini</p>
        </div>
    @endif

    <div style="margin-top: 30px; font-size: 8pt; text-align: right; color: #666;">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}
    </div>
</body>

</html>