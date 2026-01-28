<table>
    <thead>
        <tr>
            <th colspan="7" style="text-align: center; font-weight: bold; font-size: 16px;">
                LAPORAN PELANGGAN
            </th>
        </tr>
        <tr>
            <th colspan="7" style="text-align: center;">D'Laundry</th>
        </tr>
        <tr>
            <th colspan="7" style="text-align: center;">Periode: {{ $periode }}</th>
        </tr>
        <tr>
            <th colspan="7" style="text-align: center;">Dicetak: {{ date('d F Y') }}</th>
        </tr>
        <tr></tr>
        <tr style="background-color: #4472C4; color: white; font-weight: bold;">
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>No. Telepon</th>
            <th>Jumlah Transaksi</th>
            <th>Total Belanja</th>
            <th>Rata-Rata Belanja</th>
            <th>Transaksi Terakhir</th>
        </tr>
    </thead>
    <tbody>
        @php
        $totalTransaksi = 0;
        $totalBelanja = 0;
        @endphp
        @foreach($data as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->nama_pelanggan }}</td>
            <td>{{ $item->no_hp }}</td>
            <td>{{ $item->jumlah_transaksi }}</td>
            <td>Rp {{ number_format($item->total_belanja, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($item->rata_rata_belanja, 0, ',', '.') }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi_terakhir)->format('d/m/Y') }}</td>
        </tr>
        @php
        $totalTransaksi += $item->jumlah_transaksi;
        $totalBelanja += $item->total_belanja;
        @endphp
        @endforeach

        <tr></tr>
        <tr style="font-weight: bold; background-color: #E7E6E6;">
            <td colspan="7">RINGKASAN</td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold;">Total Pelanggan</td>
            <td colspan="5">{{ count($data) }}</td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold;">Total Semua Transaksi</td>
            <td colspan="5">{{ $totalTransaksi }}</td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold;">Total Semua Belanja</td>
            <td colspan="5">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>