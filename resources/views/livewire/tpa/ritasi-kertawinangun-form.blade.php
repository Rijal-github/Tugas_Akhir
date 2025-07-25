<div class="p-4 bg-white rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Input Ritasi - TPA Kertawinangun</h2>

    @if (session()->has('message'))
        <div class="text-green-600">{{ session('message') }}</div>
    @endif

    <div class="mb-3">
        <label>Nama Supir</label>
        <select wire:model.lazy="id_driver" class="w-full border p-2 rounded">
            <option value="">-- Pilih Supir --</option>
            @foreach($drivers as $driver)
                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
            @endforeach
        </select>
    </div>

    @if ($selectedVehicleJenis && $selectedVehicleNoPolisi)
        <div class="mb-3">
            <label>Jenis Kendaraan</label>
            <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $selectedVehicleJenis }}" readonly>
        </div>

        <div class="mb-3">
            <label>Nomor Polisi</label>
            <input type="text" class="w-full border p-2 rounded bg-gray-100" value="{{ $selectedVehicleNoPolisi }}" readonly>
        </div>
    @endif

    <div class="mb-3">
        <label>Netto Pre</label>
        <input type="number" wire:model="bruto" class="w-full border p-2 rounded">
    </div>

    <div class="mb-3">
        <label>Netto Post</label>
        <input type="number" wire:model="netto" class="w-full border p-2 rounded">
    </div>

    <div class="mb-3">
        <label>Banyak Ritasi</label>
        <input type="number" wire:model="banyak_ritasi" class="w-full border p-2 rounded">
    </div>

    <div class="mb-3 relative" x-data="{ open: false }" @click.away="open = false">
        <label for="keterangan">Keterangan</label>
        <input
            type="text"
            id="keterangan"
            wire:model="keterangan"
            @focus="open = true"
            @click="open = true"
            class="w-full border p-2 rounded"
            placeholder="Ketik atau pilih keterangan..."
        >
        <ul x-show="open" class="absolute z-50 bg-white border w-full mt-1 rounded shadow text-sm">
            <li class="px-3 py-2 hover:bg-gray-100 cursor-pointer" @click="$wire.keterangan = 'Sampah Rutin'; open = false">
                Sampah Rutin
            </li>
            <li class="px-3 py-2 hover:bg-gray-100 cursor-pointer" @click="$wire.keterangan = 'Sampah Luar'; open = false">
                Sampah Luar
            </li>
            <li class="px-3 py-2 hover:bg-gray-100 cursor-pointer" @click="$wire.keterangan = 'Sampah Liar'; open = false">
                Sampah Liar
            </li>
        </ul>
    </div>

    <button wire:click="save" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>

</div>

