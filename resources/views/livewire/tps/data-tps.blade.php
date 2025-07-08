{{-- @extends('layouts.app') --}}

@section('breadcrumb', 'Data TPS')

{{-- @section('content') --}}

<div x-data="{ showForm: @entangle('showForm'), showDetailPopup: @entangle('showDetailPopup'), showDetailPopup: false }" 
      x-effect="document.body.classList.toggle('overflow-hidden', showDetailPopup)"
      class="flex flex-col w-full p-6 bg-[#e8f0fe] min-h-screen">
    <!-- Header -->
    <h1 class="text-2xl font-bold text-slate-800 mb-4">Data TPS</h1>
  
    <!-- Card Container -->
    <div class="bg-white rounded-xl p-4 shadow-md">
      
      <!-- Filter Button -->
      <div class="flex justify-between items-center mb-4">
        <button wire:click="openCreateForm" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-md flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L14 13.414V20a1 1 0 01-1.447.894l-4-2A1 1 0 018 18v-4.586L3.293 6.707A1 1 0 013 6V4z" />
          </svg>
          Tambah
        </button>
      </div>
      <!-- Table -->
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse">
          <thead>
            <tr class="border-b border-slate-200 text-slate-500 font-semibold">
              <th class="py-2 px-3">Jenis TPS</th>
              <th class="py-2 px-3">Tahun</th>
              <th class="py-2 px-3">Jumlah</th>
              <th class="py-2 px-3">Lokasi</th>
              <th class="py-2 px-3">Unit</th>
              <th class="py-2 px-3 text-center">Action</th>
            </tr>
          </thead>
          <tbody class="border-b text-slate-700">
            <!-- Row 1 -->
            {{-- @foreach ($lokasi_unit as $lokasi) --}}
            {{-- Baris pertama --}}
            @foreach ($dataTps as $tps)
              @foreach ($tps->lokasi as $lokasi)
                <tr class="border-t border-slate-200">
                  <td class="py-2 px-3">{{ $tps->jenis_tps }}</td>
                  <td class="py-2 px-3 text-blue-500">{{ $tps->tahun }}</td>
                  <td class="py-2 px-3">
                    <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded">{{ $tps->jumlah }}</span>
                  </td>
                  <td class="py-2 px-3">{{ $lokasi->nama_lokasi }}</td>
                  <td class="py-2 px-3">
                    <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded">{{ $lokasi->unit }}</span>
                  </td>
                  <td class="py-3 px-6 text-center">
                    <div class="flex justify-center space-x-6">
                       <!-- view Icon with Tooltip -->
                       <div class="relative group">
                          <button @click="showDetailPopup = true" class="text-blue-500 hover:text-blue-600 transition-transform transform hover:scale-110">
                          <i class="fas fa-eye fa-lg"></i>
                          </button>
                          <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs rounded-md py-1 px-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                          View
                          </div>
                      </div>
                      <!-- Update Icon with Tooltip -->
                      <div class="relative group">
                          <button wire:click="edit({{ $tps->id }})" class="text-green-500 hover:text-green-600 transition-transform transform hover:scale-110">
                          <i class="fas fa-pen-to-square fa-lg"></i>
                          </button>
                          <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs rounded-md py-1 px-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                          Update
                          </div>
                      </div>
                      <!-- Delete Icon with Tooltip -->
                      <div class="relative group">
                          <button wire:click="delete({{ $tps->id }})" class="text-red-500 hover:text-red-600 transition-transform transform hover:scale-110">
                          <i class="fas fa-trash fa-lg"></i>
                          </button>
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs rounded-md py-1 px-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                              Delete
                            </div>
                            <!-- Modal Popup -->
                            {{-- @if ($confirmDeleteOpen)
                              <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-20">
                                  <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
                                      <h3 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h3>
                                      <p>Apakah Anda yakin ingin menghapus profil ini?</p>
                                      <div class="flex justify-end mt-6">
                                          <button wire:click="cancelDelete" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2">
                                              Batal
                                          </button>
                                          <button wire:click="delete('{{ $user->id  }}')" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                              Hapus
                                          </button>
                                      </div>
                                  </div>
                              </div>
                            @endif --}}
                        <!-- Popup Pesan -->
                        {{-- @if ($statusMessage)
                            <div class="fixed top-10 right-10 bg-blue-500 text-white px-4 py-2 rounded shadow-lg z-40">
                                {{ $statusMessage }}
                                <button wire:click="$set('statusMessage', null)" class="ml-2 text-sm text-gray-200 hover:text-gray-100">
                                    &times;
                                </button>
                            </div>
                        @endif --}}
                      </div>
                      </div>
                  </td>
                </tr>
                {{-- <tr class="border-t border-slate-200">
                    <td class="py-2 px-3"></td>
                    <td class="py-2 px-3 text-blue-500"></td>
                    <td class="py-2 px-3">
                    <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded"></span>
                    </td>
                    <td class="py-2 px-3"></td>
                    <td class="py-2 px-3">
                    <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded">
                        
                    </span>
                    </td>
                </tr>

                {{-- Baris berikutnya --}}
{{--                 
                    <tr class="border-slate-200">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="py-2 px-3"></td>
                        <td class="py-2 px-3">
                            <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded">
                            
                            </span>
                        </td>
                    </tr>      --}}
               @endforeach
            @endforeach
          </tbody>
        </table> 
      </div>
      <div x-show="showForm"
          class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
          {{-- x-transition:enter="transition ease-out duration-100"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          x-transition:leave="transition ease-in duration-100"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"> --}}
        <div class="bg-white p-4 rounded-lg shadow mb-6">
          <button @click="showForm = false; $wire.resetForm()" class="absolute top-3 right-3 text-gray-600 hover:text-gray-800 text-xl">&times;</button>
    
          <form wire:submit.prevent="save">
            @csrf
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <div>
                      <label class="block text-sm font-semibold text-slate-600 mb-1">Jenis TPS</label>
                      <select wire:model="jenis_tps" class="w-full px-3 py-2 border rounded-md" required>
                        <option value="" disabled selected>Pilih Jenis TPS</option>
                        <option value="Landasan Kontainer">Landasan Kontainer</option>
                        <option value="Landasan Beratap">Landasan Beratap</option>
                        <option value="TPS Kecil">TPS Kecil</option>
                      </select>
                  </div>
                  <div>
                      <label class="block text-sm font-semibold text-slate-600 mb-1">Tahun</label>
                      <input type="number" wire:model="tahun" class="w-full px-3 py-2 border rounded-md" required>
                  </div>
                  <div>
                      <label class="block text-sm font-semibold text-slate-600 mb-1">Jumlah</label>
                      <input type="number" wire:model="jumlah" class="w-full px-3 py-2 border rounded-md" required>
                  </div>
              </div>
      
              <div class="mt-4">
                  <label class="block text-sm font-semibold text-slate-600 mb-2">Lokasi & Unit</label>
                  @foreach ($lokasi_unit as $index => $lokasi)
                  <div  wire:key="lokasi-{{ $index }}" class="grid grid-cols-1 md:grid-cols-4 gap-2 mb-2">
                      <input type="text" wire:model="lokasi_unit.{{ $index }}.nama_lokasi" placeholder="Lokasi" class="px-2 py-1 border rounded-md">
                      <input type="text" wire:model="lokasi_unit.{{ $index }}.unit" placeholder="Unit" class="px-2 py-1 border rounded-md">
                      <input type="text" wire:model="lokasi_unit.{{ $index }}.latitude" placeholder="Latitude" class="px-2 py-1 border rounded-md">
                      <input type="text" wire:model="lokasi_unit.{{ $index }}.longitude" placeholder="Longitude" class="px-2 py-1 border rounded-md">
                      <button type="button" wire:click="removeLocation({{ $index }})" class="text-red-600">Hapus</button>
                  </div>
                  @endforeach
                  <button type="button" wire:click="addLocation" class="text-blue-600 text-sm mt-1">+ Tambah Lokasi</button>
              </div>
      
              <div class="mt-6 flex justify-end gap-3">
                <button type="button" @click="showForm = false; $wire.resetForm()" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Simpan</button>
              </div>
          </form>
        </div>
      </div>

      <!-- Include Popup Detail -->
      @include('livewire.tps.popup-detail-tps')

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

{{-- @endsection --}}