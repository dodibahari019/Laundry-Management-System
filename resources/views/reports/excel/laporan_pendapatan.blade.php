<table>
    <thead>
        <tr>
            <th colspan="5" style="text-align: center; font-weight: bold; font-size: 16px;">
                LAPORAN PENDAPATAN
            </th>
        </tr>
        <tr>
            <th colspan="5" style="text-align: center;">D'Laundry</th>
        </tr>
        <tr>
            <th colspan="5" style="text-align: center;">Periode: {{ $periode }}</th>
        </tr>
        <tr>
            <th colspan="5" style="text-align: center;">Dicetak: {{ date('d F Y') }}</th>
        </tr>
        <tr></tr>
        <tr style="background-color: #4472C4; color: white; font-weight: bold;">
            <th>No</th>
            <th>Tanggal Transaksi</th>
            <th>Jumlah Transaksi</th>
            <th>Total Pendapatan</th>
            <th>Rata-Rata per Transaksi</th>
        </tr>
    </thead>
    <tbody>
        @php
        $totalTransaksi = 0;
        $totalPendapatan = 0;
        @endphp
        @foreach($data as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d/m/Y') }}</td>
            <td>{{ $item->jumlah_transaksi }}</td>
            <td>Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($item->rata_rata_per_transaksi, 0, ',', '.') }}</td>
        </tr>
        @php
        $totalTransaksi += $item->jumlah_transaksi;
        $totalPendapatan += $item->total_pendapatan;
        @endphp
        @endforeach

        <tr></tr>
        <tr style="font-weight: bold; background-color: #E7E6E6;">
            <td colspan="5">RINGKASAN</td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold;">Total Transaksi</td>
            <td colspan="3">{{ $totalTransaksi }}</td>
        </tr>
        <tr>

            <td colspan="2" style="font-weight: bold;">Total Pendapatan</td>
            <td colspan="3">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold;">Rata-Rata per Transaksi</td>
            <td colspan="3">Rp
                {{ number_format($totalTransaksi > 0 ? $totalPendapatan / $totalTransaksi : 0, 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>