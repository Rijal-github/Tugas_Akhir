
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

    <div class="flex gap-4 mb-6">
        <button wire:click="$set('selectedForm', 'pecuk')" class="px-6 py-2 bg-blue-500 text-white rounded">
            Ritasi TPA Pecuk
        </button>
        <button wire:click="$set('selectedForm', 'kertawinangun')" class="px-3 py-2 bg-green-500 text-white rounded">
            Ritasi TPA Kertawinangun
        </button>
    </div>

    @if ($selectedForm === 'pecuk')
        @livewire('tpa.ritasi-pecuk-form')
    @elseif ($selectedForm === 'kertawinangun')
        @livewire('tpa.ritasi-kertawinangun-form')
    @else
        <p class="text-gray-600">Silakan pilih jenis ritasi terlebih dahulu.</p>
    @endif

    {{-- @livewire('data-tpa') --}}

</div>

