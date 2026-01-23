<div class="TabelData mt-4 overflow-x-auto">
    <table class="min-w-full border border-slate-300 rounded-lg overflow-hidden border-collapse">
        <thead class="bg-slate-200 text-slate-800 text-sm uppercase tracking-wide">
            <tr>
                <th class="px-4 py-3 text-left border border-slate-300">Nama Supir</th>
                <th class="px-4 py-3 text-left border border-slate-300">No Polisi</th>
                <th class="px-4 py-3 text-left border border-slate-300">Netto In</th>
                <th class="px-4 py-3 text-left border border-slate-300">Netto Out</th>
                <th class="px-4 py-3 text-left border border-slate-300">Netto</th>
                <th class="px-4 py-3 text-left border border-slate-300">Tanggal</th>
                <th class="px-4 py-3 text-left border border-slate-300">UPTD</th>
                <th class="px-4 py-3 text-left border border-slate-300">Keterangan</th>
            </tr>
        </thead>
        <tbody class="text-sm text-slate-700 bg-white">
            @if (!empty($ritasiList) && count($ritasiList) > 0)
                @php
                    // Kelompokkan data berdasarkan supir + no polisi
                    $grouped = $ritasiList->groupBy(function($item) {
                        return $item->driver->name . '|' . $item->vehicle->no_polisi;
                    });
                @endphp

                @foreach ($grouped as $key => $items)
                    @php
                        [$driverName, $noPolisi] = explode('|', $key);
                        $rowCount = count($items);
                        $firstRow = true;
                    @endphp

                    @foreach ($items as $ritasi)
                        <tr class="hover:bg-slate-100 transition-colors">
                            @if ($firstRow)
                                <td class="px-4 py-3 border border-slate-300 align-top" rowspan="{{ $rowCount }}">{{ $driverName }}</td>
                                <td class="px-4 py-3 border border-slate-300 align-top" rowspan="{{ $rowCount }}">{{ $noPolisi }}</td>
                                @php $firstRow = false; @endphp
                            @endif
                            <div class="hover:bg-slate-100 transition-colors">
                                <td class="px-4 py-3 border border-slate-300">{{ $ritasi->bruto }}</td>
                                <td class="px-4 py-3 border border-slate-300">{{ $ritasi->netto }}</td>
                                <td class="px-4 py-3 border border-slate-300 font-semibold text-blue-600">
                                    {{ number_format($ritasi->bruto - $ritasi->netto) }}
                                </td>
                                <td class="px-4 py-3 border border-slate-300">{{ \Carbon\Carbon::parse($ritasi->created_at)->format('d-m-Y') }}</td>
                                <td class="px-4 py-3 border border-slate-300">{{ $ritasi->vehicle->uptd->nama_uptd ?? '-' }}</td>
                                <td class="px-4 py-3 border border-slate-300">{{ $ritasi->keterangan }}</td>
                            </div>
                        </tr>
                    @endforeach
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-500 border border-slate-300">Data ritasi belum tersedia.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>



{{-- <div class="TabelData mt-4 overflow-x-auto">
    <table class="min-w-full border border-slate-300 rounded-lg overflow-hidden">
        <thead class="bg-slate-200 text-slate-800 text-sm uppercase tracking-wide">
            <tr>
                <th class="px-4 py-3 text-left">Nama Supir</th>
                <th class="px-4 py-3 text-left">No Polisi</th>
                <th class="px-4 py-3 text-left">Netto In</th>
                <th class="px-4 py-3 text-left">Netto Out</th>
                <th class="px-4 py-3 text-left">Netto</th>
                <th class="px-4 py-3 text-left">Tanggal</th>
                <th class="px-4 py-3 text-left">UPTD</th>
                <th class="px-4 py-3 text-left">Keterangan</th>
            </tr>
        </thead>
        <tbody class="text-sm text-slate-700 bg-white divide-y divide-slate-200">
            @if (!empty($ritasiList) && count($ritasiList) > 0)
                @php
                    $lastDriver = null;
                    $lastNoPolisi = null;
                @endphp
                @foreach ($ritasiList as $ritasi)
                    <tr class="hover:bg-slate-100 transition-colors">
                        <td class="px-4 py-3">
                            @if ($lastDriver !== $ritasi->driver->name || $lastNoPolisi !== $ritasi->vehicle->no_polisi)
                                {{ $ritasi->driver->name }}
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if ($lastDriver !== $ritasi->driver->name || $lastNoPolisi !== $ritasi->vehicle->no_polisi)
                                {{ $ritasi->vehicle->no_polisi }}
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $ritasi->bruto }}</td>
                        <td class="px-4 py-3">{{ $ritasi->netto }}</td>
                        <td class="px-4 py-3 font-semibold text-red-600">
                            {{ number_format($ritasi->bruto - $ritasi->netto) }}
                        </td>
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($ritasi->created_at)->format('d-m-Y') }}</td>
                        <td class="px-4 py-3">{{ $ritasi->vehicle->uptd->nama_uptd ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $ritasi->keterangan }}</td>
                    </tr>
                    @php
                        // update penanda
                        $lastDriver = $ritasi->driver->name;
                        $lastNoPolisi = $ritasi->vehicle->no_polisi;
                    @endphp
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-500">Data ritasi belum tersedia.</td>
                </tr>
            @endif
        </tbody>
    </table>    
</div> --}}


{{-- <div class="TabelData mt-4 overflow-x-auto">
        <table class="min-w-full border border-slate-300 rounded-lg overflow-hidden">
            <thead class="bg-slate-200 text-slate-800 text-sm uppercase tracking-wide">
            <tr>
                <th class="px-4 py-3 text-left">Nama Supir</th>
                <th class="px-4 py-3 text-left">No Polisi</th>
                <th class="px-4 py-3 text-left">Netto In</th>
                <th class="px-4 py-3 text-left">Netto Out</th>
                <th class="px-4 py-3 text-left">Netto</th>
                <th class="px-4 py-3 text-left">Tanggal</th>
                <th class="px-4 py-3 text-left">UPTD</th>
                <th class="px-4 py-3 text-left">Keterangan</th>
            </tr>
        </thead>
            <tbody class="text-sm text-slate-700 bg-white divide-y divide-slate-200">
                @if (!empty($ritasiList) && count($ritasiList) > 0)
                    @foreach ($ritasiList as $ritasi)
                    <tr class="hover:bg-slate-100 transition-colors">
                        <td class="px-4 py-3">{{ $ritasi->driver->name }}</td>
                        <td class="px-4 py-3">{{ $ritasi->vehicle->no_polisi }}</td>
                        <td class="px-4 py-3">{{ $ritasi->bruto }}</td>
                        <td class="px-4 py-3">{{ $ritasi->netto }}</td>
                        <td class="px-4 py-3 font-semibold text-red-600">{{ number_format($ritasi->bruto - $ritasi->netto) }}</td>
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($ritasi->created_at)->format('d-m-Y') }}</td>
                        <td class="px-4 py-3">{{ $ritasi->vehicle->uptd->nama_uptd ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $ritasi->keterangan }}</td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-500">Data ritasi belum tersedia.</td>
                </tr>
            @endif
            </tbody>
        </table>    
    </div> --}}
