
@section('breadcrumb', 'Data UPTD')

<div x-data="{ showModal: @entangle('showModal') }" class="p-5 mr-5">
    <div class="p-3 bg-white rounded-lg shadow-md">
        <div class="mb-4 flex items-center justify-between">
            <div class="relative inline-block">
                <!-- Filter Button -->
                <div id="filterToggle" class="flex justify-between items-center mb-2">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium px-3 py-1 rounded-md flex items-center gap-2">
                    <i class="fas fa-sort text-lg"></i>
                    Filter
                    </button>
                </div>
                <!-- Dropdown Filter -->
                <div id="filterDropdown" class="absolute top-full left-0 z-10 w-40 bg-white border border-gray-300 rounded shadow-md hidden">
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
                </div>
            </div>
            <button wire:click="openCreateForm"  class="flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1 px-3 rounded-lg">
                <i class="fas fa-user-plus mr-2"></i> 
                Tambah 
            </button>
        </div>

        <!-- Alpine.js Modal -->
        <div>
            <!-- Tombol tambah sudah ada di atas dengan @click="open = true" -->

            <!-- Modal -->
            <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
                <div @click.away="open = false" class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg">
                    <button @click="showForm = false; $wire.resetForm()" class="absolute top-3 right-3 text-gray-600 hover:text-gray-800 text-xl">&times;</button>
                    <h2 class="text-lg font-semibold mb-4">Tambah Data Kendaraan</h2>
                    <form wire:submit.prevent="store">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Nama Supir</label>
                            <input type="text" name="nama_supir" class="w-full border rounded px-3 py-2 mt-1" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">No. Polisi</label>
                            <input type="text" name="no_polisi" class="w-full border rounded px-3 py-2 mt-1" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Jenis Kendaraan</label>
                            <select name="jenis_kendaraan" class="w-full border rounded px-3 py-2 mt-1" required>
                                <option value="Amroll Truck">Amroll Truck</option>
                                <option value="Dump Truck">Dump Truck</option>
                                <option value="APV">APV</option>
                                <option value="Roda Tiga">Roda Tiga</option>
                                <option value="Truck">Truck</option>
                                <option value="Pick Up">Pick Up</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Kapasitas Angkutan</label>
                            <input type="number" name="kapasitas_angkutan" class="w-full border rounded px-3 py-2 mt-1" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Wilayah</label>
                            <input type="text" name="wilayah" class="w-full border rounded px-3 py-2 mt-1" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Keterangan</label>
                            <textarea name="keterangan" class="w-full border rounded px-3 py-2 mt-1"></textarea>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
                            <button type="button" @click="showModal = false; $wire.resetForm()" class="text-gray-500">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
        @if(session()->has('message'))
            <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
                {{ session('message') }}
            </div>
         @endif
        <div class="overflow-x-auto border-b">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-3 py-3 text-left">Nama Supir</th>
                        <th class="px-3 py-3 text-left">No. Polisi</th>
                        <th class="px-3 py-3 text-left">Jenis Kendaraan</th>
                        <th class="px-3 py-3 text-center">Kapasitas Angkutan</th>
                        <th class="px-3 py-3 text-left">Wilayah</th>
                        <th class="px-3 py-3 text-left">Keterangan</th>
                        <th class="px-3 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-800 space-y-2">
                    {{-- @foreach($kendaraanList as $k) --}}
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-3 font-medium">Agus Salim</td>
                        <td class="px-3 py-3"></td>
                        <td class="px-3 py-3"></td>
                        <td class="px-3 py-3 text-center"></td>
                        <td class="px-3 py-3"></td>
                        <td class="px-3 py-3"></td>
                        <td class=" py-3 text-center">
                            <div class="flex justify-center space-x-6">
                              <!-- Update Icon with Tooltip -->
                              <div class="relative group">
                                  <button wire:click="#)" class="text-green-500 hover:text-green-600 transition-transform transform hover:scale-110">
                                  <i class="fas fa-pen-to-square fa-lg"></i>
                                  </button>
                                  <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs rounded-md py-1 px-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                                  Update
                                  </div>
                              </div>
                              <!-- Delete Icon with Tooltip -->
                              <div class="relative group">
                                  <button wire:click="#" class="text-red-500 hover:text-red-600 transition-transform transform hover:scale-110">
                                  <i class="fas fa-trash fa-lg"></i>
                                  </button>
                                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs rounded-md py-1 px-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                                        Delete
                                    </div>
                              </div>
                            </div>
                        </td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>

            {{-- Modal Form --}}
            {{-- @if($showModal) --}}
                {{-- @include('livewire.uptd.form-uptd') --}}
            {{-- @endif --}}

            {{-- Konfirmasi Hapus --}}
            @if($confirmingDelete)
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg p-6 max-w-sm w-full">
                        <p class="mb-4">Yakin ingin menghapus data ini?</p>
                        <div class="flex justify-end gap-2">
                            <button wire:click="delete" class="bg-red-600 text-white px-4 py-2 rounded">Ya</button>
                            <button wire:click="$set('confirmingDelete', false)" class="text-gray-500">Batal</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!-- Pagination -->
      <div class="flex justify-end mt-4">
        <nav class="inline-flex rounded-md shadow-sm overflow-hidden" aria-label="Pagination">
          <button class="px-3 py-1 text-sm bg-white border border-gray-300 hover:bg-gray-100">&lt;</button>
          <button class="px-3 py-1 text-sm bg-indigo-600 text-white font-semibold">1</button>
          <button class="px-3 py-1 text-sm bg-white border border-gray-300 hover:bg-gray-100">2</button>
          <button class="px-3 py-1 text-sm bg-white border border-gray-300 hover:bg-gray-100">3</button>
          <span class="px-3 py-1 text-sm bg-white border border-gray-300">...</span>
          <button class="px-3 py-1 text-sm bg-white border border-gray-300 hover:bg-gray-100">40</button>
          <button class="px-3 py-1 text-sm bg-white border border-gray-300 hover:bg-gray-100">&gt;</button>
        </nav>
      </div>
    </div>    
</div>

<script src="{{ asset('storage/assets/Dashboard/sortir.js') }}"></script>
