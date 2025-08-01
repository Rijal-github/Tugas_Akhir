<table>
    <tr>
        <th colspan="8" style="text-align: center; font-size: 16px; font-weight: bold;">Laporan Harian Ritasi</th>
    </tr>
    <tr><td colspan="8">Tanggal: {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</td></tr>
    <tr></tr>
    <thead>
        <tr>
            <th>Nama Supir</th>
            <th>Jenis Kendaraan</th>
            <th>Nomor Polisi</th>
            <th>Jumlah Ritasi</th>
            <th>Netto (Kg)</th>
            <th>Rata-rata / Hari (Kg)</th>
            <th>Lokasi / Wilayah</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $item['driver_name'] }}</td>
            <td>{{ $item['vehicle'] }}</td>
            <td>{{ $item['no_polisi'] }}</td>
            <td>{{ $item['ritasi'] }}</td>
            <td>{{ $item['netto'] }}</td>
            <td>{{ $item['avg_per_day'] }}</td>
            <td>{{ $item['lokasi'] }}</td>
            <td>{{ $item['keterangan'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>