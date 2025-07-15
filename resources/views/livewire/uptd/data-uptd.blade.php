
@section('breadcrumb', 'Data UPTD')

<div x-data="{ showModal: @entangle('showModal'), showConfirm: @entangle('confirmingDelete'), show: @entangle('showSuccess'), open: @entangle('confirmingDelete') }" class="p-5 mr-5">
    <div class="p-3 bg-white rounded-lg shadow-md">
        <div class="mb-4 flex items-center justify-between">
            <div class="relative inline-block">
                <!-- Filter Button -->
                {{-- <div id="filterToggle" class="flex justify-between items-center mb-2">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium px-3 py-1 rounded-md flex items-center gap-2">
                    <i class="fas fa-sort text-lg"></i>
                    Filter
                    </button>
                </div> --}}
                <div class="text-xl font-semibold ml-3">
                    <h1>List Data UPTD</h1>
                </div>
                
                {{-- <div id="filterDropdown" class="absolute top-full left-0 z-10 w-40 bg-white border border-gray-300 rounded shadow-md hidden">
                    <ul class="text-sm text-gray-700">
                        <li>
                            <button class="w-full text-left px-4 py-2 hover:bg-blue-100" data-filter="all">Semua</button>
                        </li>
                        <li>
                            <button class="w-full text-left px-4 py-2 hover:bg-gray-100" data-filter="Amroll Truck">Amroll Truck</button>
                        </li>
                        <li>
                            <button class="w-full text-left px-4 py-2 hover:bg-gray-100" data-filter="Dump Truck">Dump Truck</button>
                        </li>
                        <li>
                            <button class="w-full text-left px-4 py-2 hover:bg-gray-100" data-filter="APV">APV</button>
                        </li>
                        <li>
                            <button class="w-full text-left px-4 py-2 hover:bg-gray-100" data-filter="Roda Tiga">Roda Tiga</button>
                        </li>
                        <li>
                            <button class="w-full text-left px-4 py-2 hover:bg-gray-100" data-filter="Truck">Truck</button>
                        </li>
                        <li>
                            <button class="w-full text-left px-4 py-2 hover:bg-gray-100" data-filter="Pick Up">Pick Up</button>
                        </li>
                    </ul>
                </div> --}}
            </div>
            <button wire:click="$set('showModal', true)" class="flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1 px-3 rounded-lg">
                <i class="fas fa-user-plus mr-2"></i> 
                Tambah 
            </button>
        </div>

        <!-- Alpine.js Modal -->
        <div>
            <!-- Modal -->
            <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg">
                    <button class="absolute top-3 right-3 text-gray-600 hover:text-gray-800 text-xl"></button>
                    <h2 class="text-lg font-semibold mb-4">Tambah Data Kendaraan</h2>
                    <form wire:submit.prevent="store">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Nama UPTD</label>
                            <input type="text" wire:model="nama_uptd" class="w-full border rounded px-3 py-2 mt-1" required>
                            @error('nama_uptd') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Alamat UPTD</label>
                            <input type="text" wire:model="alamat_uptd" class="w-full border rounded px-3 py-2 mt-1" required>
                            @error('alamat_uptd') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Foto UPTD</label>
                            <input type="file" wire:model="foto_uptd" class="w-full border rounded px-3 py-2 mt-1" required>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
                            <button type="button"  @click="showModal = false; $wire.resetFields()" class="text-white bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded">Batal</button>
                        </div>
                    </form>

                        {{-- <div class="mb-4">
                            <label class="block text-sm font-medium">Driver</label>
                            <select wire:model="driver_id" class="w-full border rounded px-3 py-2 mt-1" required>
                                <option value="">-- Pilih Driver --</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        {{-- <div class="mb-4">
                            <label class="block text-sm font-medium">Jenis Kendaraan</label>
                            <select wire:model="jenis_kendaraan" class="w-full border rounded px-3 py-2 mt-1" required>
                                <option value="Amroll Truck">Amroll Truck</option>
                                <option value="Dump Truck">Dump Truck</option>
                                <option value="APV">APV</option>
                                <option value="Roda Tiga">Roda Tiga</option>
                                <option value="Truck">Truck</option>
                                <option value="Pick Up">Pick Up</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">No. Polisi</label>
                            <input type="text" wire:model="no_polisi" class="w-full border rounded px-3 py-2 mt-1" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Kapasitas Angkutan</label>
                            <input type="number" wire:model="kapasitas_angkutan" class="w-full border rounded px-3 py-2 mt-1" required>
                        </div> --}}
                     
                    
                </div>
            </div>
        </div>

        {{-- popup Success --}}
        <div x-show="show" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm mx-auto">
                <div class="text-center">
                    <svg class="w-12 h-12 mx-auto text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="mt-4 text-lg font-semibold text-gray-700">{{ $successMessage }}</p>
                    <button @click="show = false" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">Tutup</button>
                </div>
            </div>
        </div>
    
        <div class="overflow-x-auto border-b">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-3 py-3 text-center">Foto UPTD</th>
                        <th class="px-3 py-3 text-right">Nama UPTD</th>
                        <th class="px-3 py-3 text-center">Alamat UPTD</th>
                        <th class="px-3 py-3">Action</th>
                    </tr>
                </thead>
                @foreach ($uptds as $uptd)
                    <tbody class="divide-y divide-gray-200 text-gray-800 space-y-2">
                        <tr class="hover:bg-gray-50">
                            <td class="text-center align-middle">
                                @if ($uptd->foto_uptd)
                                    <img src="{{ asset('storage/' . $uptd->foto_uptd) }}" alt="Foto UPTD" class="w-10 h-10 object-cover rounded-md mx-auto">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-right pl-8">{{ $uptd->nama_uptd }}</td>
                            <td class="text-center">{{ $uptd->alamat_uptd }}</td>
                            <td class="py-3 text-center">
                                <div class="flex justify-center space-x-6">
                                    <div class="relative group">
                                        <button wire:click="editForm({{ $uptd->id_uptd }})" class="text-green-500 hover:text-green-600 transition-transform transform hover:scale-110">
                                            <i class="fas fa-pen-to-square fa-lg"></i>
                                        </button>
                                        <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs rounded-md py-1 px-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                                            Update
                                        </div>
                                    </div>
                                    <div class="relative group">
                                        <button wire:click="confirmDelete({{ $uptd->id_uptd }})" class="text-red-500 hover:text-red-600 transition-transform transform hover:scale-110">
                                            <i class="fas fa-trash fa-lg"></i>
                                        </button>
                                        <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs rounded-md py-1 px-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                                            Delete
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>

        <div x-show="open" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded shadow-md max-w-sm w-full text-center">
                <span class="text-red-600 text-5xl block mb-4 animate-bounce drop-shadow-lg">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </span>
                <p class="text-lg font-semibold mb-4 text-center">Apakah anda yakin ingin menghapus data UPTD ini?</p>
                <div class="flex justify-center gap-4">
                    <button wire:click="destroy" class="bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition duration-200 ease-in-out">
                        <i class="fa-solid fa-trash mr-2"></i> Hapus
                    </button>
                    <button @click="open = false" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-5 py-2 rounded-lg shadow-sm transition duration-200 ease-in-out">
                        <i class="fa-solid fa-xmark mr-2"></i> Batal
                    </button>
                </div>
            </div>
        </div>
        <!-- Pagination -->
      <div class="flex justify-end mt-4">
        {{-- <nav class="inline-flex rounded-md shadow-sm overflow-hidden" aria-label="Pagination">
          <button class="px-3 py-1 text-sm bg-white border border-gray-300 hover:bg-gray-100">&lt;</button>
          <button class="px-3 py-1 text-sm bg-indigo-600 text-white font-semibold">1</button>
          <button class="px-3 py-1 text-sm bg-white border border-gray-300 hover:bg-gray-100">2</button>
          <button class="px-3 py-1 text-sm bg-white border border-gray-300 hover:bg-gray-100">3</button>
          <span class="px-3 py-1 text-sm bg-white border border-gray-300">...</span>
          <button class="px-3 py-1 text-sm bg-white border border-gray-300 hover:bg-gray-100">40</button>
          <button class="px-3 py-1 text-sm bg-white border border-gray-300 hover:bg-gray-100">&gt;</button>
        </nav> --}}
        {{ $uptds->links() }}
      </div>
    </div>    
</div>

<script src="{{ asset('storage/assets/Dashboard/sortir.js') }}"></script>
