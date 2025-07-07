<div class="p-4 bg-white rounded shadow">
    <div class="flex justify-between p-2">
        <h2 class="text-lg font-semibold mb-4">Input Ritasi - TPA Pecuk</h2>
    </div>

    @if (session()->has('message'))
        <div class="text-green-600">{{ session('message') }}</div>
    @endif

    <div class="relative mb-3">
        <label>Nama Supir</label>
        <select wire:model.lazy="id_driver" class="w-full border p-2 rounded z-50 bg-white">
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



   