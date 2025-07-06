<div class="p-4 bg-white rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Input Ritasi - TPA Kertawinangun</h2>

    @if (session()->has('message'))
        <div class="text-green-600">{{ session('message') }}</div>
    @endif

    <div class="mb-3">
        <label>Nama Supir</label>
        <select wire:model="driver_id" class="w-full border p-2 rounded">
            <option value="">-- Pilih Supir --</option>
            @foreach($drivers as $driver)
                <option value="{{ $driver->id }}">{{ $driver->nama }}</option>
            @endforeach
        </select>
    </div>

    @if ($vehicles)
        <div class="mb-3">
            <label>Kendaraan (Otomatis)</label>
            <select wire:model="vehicle_id" class="w-full border p-2 rounded">
                @foreach($vehicles as $v)
                    <option value="{{ $v->id }}">{{ $v->no_polisi }} ({{ $v->jenis_kendaraan }})</option>
                @endforeach
            </select>
        </div>
    @endif

    <div class="mb-3">
        <label>Netto Pre</label>
        <input type="number" wire:model="netto_pre" class="w-full border p-2 rounded">
    </div>

    <div class="mb-3">
        <label>Netto Post</label>
        <input type="number" wire:model="netto_post" class="w-full border p-2 rounded">
    </div>

    <div class="mb-3">
        <label>Banyak Ritasi</label>
        <input type="number" wire:model="banyak_ritasi" class="w-full border p-2 rounded">
    </div>

    <div class="mb-3">
        <label>Keterangan</label>
        <textarea wire:model="keterangan" class="w-full border p-2 rounded"></textarea>
    </div>

    <button wire:click="save" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    <button wire:click="batal" class="bg-red-500 text-white px-4 py-2 rounded">Batal</button>

</div>

