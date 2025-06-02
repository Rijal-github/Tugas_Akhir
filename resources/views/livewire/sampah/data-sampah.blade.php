{{-- @extends('layouts.main') --}}

@section('breadcrumb', 'Pendataan Sampah')
{{-- @section('content') --}}


<div class="p-4 sm:p-8 bg-white shadow-md rounded-md w-full overflow-x-auto">
    <h2 class="text-2xl font-bold text-center mb-2">CATATAN RITASI SAMPAH</h2>
    <p class="text-center text-sm text-gray-600 mb-1">UPT Pengelolaan Sampah Akhir TPA Pecuk - Dinas Lingkungan Hidup</p>
    <div class="flex justify-between text-sm text-gray-500 mb-4">
        <span><strong>Hari:</strong> MINGGU</span>
        <span><strong>Tanggal:</strong> 08/12/24</span>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border text-xs text-gray-700">
            <thead class="bg-slate-100 text-gray-700">
                <tr>
                    <th class="border px-2 py-1 text-left">NAMA SUPIR</th>
                    <th class="border px-2 py-1">NO. POLISI</th>
                    <th class="border px-2 py-1">UPTD</th>
                    @for ($i = 1; $i <= 8; $i++)
                        <th class="border px-2 py-1" colspan="3">{{ $i }}</th>
                    @endfor
                    <th class="border px-2 py-1">JUMLAH RITASI</th>
                    <th class="border px-2 py-1">JUMLAH TONASE</th>
                </tr>
                <tr class="bg-slate-200">
                    <th colspan="3"></th>
                    @for ($i = 1; $i <= 8; $i++)
                        <th class="border px-2 py-1">IN</th>
                        <th class="border px-2 py-1">OUT</th>
                        <th class="border px-2 py-1">NETTO</th>
                    @endfor
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($drivers ?? range(1, 10) as $driver)
                    <tr class="hover:bg-slate-50">
                        <td class="border px-2 py-1 whitespace-nowrap">{{ $driver['name'] ?? 'NAMA SUPIR' }}</td>
                        <td class="border px-2 py-1">{{ $driver['plate'] ?? 'E 0000 XX' }}</td>
                        <td class="border px-2 py-1">{{ $driver['uptd'] ?? 'Indramayu' }}</td>
                        @for ($i = 1; $i <= 8; $i++)
                            <td class="border px-2 py-1 text-center">{{ $driver['day'.$i]['in'] ?? '-' }}</td>
                            <td class="border px-2 py-1 text-center">{{ $driver['day'.$i]['out'] ?? '-' }}</td>
                            <td class="border px-2 py-1 text-center text-red-600 font-semibold">{{ $driver['day'.$i]['netto'] ?? '-' }}</td>
                        @endfor
                        <td class="border px-2 py-1 text-center font-medium">{{ $driver['ritasi'] ?? rand(1, 5) }}</td>
                        <td class="border px-2 py-1 text-center font-bold text-yellow-600">{{ $driver['tonase'] ?? number_format(rand(2000, 12000)) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-slate-100 font-semibold">
                    <td colspan="27" class="text-right px-2 py-1">Jumlah total volume tonase</td>
                    <td class="text-center">{{ $totalRitasi ?? 107 }}</td>
                    <td class="text-center">{{ $totalTonase ?? '245.970' }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
{{-- @endsection --}}