
@section('breadcrumb', 'Data TPA')

<div class="p-5 bg-white rounded shadow mr-5">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold mb-4">Form Input Ritasi</h2>
        <div class="flex items-center gap-3">
            <select wire:model="filterType" id="filterType" class="p-2 border border-black rounded-lg">
                <option value="">-- Pilih Jenis Filter --</option>
                <option value="harian">Harian</option>
                <option value="mingguan">Mingguan</option>
                <option value="bulanan">Bulanan</option>
                <option value="tahunan">Tahunan</option>
            </select>
            
            <div class="border border-slate-200 p-2 rounded">
                @if(in_array($filterType, ['harian', 'mingguan']))
                    <input type="date" wire:model="tanggal">
                @endif
                
                @if($filterType === 'bulanan')
                    <select wire:model="bulan">
                        @for($m=1; $m<=12; $m++)
                            <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">{{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
                        @endfor
                    </select>
                    <input type="number" wire:model="bulan" placeholder="Bulan">
                @endif
                
                @if($filterType === 'tahunan')
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
        <div class="flex gap-4 mb-4">
            <button wire:click="$set('selectedTPA', 'pecuk')"
                class="px-4 py-2 rounded {{ $selectedTPA === 'pecuk' ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
                Lihat Ritasi Pecuk
            </button>

            <button wire:click="$set('selectedTPA', 'kertawinangun')"
                class="px-4 py-2 rounded {{ $selectedTPA === 'kertawinangun' ? 'bg-green-600 text-white' : 'bg-gray-200' }}">
                Lihat Ritasi Kertawinangun
            </button>
        </div>
        <div class="flex justify-end mb-2">
            @if($selectedTPA === 'pecuk')
            <a href="{{ route('input-ritasi', ['tpa' => 'pecuk']) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Input Ritasi</a>
            @elseif($selectedTPA === 'kertawinangun')
            <a href="{{ route('input-ritasi', ['tpa' => 'kertawinangun']) }}" class="bg-green-500 text-white px-4 py-2 rounded">Input Ritasi</a>
            @endif
        </div>
        {{-- @include('livewire.tpa.tabel-hasil-ritasi', ['ritasiList' => $ritasiList]) --}}
        @include('livewire.tpa.tabel-hasil-ritasi', [
            'ritasiList' => $ritasiList,
            'selectedTPA' => $selectedTPA,
        ])
    @endif 
</div>