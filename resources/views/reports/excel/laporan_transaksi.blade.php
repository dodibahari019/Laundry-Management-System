<table>
    <thead>
        <tr>
            <th colspan="12" style="text-align: center; font-weight: bold; font-size: 16px;">
                LAPORAN TRANSAKSI
            </th>
        </tr>
        <tr>
            <th colspan="12" style="text-align: center;">D'Laundry</th>
        </tr>
        <tr>
            <th colspan="12" style="text-align: center;">Periode: {{ $periode }}</th>
        </tr>
        <tr>
            <th colspan="12" style="text-align: center;">Dicetak: {{ date('d F Y') }}</th>
        </tr>
        <tr></tr>
        <tr style="background-color: #4472C4; color: white; font-weight: bold;">
            <th>No</th>
            <th>Kode Order</th>
            <th>Pelanggan</th>
            <th>No. HP</th>
            <th>Layanan</th>
            <th>Jenis</th>
            <th>Berat/Qty</th>
            <th>Total Harga</th>
            <th>Status Order</th>
            <th>Metode Pembayaran</th>
            <th>Dibayar</th>
            <th>Kembalian</th>
        </tr>
    </thead>
    <tbody>
        @php
        $totalPendapatan = 0;
        $totalDibayar = 0;
        $totalKembalian = 0;
        @endphp
        @foreach($data as $index => $item)
        @php
        $beratQty = $item->jenis == 'kiloan' ? $item->berat : $item->jumlah;
        $satuan = $item->jenis == 'kiloan' ? 'Kg' : 'Pcs';
        $totalPendapatan += $item->total;
        $totalDibayar += $item->jumlahBayar;
        $totalKembalian += $item->kembalian;
        @endphp
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>#{{ $item->kode_order }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->no_hp }}</td>
            <td>{{ $item->nama_layanan }}</td>
            <td>{{ ucfirst($item->jenis) }}</td>
            <td>{{ rtrim(rtrim(number_format($beratQty, 2, ',', '.'), '0'), ',') }} {{ $satuan }}</td>
            <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
            <td>{{ ucfirst($item->status_order) }}</td>
            <td>{{ ucfirst($item->metode) }}</td>
            <td>Rp {{ number_format($item->jumlahBayar, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($item->kembalian, 0, ',', '.') }}</td>
        </tr>
        @endforeach

        <tr></tr>
        <tr style="font-weight: bold; background-color: #E7E6E6;">
            <td colspan="12">RINGKASAN</td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold;">Total Transaksi</td>
            <td colspan="10">{{ count($data) }}</td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold;">Total Dibayar</td>
            <td colspan="10">Rp {{ number_format($totalDibayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold;">Total Kembalian</td>
            <td colspan="10">Rp {{ number_format($totalKembalian, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold;">TOTAL PENDAPATAN</td>
            <td colspan="10">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>