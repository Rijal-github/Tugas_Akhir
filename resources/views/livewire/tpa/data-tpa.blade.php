
@section('breadcrumb', 'Data TPA')

<div class="p-5 bg-white rounded shadow mr-5">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold mb-4">Form Input Ritasi</h2>
        <div class="flex items-center gap-3">
            <select wire:model="filterType" class="border border-slate-200 p-2 rounded">
                <option value="daily">Harian</option>
                <option value="weekly">Mingguan</option>
                <option value="monthly">Bulanan</option>
                <option value="yearly">Tahunan</option>
            </select>
            
            <div class="border border-slate-200 p-2 rounded">
                @if(in_array($filterType, ['daily', 'weekly']))
                    <input type="date" wire:model="tanggal">
                @endif
                
                @if($filterType === 'monthly')
                    <select wire:model="bulan">
                        @for($m=1; $m<=12; $m++)
                            <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">{{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
                        @endfor
                    </select>
                    <input type="number" wire:model="tahun" placeholder="Tahun">
                @endif
                
                @if($filterType === 'yearly')
                    <input type="number" wire:model="tahun" placeholder="Tahun">
                @endif
            </div>
            
            <button wire:click="export" class="bg-green-500 text-white px-4 py-2 rounded">Export</button>
        </div>
    </div>

    @php
        $role = strtolower(auth()->user()->role->name ?? '');
    @endphp

    @if(in_array($role, ['admin', 'dlh']))
    <div class="flex gap-4">
        <a href="{{ route('input-ritasi', ['tpa' => 'pecuk']) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Input Ritasi Pecuk</a>
        <a href="{{ route('input-ritasi', ['tpa' => 'kertawinangun']) }}" class="bg-green-500 text-white px-4 py-2 rounded">Input Ritasi Kertawinangun</a>
    </div>
    @elseif($role === 'operator_pecuk')
    <a href="{{ route('input-ritasi', ['tpa' => 'pecuk']) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Input Ritasi Pecuk</a>
    @elseif($role === 'operator_kertawinangun')
    <a href="{{ route('input-ritasi', ['tpa' => 'kertawinangun']) }}" class="bg-green-500 text-white px-4 py-2 rounded">Input Ritasi Kertawinangun</a>
    @endif

    <div class="TabelData mt-4 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-200 rounded-lg">
                <tr class="">
                    <th class="p-3">Nama Supir</th>
                    <th class="p-3">No Polisi</th>
                    <th class="p-3">Netto In</th>
                    <th class="p-3">Netto Out</th>
                    <th class="p-3">Netto</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">UPTD</th>
                    <th class="p-3">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ritasiList as $ritasi)
                <tr class="border-b">
                    <td>{{ $ritasi->driver->name }}</td>
                    <td>{{ $ritasi->vehicle->no_polisi }}</td>
                    <td>{{ $ritasi->bruto }}</td>
                    <td>{{ $ritasi->netto }}</td>
                    <td class="font-bold text-red-600">{{ $ritasi->bruto - $ritasi->netto }}</td>
                    <td>{{ \Carbon\Carbon::parse($ritasi->created_at)->format('d-m-Y') }}</td>
                    <td>{{ $ritasi->vehicle->uptd->nama_uptd ?? '-' }}</td>
                    <td>{{ $ritasi->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>    
    </div>
</div>