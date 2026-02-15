<table>
    <thead>
        <tr>
            <th colspan="5" style="text-align: center; font-size: 18px; font-weight: bold; background-color: #10B981; color: #FFFFFF; height: 40px;">
                LAPORAN PENDAPATAN - D'LAUNDRY
            </th>
        </tr>
        <tr>
            <th colspan="5" style="text-align: center; background-color: #f0f0f0; height: 25px;">
                Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
            </th>
        </tr>
        <tr>
            <th colspan="5" style="text-align: center; background-color: #f0f0f0; height: 25px;">
                Dicetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }} WIB
            </th>
        </tr>
        <tr></tr>
        <tr style="background-color: #10B981; color: #FFFFFF; font-weight: bold; height: 35px;">
            <th style="border: 1px solid #000; text-align: center; width: 8%;">No</th>
            <th style="border: 1px solid #000; text-align: center; width: 25%;">Tanggal Transaksi</th>
            <th style="border: 1px solid #000; text-align: center; width: 20%;">Jumlah Transaksi</th>
            <th style="border: 1px solid #000; text-align: center; width: 25%;">Total Pendapatan (Rp)</th>
            <th style="border: 1px solid #000; text-align: center; width: 22%;">Rata-Rata per Transaksi (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @php $totalTransaksi = 0; $totalPendapatan = 0; @endphp
        @foreach($data as $index => $item)
        @php
            $totalTransaksi += $item->jumlah_transaksi;
            $totalPendapatan += $item->total_pendapatan;
        @endphp
        <tr style="height: 30px;">
            <td style="border: 1px solid #ccc; text-align: center;">{{ $index + 1 }}</td>
            <td style="border: 1px solid #ccc; text-align: center;">{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d/m/Y') }}</td>
            <td style="border: 1px solid #ccc; text-align: right;">{{ number_format($item->jumlah_transaksi, 0, ',', '.') }}</td>
            <td style="border: 1px solid #ccc; text-align: right;">{{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
            <td style="border: 1px solid #ccc; text-align: right;">{{ number_format($item->rata_rata_per_transaksi, 0, ',', '.') }}</td>
        </tr>
        @endforeach
        <tr></tr>
        <tr style="font-weight: bold; background-color: #E0E0E0; height: 35px;">
            <td colspan="2" style="border: 1px solid #000; text-align: right; padding-right: 10px;">TOTAL:</td>
            <td style="border: 1px solid #000; text-align: right; background-color: #FFD700;">{{ number_format($totalTransaksi, 0, ',', '.') }}</td>
            <td style="border: 1px solid #000; text-align: right; background-color: #90EE90;">{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            <td style="border: 1px solid #000; text-align: right; background-color: #ADD8E6;">{{ $totalTransaksi > 0 ? number_format($totalPendapatan / $totalTransaksi, 0, ',', '.') : 0 }}</td>
        </tr>
    </tbody>
</table>