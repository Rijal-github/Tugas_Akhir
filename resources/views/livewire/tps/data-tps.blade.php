@section('breadcrumb', 'Data TPS')

<div x-data="{ showForm: @entangle('showForm'), showDetailPopup: @entangle('showDetailPopup'), showDetailPopup: false, show: true, 'overflow-hidden' : '' }" 
      x-effect="document.body.classList.toggle('overflow-hidden', showDetailPopup)"
      class="flex flex-col w-full p-6 bg-[#e8f0fe] min-h-screen">
    <!-- Header -->
    <h1 class="text-2xl font-bold text-slate-800 mb-4">Data TPS</h1>
  
    <!-- Card Container -->
    <div class="bg-white rounded-xl p-4 shadow-md">
      
      {{-- <div class="flex justify-between items-center mb-4">
        <button wire:click="openCreateForm" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-md flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L14 13.414V20a1 1 0 01-1.447.894l-4-2A1 1 0 018 18v-4.586L3.293 6.707A1 1 0 013 6V4z" />
          </svg>
          Tambah
        </button>
      </div> --}}
      <!-- Table -->
      <div class="">
        <table class="w-full text-sm text-left border-collapse">
          <thead>
            <tr class="border-b border-slate-200 text-slate-500 font-semibold">
              <th class="py-2 px-3">Jenis TPS</th>
              <th class="py-2 px-3">Tahun</th>
              <th class="py-2 px-3">Lokasi</th>
              <th class="py-2 px-3">Keterangan</th>
              <th class="py-2 px-3 text-center">Action</th>
            </tr>
          </thead>
          <tbody class="border-b text-slate-700">
            @forelse ($tpsList as $tps)
                <tr>
                    <td class="py-2 px-3">{{ $tps->jenis_tps }}</td>
                    <td class="py-2 px-3">{{ $tps->tahun }}</td>
                    <td class="py-2 px-3">{{ $tps->lokasi }}</td>
                    <td class="py-2 px-3">{{ $tps->keterangan }}</td>
                    <td class="py-3 text-center">
                      <div class="flex justify-center space-x-6">
                          <!-- View -->
                          <div class="relative group">
                              <button wire:click.prevent="showDetail({{ $tps->id }})" class="text-blue-500 hover:text-blue-600 transition-transform transform hover:scale-110">
                                  <i class="fas fa-eye fa-lg"></i>
                              </button>
                              <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs rounded-md py-1 px-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                                  View
                              </div>
                          </div>
                  
                          <!-- Update -->
                          <div class="relative group">
                              <button wire:click="edit({{ $tps->id }})" class="text-green-500 hover:text-green-600 transition-transform transform hover:scale-110">
                                  <i class="fas fa-pen-to-square fa-lg"></i>
                              </button>
                              <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs rounded-md py-1 px-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                                  Update
                              </div>
                          </div>
                  
                          <!-- Delete -->
                          <div class="relative group">
                              <button wire:click="confirmDelete({{ $tps->id }})" class="text-red-500 hover:text-red-600 transition-transform transform hover:scale-110">
                                  <i class="fas fa-trash fa-lg"></i>
                              </button>
                              <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs rounded-md py-1 px-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                                  Delete
                              </div>
                          </div>
                      </div>
                  </td>                  
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-4">Belum ada data TPS.</td>
                </tr>
            @endforelse
        </tbody>
        </table> 
      </div>
      {{-- FORM ADD / EDIT --}}
        @if ($showForm)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl p-6 w-full max-w-lg relative">
                <h2 class="text-xl font-semibold mb-4">{{ $formTitle }}</h2>
                
                <form wire:submit.prevent="save">
                    <div class="space-y-3">
                        <!-- Upload Foto -->
                        <div>
                            <label class="block text-sm text-gray-600">Upload Foto</label>
                            <input type="file" wire:model="foto_tps" class="w-full border p-2 rounded" accept="image/*">

                            @if ($old_foto && !$foto_tps)
                                <p class="text-sm mt-1">Foto saat ini: <span class="text-blue-600">{{ $old_foto }}</span></p>
                            @endif

                            @if ($foto_tps)
                                <p class="text-sm mt-1 text-green-600">Foto baru: {{ $foto_tps->getClientOriginalName() }}</p>
                            @endif
                        </div>

                        <!-- Dropdown UPTD -->
                        <label>Pilih UPTD</label>
                            <select wire:model="id_uptd" class="w-full border p-2 rounded">
                                <option value="">-- Pilih UPTD --</option>
                                @foreach ($uptds as $uptd)
                                    <option value="{{ $uptd->id_uptd }}">{{ $uptd->nama_uptd }}</option>
                                @endforeach
                            </select>
                        @error('id_uptd') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                        <!-- Input lainnya -->
                        <input type="text" wire:model="nama" class="w-full border p-2 rounded" placeholder="Nama TPS">
                        <input type="number" wire:model="tahun" class="w-full border p-2 rounded" placeholder="Tahun">
                        <input type="text" wire:model="jenis_tps" class="w-full border p-2 rounded" placeholder="Jenis TPS">
                        <input type="text" wire:model="lokasi" class="w-full border p-2 rounded" placeholder="Lokasi">
                        <input type="text" wire:model="latitude" class="w-full border p-2 rounded" placeholder="Latitude">
                        <input type="text" wire:model="longitude" class="w-full border p-2 rounded" placeholder="Longitude">
                        <input type="text" wire:model="keterangan" class="w-full border p-2 rounded" placeholder="Keterangan">
                    </div>

                    <!-- Tombol -->
                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                        <button type="button" wire:click="$set('showForm', false)" class="text-gray-500 px-4 py-2">Batal</button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        @if ($showConfirmDelete)
        <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg max-w-sm w-full">
                <h3 class="text-lg font-semibold text-center mb-4">Yakin ingin menghapus data ini?</h3>
                <div class="flex justify-center gap-4">
                    <button wire:click="delete" class="bg-red-600 text-white px-4 py-2 rounded">Ya, Hapus</button>
                    <button wire:click="$set('showConfirmDelete', false)" class="text-gray-600 px-4 py-2">Batal</button>
                </div>
            </div>
        </div>
        @endif

        {{-- NOTIFIKASI --}}
        @if (session()->has('success'))
            <div 
            x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-show="show"
                x-transition
            class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-md z-50">
                {{ session('success') }}
                <button wire:click="closeNotification" class="ml-2 text-white font-bold">×</button>
            </div>
        @endif

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