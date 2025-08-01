<table>
    <tr>
        <th colspan="8" style="text-align: center; font-size: 16px; font-weight: bold;">Laporan Bulanan Ritasi</th>
    </tr>
    <tr><td colspan="8">Bulan: {{ \Carbon\Carbon::create($tahun, $bulan)->translatedFormat('F Y') }}</td></tr>
    <tr></tr>
    <tr>
        <th>No</th>
        <th>Nama Supir</th>
        <th>No Polisi</th>
        <th>Nama Mobil</th>
        <th>Total Ritasi</th>
        <th>Total Netto (Kg)</th>
        <th>UPTD</th>
        <th>Keterangan</th>
    </tr>
    @foreach($data as $i => $item)
    <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $item['driver_name'] }}</td>
        <td>{{ $item['no_polisi'] }}</td>
        <td>{{ $item['vehicle'] }}</td>
        <td>{{ $item['ritasi'] }}</td>
        <td>{{ $item['netto'] }}</td>
        <td>{{ $item['lokasi'] }}</td>
        <td>{{ $item['keterangan'] }}</td>
    </tr>
    @endforeach
</table>

