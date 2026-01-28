<table>
    <thead>
        <tr>
            <th colspan="5" style="text-align: center; font-weight: bold; font-size: 16px;">
                LAPORAN KEUANGAN
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
            <th>Tanggal</th>
            <th>Total Pendapatan</th>
            <th>Total Pengeluaran</th>
            <th>Laba Bersih</th>
        </tr>
    </thead>
    <tbody>
        @php
        $totalPendapatan = 0;
        $totalPengeluaran = 0;
        @endphp
        @foreach($data as $index => $item)
        @php
        $labaBersih = $item->total_pendapatan - $item->total_pengeluaran;
        $totalPendapatan += $item->total_pendapatan;
        $totalPengeluaran += $item->total_pengeluaran;
        @endphp
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
            <td>Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($item->total_pengeluaran, 0, ',', '.') }}</td>
            <td style="color: {{ $labaBersih >= 0 ? 'green' : 'red' }};">
                Rp {{ number_format($labaBersih, 0, ',', '.') }}
            </td>
        </tr>
        @endforeach

        <tr></tr>
        <tr style="font-weight: bold; background-color: #E7E6E6;">
            <td colspan="5">RINGKASAN KEUANGAN</td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold;">Total Pendapatan</td>
            <td colspan="3">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold;">Total Pengeluaran</td>
            <td colspan="3">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
        </tr>
        <tr
            style="font-weight: bold; background-color: {{ $totalPendapatan - $totalPengeluaran >= 0 ? '#C6EFCE' : '#FFC7CE' }};">
            <td colspan="2">LABA BERSIH</td>
            <td colspan="3" style="color: {{ $totalPendapatan - $totalPengeluaran >= 0 ? 'green' : 'red' }};">
                Rp {{ number_format($totalPendapatan - $totalPengeluaran, 0, ',', '.') }}
            </td>
        </tr>
    </tbody>
</table>