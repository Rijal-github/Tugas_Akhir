{{-- <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" wire:click.self="$emit('closeModal')">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-semibold mb-4">{{ $isEdit ? 'Edit' : 'Tambah' }} Data UPTD</h2>

        <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

            <div class="mb-2">
                <label>No Polisi</label>
                <input type="text" wire:model="no_polisi" class="w-full border rounded p-2">
            </div>

            <div class="mb-2">
                <label>Jenis Kendaraan</label>
                <input type="text" wire:model="jenis_kendaraan" class="w-full border rounded p-2">
            </div>

            <div class="mb-2">
                <label>Kapasitas Angkutan</label>
                <input type="number" wire:model="kapasitas_angkutan" class="w-full border rounded p-2">
            </div>

            <div class="mb-2">
                <label>Wilayah</label>
                <input type="text" wire:model="wilayah" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label>Keterangan</label>
                <textarea wire:model="keterangan" class="w-full border rounded p-2"></textarea>
            </div>

            <div class="flex justify-between">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    {{ $isEdit ? 'Update' : 'Simpan' }}
                </button>
                <button type="button" wire:click="closeModal" class="text-gray-500 hover:underline">Batal</button>
            </div>
        </form>
    </div>
</div> --}}



            {{-- <div class="mb-2">
                <label class="block">Supir</label>
                <select wire:model="id_supir" class="w-full border rounded p-2">
                    <option value="">Pilih Supir</option>
                    @foreach($supirList as $supir)
                        <option value="{{ $supir->id_supir }}">{{ $supir->nama_supir }}</option>
                    @endforeach
                </select>
            </div> --}}