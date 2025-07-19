<div class="ctr-detailUptd p-6 mr-6 bg-gradient-to-b from-blue-200 to-slate-100 rounded-lg shadow-md">
    <div class="cDetailUptd">
        <div class="Back">
            <a href="{{ route('data-uptd') }}" class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition mb-4">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <!-- Foto UPTD -->
        <div class="flex justify-center mb-4">
            <img src="{{ asset('storage/' . $uptd->foto_uptd) }}" class="w-[23rem] h-[23rem] object-cover rounded-lg shadow-lg border border-gray-200">
        </div>
        <!-- Informasi UPTD -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold">{{ $uptd->nama_uptd }}</h2>
            <p class="text-gray-600">{{ $uptd->alamat_uptd }}</p>
            <p class="text-sm text-gray-500 mt-2">Unit Pelaksana Teknis Dinas Kebersihan Kabupaten Indramayu</p>
        </div>
        <!-- Button Tambah Driver -->
        <div class="flex justify-end mb-4">
            <button wire:click="$set('showDriverModal', true)" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Tambah Driver
            </button>
        </div>

       {{-- Tabel Driver --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3">Nama</th>
                        <th class="p-3">No HP</th>
                        <th class="p-3">Jenis Kendaraan</th>
                        <th class="p-3">No Polisi</th>
                        <th class="p-3 text-center">Kapasitas</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($drivers as $vehicle)
                        <tr class="border-t">
                            <td class="p-3">{{ $vehicle->driver->name ?? '-' }}</td>
                            <td class="p-3">{{ $vehicle->driver->no_hp ?? '-' }}</td>
                            <td class="p-3">{{ $vehicle->jenis_kendaraan }}</td>
                            <td class="p-3">{{ $vehicle->no_polisi }}</td>
                            <td class="p-3 text-center">{{ $vehicle->kapasitas_angkutan }} Kg</td>
                            <td class="p-3 text-center flex gap-3 justify-center">
                                <button wire:click="editDriver({{ $vehicle->id }})"
                                        class="text-green-600 hover:text-green-800">
                                    <i class="fas fa-pen-to-square"></i>
                                </button>
                                <button wire:click="confirmDeleteDriver({{ $vehicle->id }})"
                                        class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-500">Belum ada driver</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $drivers->links() }}
            </div>
        </div>

       {{-- Modal Form Tambah/Edit Driver --}}
        @if ($showDriverModal)
            <div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="bg-white rounded-lg p-6 w-full max-w-2xl shadow-lg relative">

                    <button wire:click="$set('showDriverModal', false)"
                            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                        &times;
                    </button>

                    <h3 class="text-lg font-semibold mb-4">
                        {{ $id_driver ? 'Edit Driver' : 'Tambah Driver' }}
                    </h3>

                    <form wire:submit.prevent="storeDriver" class="space-y-4">
                        {{-- Dropdown Pilih User --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">Pilih User</label>
                            <select wire:model="selected_user_id" class="w-full border rounded p-2">
                                <option value="">-- Pilih User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('selected_user_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        {{-- Jenis Kendaraan --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">Jenis Kendaraan</label>
                            <select wire:model="jenis_kendaraan" class="w-full border rounded px-3 py-2 mt-1" required>
                                <option value="Amroll Truck">Amroll Truck</option>
                                <option value="Dump Truck">Dump Truck</option>
                                <option value="APV">APV</option>
                                <option value="Roda Tiga">Roda Tiga</option>
                                <option value="Truck">Truck</option>
                                <option value="Pick Up">Pick Up</option>
                            </select>
                            {{-- <input type="text" wire:model="jenis_kendaraan" class="w-full border rounded p-2"> --}}
                        </div>

                        {{-- No Polisi --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">No Polisi</label>
                            <input type="text" wire:model="no_polisi" class="w-full border rounded p-2">
                        </div>

                        {{-- Kapasitas Angkut --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">Kapasitas Angkut (kg)</label>
                            <input type="number" wire:model="kapasitas_angkutan" class="w-full border rounded p-2">
                        </div>

                        {{-- Submit --}}
                        <div x-data>
                            <div class="flex justify-end gap-3">
                                <button type="button" @click="$wire.set('showDriverModal', false); $wire.resetDriverForm()"
                                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                    Batal
                                </button>
                                <button type="submit"
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
