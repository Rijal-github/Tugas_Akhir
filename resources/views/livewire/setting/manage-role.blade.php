@section('breadcrumb', 'Manage Setting / Setting User')

<div class="container mx-auto p-6">
    <div class="bg-white rounded-xl p-6">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Setting Role</h2>
        <button  wire:click="openCreateModal"  class="flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-transform transform hover:scale-105">
          <i class="fas fa-user-plus mr-2"></i> Create User
        </button>
      </div>
  
      <!-- Table -->
      <div class="overflow-x-auto">
        <table class="min-w-full border-collapse">
          <thead>
            <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
              <th class="py-3 px-6 border">No</th>
              <th class="py-3 px-6 border">Avatar</th>
              <th class="py-3 px-6 border">Role</th>
              <th class="py-3 px-6 border">Email</th>
              <th class="py-3 px-6 border">No. Handphone</th>
              <th class="py-3 px-6 border">Nama</th>
              <th class="py-3 px-6 border">Alamat</th>
              <th class="py-3 px-6 border">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $index => $user)
                <tr class="text-gray-700 text-sm hover:bg-gray-50 transition-all">
                <td class="py-3 px-6 border text-center">{{ $index + 1 }}</td>
                <td class="py-3 px-6 border text-center">
                    {{-- <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-10 h-10 rounded-full mx-auto"> --}}
                </td>
                <td class="py-3 px-6 border text-center">{{ $user->role->name }}</td>
                <td class="py-3 px-6 border text-center">{{ $user->email }}</td>
                <td class="py-3 px-6 border text-center">{{ $user->no_hp }}</td>
                <td class="py-3 px-6 border text-center">{{ $user->name }}</td>
                <td class="py-3 px-6 border text-center">{{ $user->addres }}</td>
                <td class="py-3 px-6 border text-center">
                    <div class="flex justify-center space-x-6">
                      <!-- Update Icon with Tooltip -->
                      <div class="relative group">
                          <button wire:click="openEditModal({{ $user->id }})" class="text-green-500 hover:text-green-600 transition-transform transform hover:scale-110">
                          <i class="fas fa-pen-to-square fa-lg"></i>
                          </button>
                          <div class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs rounded-md py-1 px-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                          Update
                          </div>
                      </div>
                      <!-- Delete Icon with Tooltip -->
                      <div class="relative group">
                          <button wire:click="confirmDelete('{{ $user->id }}')" class="text-red-500 hover:text-red-600 transition-transform transform hover:scale-110">
                          <i class="fas fa-trash fa-lg"></i>
                          </button>
                            <div class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs rounded-md py-1 px-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                              Delete
                            </div>
                          <!-- Modal Popup -->
                          @if ($confirmDelete)
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
                          @endif
                      <!-- Popup Pesan -->
                      @if ($statusMessage)
                          <div class="fixed top-10 right-10 bg-blue-500 text-white px-4 py-2 rounded shadow-lg z-40">
                              {{ $statusMessage }}
                              <button wire:click="$set('statusMessage', null)" class="ml-2 text-sm text-gray-200 hover:text-gray-100">
                                  &times;
                              </button>
                          </div>
                      @endif
                    </div>
                  </div>
                </td>
                </tr>
              @endforeach
            <!-- Tambahkan baris lainnya -->
          </tbody>
        </table>
      </div>
    </div>
    <!-- Modal Background -->
    <div x-data="{showModal: @entangle('showModal'), showSuccess: @entangle('showSuccess'), confirmDelete: @entangle('confirmDelete')}" 
          
          x-show="showModal" 
          x-cloak
          wire:ignore.self
          x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0 scale-95"
          x-transition:leave="transition ease-in duration-150"
          x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opacity-0 scale-95"


        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
      <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-lg relative animate-fade-in-down">
        <!-- Close Button -->
        <button @click="showModal = false; $wire.resetForm()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
    
        
        <!-- Form -->
        <form wire:submit.prevent="save" class="space-y-4">
          <h2 class="text-xl font-bold mb-6">{{ $isEditMode ? 'Edit User' : 'Create New User' }}</h2>
            <div>
              <label class="block text-gray-700 font-semibold mb-2">Avatar</label>
              <input type="file" wire:model="avatar" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
              <label class="block text-gray-700 font-semibold mb-2">Role</label>
              <select wire:model="role" class="form-select border border-gray-300 rounded px-3 py-2 w-full">
                  <option>-- Pilih Role --</option>
                  @foreach ($roles as $r)
                      <option value="{{ $r->id_role }}">{{ $r->name }}</option>
                  @endforeach
              </select>
              @error('role') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>
            <div>
              <label class="block text-gray-700 font-semibold mb-2">Email</label>
              <input type="email" wire:model="email" class="w-full border rounded-lg px-3 py-2" placeholder="Enter Email">
              @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
              <label class="block text-gray-700 font-semibold mb-2">No. Handphone</label>
              <input type="text" wire:model="no_hp" class="w-full border rounded-lg px-3 py-2" placeholder="Enter No. Handphone">
            </div>
            <div>
              <label class="block text-gray-700 font-semibold mb-2">Nama</label>
              <input type="text" wire:model="name" class="w-full border rounded-lg px-3 py-2" placeholder="Enter Name">
              @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
              <label class="block text-gray-700 font-semibold mb-2">Alamat</label>
              <input type="text" wire:model="addres" class="w-full border rounded-lg px-3 py-2" placeholder="Enter Alamat">
              @error('addres') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
              <label class="block text-gray-700 font-semibold mb-2">Password {{ $isEditMode ? '(Kosongkan jika tidak ingin diubah)' : '' }}</label>
              <input type="password" wire:model="password" class="w-full border rounded-lg px-3 py-2" placeholder="Enter Password">
              @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
    
            <div class="flex justify-end pt-4">
              <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg font-bold transition-transform transform hover:scale-105">
                {{ $isEditMode ? 'Update' : 'Create' }}
              </button>
            </div>
        </form>
      </div>
        <!-- Popup Pesan Berhasil -->
        <div x-show="showSuccess" class="ctr-mainPopup fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
          <div class="cMainPopup relative p-5 bg-white rounded-md shadow-lg w-full max-w-lg">
              <div class="TitleHeadPopup text-center">
                  <p class="text-xl font-semibold text-green-500">Your Data Profile  Add Sucesfully!</p>
                  <button @click="showSuccess = false" class="mt-5 bg-blue-500 hover:bg-blue-700 text-white font-semibold p-2 rounded-md">Close</button>
              </div>
          </div>
        </div>
    </div>

    <style>
      @keyframes fade-in-down {
        from {
          opacity: 0;
          transform: translateY(-20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      .animate-fade-in-down {
        animation: fade-in-down 0.5ms ease-out;
      }
    </style>
</div>
  