{{-- @extends('layouts.main') --}}

@section('breadcrumb', 'Pelaporan / Laporan Mingguan')
{{-- @section('content') --}}

<div class="p-6 bg-white shadow rounded-xl overflow-x-auto">
    <h1 class="text-2xl font-bold text-center mb-2 uppercase">Laporan Hasil Rekapitulasi Mingguan</h1>
    <p class="text-center text-sm mb-1">Penerimaan Sampah di UPTD TPAS Pecuk UPTD, Indramayu, Karangampel, JTB, Losarang dan Sampah Luar</p>
    <p class="text-center text-sm mb-4">Dinas Lingkungan Hidup Kab. Indramayu</p>
  
    <div class="flex justify-between text-sm mb-4">
      <span>Dari Tanggal: <strong>01 s/d 07 Januari 2025</strong></span>
      <span>Minggu ke: <strong>1</strong></span>
    </div>
  
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm text-center border border-gray-300">
        <thead class="bg-gray-100 text-gray-700">
          <tr>
            <th class="border px-3 py-2">No.</th>
            <th class="border px-3 py-2">Nama Supir</th>
            <th class="border px-3 py-2">No. Polisi</th>
            <th class="border px-3 py-2">Nama Mobil</th>
            <th class="border px-3 py-2">Banyaknya Ritasi</th>
            <th class="border px-3 py-2">Netto (Ton)</th>
            <th class="border px-3 py-2">Netto (Kg)</th>
            <th class="border px-3 py-2">Lokasi / Wilayah</th>
            <th class="border px-3 py-2">Keterangan</th>
          </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= 10; $i++)
            <!-- Loop data di sini -->
            <tr class="hover:bg-gray-50">
                <td class="border px-3 py-2">{{ $i }}</td>
                <td class="border px-3 py-2">Nama Supir {{ $i }}</td>
                <td class="border px-3 py-2">E 8{{ rand(100,999) }} JP</td>
                <td class="border px-3 py-2">Armoll Truck</td>
                <td class="border px-3 py-2">{{ rand(10, 30) }}</td>
                <td class="border px-3 py-2">{{ number_format(rand(2000, 10000)) }}</td>
                <td class="border px-3 py-2">{{ number_format(rand(5000, 20000)) }}</td>
                <td class="border px-3 py-2">UPTD Indramayu</td>
                <td class="border px-3 py-2">Sampah DLH</td>
            </tr>
            @endfor
          <!-- Tambahkan baris lainnya sesuai kebutuhan -->
  
          <!-- Footer Total -->
          <tr class="font-bold bg-gray-50">
            <td colspan="4" class="border px-3 py-2 text-right">Jumlah</td>
            <td class="border px-3 py-2">{{ rand(50, 100) }}</td>
            <td class="border px-3 py-2">{{ number_format(rand(2000, 10000)) }}</td>
            <td class="border px-3 py-2">{{ number_format(rand(2000, 10000)) }}</td>
            <td colspan="2" class="border px-3 py-2"></td>
          </tr>
        </tbody>
      </table>
    </div>
  
    <!-- Footer Tanda Tangan -->
    <div class="mt-10 text-sm">
      <div class="flex justify-between">
        <div class="text-center">
          <p>Mengetahui,</p>
          <p class="font-semibold">KEPALA UPTD PENGELOLAAN SAMPAH</p>
          <p class="mt-16 font-semibold">KUSNADI, S.HUT., M.Si</p>
          <p>NIP. 19781204 200212 1 007</p>
        </div>
        <div class="text-center">
          <p>Menyetujui,</p>
          <p class="font-semibold">KASUBAG TU</p>
          <p class="mt-16 font-semibold">AAN ANDANI, SIP</p>
          <p>NIP. 19801205 200901 1 005</p>
        </div>
        <div class="text-center">
          <p>Tanggal, 07 Januari 2025</p>
          <p class="mt-16 font-semibold">SUNARNO</p>
        </div>
      </div>
    </div>
</div>
  
{{-- @endsection --}}
