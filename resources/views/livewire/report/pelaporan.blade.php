{{-- @extends('layouts.main') --}}

@section('breadcrumb', 'Pelaporan / Laporan Harian')
{{-- @section('content') --}}

<div class="p-6 bg-white shadow-md rounded-lg overflow-x-auto">
    <div class="mb-6">
        <div class="items-center">
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-1">LAPORAN HARIAN</h1>
            <p class="text-sm text-gray-600 leading-tight text-center">Penerimaan Sampah di UPT TPA Pecuk, UPTD Indramayu, Karangampel, JTB, Losarang, dan Sampah Luar</p>
            <p class="text-sm text-gray-600 text-center">Dinas Lingkungan Hidup Kab. Indramayu</p>
        </div>
        {{-- <span><strong>Tanggal:</strong> 08 Januari 2025</span> --}}
        {{-- <strong class="text-sm mt-2 font-semibold text-gray-700">Tanggal : <span class="text-blue-700">08 Januari 2025</span></strong> --}}
        <div class="mb-4">
            <label for="tanggal">Pilih Tanggal:</label>
            <input type="date" id="tanggal" wire:model="tanggal" class="border p-2 rounded">
        </div>
    </div>

    <table class="w-full border mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-3 py-1">Supir</th>
                <th class="border px-3 py-1">Netto Pre</th>
                <th class="border px-3 py-1">Netto Post</th>
                <th class="border px-3 py-1">Selisih Netto</th>
                <th class="border px-3 py-1">Banyak Ritasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ritasi as $r)
                <tr>
                    <td class="border px-3 py-1">{{ $r->driver->name ?? '-' }}</td>
                    <td class="border px-3 py-1">{{ $r->netto_pre }}</td>
                    <td class="border px-3 py-1">{{ $r->netto_post }}</td>
                    <td class="border px-3 py-1">{{ $r->netto_post - $r->netto_pre }}</td>
                    <td class="border px-3 py-1">{{ $r->banyak_ritasi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 font-semibold">
        Total Ritasi: {{ $total_ritasi }} |
        Total Netto: {{ $total_netto }}
    </div>

    {{-- <table class="min-w-full table-auto text-sm border border-gray-300">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="border px-3 py-2 text-left">No.</th>
                <th class="border px-3 py-2 text-left">Nama Supir</th>
                <th class="border px-3 py-2 text-left">No. Polisi</th>
                <th class="border px-3 py-2 text-left">Nama Mobil</th>
                <th class="border px-3 py-2 text-center">Banyaknya Ritasi</th>
                <th class="border px-3 py-2 text-right">Netto (kg)</th>
                <th class="border px-3 py-2 text-left">Lok. / Wil.</th>
                <th class="border px-3 py-2 text-left">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= 10; $i++)
                <tr class="hover:bg-gray-50">
                    <td class="border px-3 py-2">{{ $i }}</td>
                    <td class="border px-3 py-2">Nama Supir {{ $i }}</td>
                    <td class="border px-3 py-2">E 8{{ rand(100,999) }} P</td>
                    <td class="border px-3 py-2">Armroll Truck</td>
                    <td class="border px-3 py-2 text-center">{{ rand(1, 5) }}</td>
                    <td class="border px-3 py-2 text-right text-red-600 font-semibold">{{ number_format(rand(2000, 10000)) }}</td>
                    <td class="border px-3 py-2">UPTD Indramayu</td>
                    <td class="border px-3 py-2">Sampah DLH</td>
                </tr>
            @endfor
            <!-- Baris total -->
            <tr class="bg-yellow-100 font-bold">
                <td colspan="4" class="border px-3 py-2 text-right">JUMLAH</td>
                <td class="border px-3 py-2 text-center">108</td>
                <td class="border px-3 py-2 text-right">243.380</td>
                <td colspan="2" class="border px-3 py-2"></td>
            </tr>
        </tbody>
    </table> --}}

    <div class="mt-8 text-sm text-gray-700">
        <p class="mb-1">Tanggal : 08 Januari 2025</p>
        <p class="mb-1 font-bold uppercase">Pencatat Ritasi Sampah</p>
        <p class="mt-4">Sunarno</p>
    </div>
</div>
{{-- @endsection --}}
