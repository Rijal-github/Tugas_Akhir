@section('breadcrumb', 'Manage Setting / Setting Role')


<div class="p-6 bg-white rounded-xl">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Manage Roles</h2>
        <button wire:click="openCreateModal" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Role</button>
    </div>

    <!-- Tabel Role -->
    <table class="w-full border mt-4 text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Role Name</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $index => $role)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ $role->name }}</td>
                    <td class="border px-4 py-2 text-center space-x-3">
                        <button wire:click="openEditModal({{ $role->id }})" class="text-green-500 hover:text-green-600"><i class="fas fa-edit"></i></button>
                        <button wire:click="delete({{ $role->id }})" class="text-red-500 hover:text-red-600"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg">
                <h3 class="text-lg font-bold mb-4">{{ $isEdit ? 'Edit Role' : 'Create Role' }}</h3>
                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role Name</label>
                        <input type="text" wire:model.defer="name" class="w-full border px-3 py-2 rounded" placeholder="Enter Role Name">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" wire:click="$set('showModal', false)" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">{{ $isEdit ? 'Update' : 'Create' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>


{{-- <div x-data="{ showEdit: @entangle('showEdit'), showDelete: @entangle('showDelete')}" class="p-6">
    <h2 class="text-xl font-semibold mb-4">Manage Roles</h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6">
        <input type="text" wire:model="name" placeholder="Nama Role" class="border px-3 py-2 rounded w-64">
        <button wire:click="save" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">+ Tambah Role</button>
        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- List Roles -->
    <table class="min-w-full text-left border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">No</th>
                <th class="px-4 py-2 border">Nama Role</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $index => $role)
                <tr>
                    <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border">{{ $role->name }}</td>
                    <td class="py-3 px-6 border text-center">
                        <div class="flex justify-center space-x-6">
                          <!-- Update Icon with Tooltip -->
                          <div class="relative group">
                              <button @click="showEdit = true" wire:click="edit({{ $role->id }})" class="text-green-500 hover:text-green-600 transition-transform transform hover:scale-110">
                              <i class="fas fa-pen-to-square fa-lg"></i>
                              </button>
                              <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs rounded-md py-1 px-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                              Update
                              </div>
                          </div>
                          <!-- Delete Icon with Tooltip -->
                          <div class="relative group">
                            <button @click="showDelete = true" wire:click="prepareDelete({{ $role->id }})" class="text-red-500 hover:text-red-600 transition-transform transform hover:scale-110">
                            <i class="fas fa-trash fa-lg"></i>
                            </button>
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs rounded-md py-1 px-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                                Delete
                            </div>                          
                        </div>
                      </div>
                    </td>
                </tr>
                @endforeach 
            </tbody>
        </table>

    <!-- Edit Role Section -->
    <div x-show="showEdit" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <h3 class="text-lg font-bold mb-4">Edit Role</h3>

        <form wire:submit.prevent="update">
            @csrf
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">                
                  <div>
                      <label class="block text-sm font-semibold text-slate-600 mb-1">Nama Role</label>
                      <input type="text" wire:model="name" class="w-full px-3 py-2 border rounded-md" required>
                  </div>
              </div>
      
              <div class="mt-6 flex justify-end gap-3">
                <button type="button" @click="showEdit = false" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Simpan</button>
              </div>
          </form>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDelete" @keydown.escape.window="showDelete = false" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div @click.away="showDelete = false" class="bg-white p-6 rounded shadow-md w-full max-w-sm">
            <h3 class="text-lg font-bold mb-4">Hapus Role?</h3>
            <p class="mb-4">Yakin ingin menghapus role ini?</p>
            <div class="flex justify-end space-x-3">
                <button @click="showDelete = false" class="bg-gray-300 px-4 py-2 rounded">Batal</button>
                <button wire:click="confirmDelete" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
            </div>
        </div>
    </div>
        @if ($statusMessage)
        <div class="fixed top-[8rem] right-10 bg-blue-500 text-white px-4 py-2 rounded shadow-lg z-40">
            {{ $statusMessage }}
            <button wire:click="$set('statusMessage', null)" class="ml-2 text-sm text-gray-200 hover:text-gray-100">
                &times;
            </button>
        </div>
        @endif   
    </div> --}}
    
    {{-- @empty
    <tr>
        <td colspan="3" class="text-center text-gray-500 py-4">Belum ada role.</td>
    </tr> --}}


        {{-- @if ($editId)
        <div class="mb-6">
            <input type="text" wire:model="editName" class="border px-3 py-2 rounded w-64">
            <button wire:click="update" class="bg-green-500 text-white px-4 py-2 rounded ml-2">Simpan</button>
            <button wire:click="$reset('editId', 'editName')" class="bg-gray-300 text-gray-800 px-4 py-2 rounded ml-2">Batal</button>
            @error('editName') <p class="text-red-500 text-sm mt-1">{{ $Message }}</p> @enderror
        </div>
    @endif --}}