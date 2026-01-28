<table>
    <thead>
        <tr>
            <th colspan="8" style="text-align: center; font-weight: bold; font-size: 16px;">
                LAPORAN LAYANAN
            </th>
        </tr>
        <tr>
            <th colspan="8" style="text-align: center;">D'Laundry</th>
        </tr>
        <tr>
            <th colspan="8" style="text-align: center;">Periode: {{ $periode }}</th>
        </tr>
        <tr>
            <th colspan="8" style="text-align: center;">Dicetak: {{ date('d F Y') }}</th>
        </tr>
        <tr></tr>
        <tr style="background-color: #4472C4; color: white; font-weight: bold;">
            <th>No</th>
            <th>Nama Layanan</th>
            <th>Jenis</th>
            <th>Harga Layanan</th>
            <th>Jumlah Transaksi</th>
            <th>Total Berat</th>
            <th>Total Qty</th>
            <th>Total Pendapatan</th>
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
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->nama_layanan }}</td>
            <td>{{ ucfirst($item->jenis) }}</td>
            <td>Rp {{ number_format($item->harga_layanan, 0, ',', '.') }}</td>
            <td>{{ $item->jumlah_transaksi }}</td>
            <td>{{ $item->jenis == 'kiloan' ? number_format($item->total_berat, 2, ',', '.') . ' Kg' : '-' }}</td>
            <td>{{ $item->jenis == 'satuan' ? $item->total_qty . ' Pcs' : '-' }}</td>
            <td>Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
        </tr>
        @endforeach

        <tr></tr>
        <tr style="font-weight: bold; background-color: #E7E6E6;">
            <td colspan="8">RINGKASAN</td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold;">Total Jenis Layanan</td>
            <td colspan="6">{{ count($data) }}</td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold;">Total Transaksi</td>
            <td colspan="6">{{ $totalTransaksi }}</td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold;">TOTAL PENDAPATAN</td>
            <td colspan="6">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>