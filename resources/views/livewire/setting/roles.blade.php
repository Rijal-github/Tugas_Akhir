@section('breadcrumb', 'Manage Setting / Setting Role')

<div class="p-6">
    <div x-data="{ showModal: @entangle('showModal'), showConfirm: @entangle('konfirmDelete'), show: @entangle('showSuccess'), open: @entangle('konfirmDelete') }" class="mx-auto p-6 bg-white rounded-xl">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold">Manage Roles</h2>
            <button wire:click="$set('showModal', true)" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Role</button>
        </div>
    
        <!-- Tabel Role -->
        <table class="w-full border mt-4 text-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Role Name</th>
                    <th class="border px-4 py-2">Ranah</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $index => $role)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $role->name }}</td>
                        <td class="border px-4 py-2">{{ $role->ranah }}</td>
                        <td class="border px-4 py-2 text-center space-x-3">
                            <button wire:click="openEditModal({{ $role->id }})" class="text-green-500 hover:text-green-600"><i class="fas fa-edit"></i></button>
                            <button wire:click="openDelete({{ $role->id }})" class="text-red-500 hover:text-red-600"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <div x-show="open" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded shadow-md max-w-sm w-full text-center">
                <span class="text-red-600 text-5xl block mb-4 animate-bounce drop-shadow-lg">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </span>
                <p class="text-lg font-semibold mb-4 text-center">Apakah anda yakin ingin menghapus data ROLE ini?</p>
                <div class="flex justify-center gap-4">
                    <button wire:click="Delete" class="bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition duration-200 ease-in-out">
                        <i class="fa-solid fa-trash mr-2"></i> Hapus
                    </button>
                    <button @click="open = false" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-5 py-2 rounded-lg shadow-sm transition duration-200 ease-in-out">
                        <i class="fa-solid fa-xmark mr-2"></i> Batal
                    </button>
                </div>
            </div>
        </div>
    
        <!-- Modal -->
        {{-- @if($showModal) --}}
            <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg">
                    <h3 class="text-lg font-bold mb-4">{{ $isEdit ? 'Edit Role' : 'Create Role' }}</h3>
                    <form wire:submit.prevent="save">
                        {{-- Role Name --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Role Name</label>
                            <input type="text" wire:model.defer="name" class="w-full border px-3 py-2 rounded" placeholder="Enter Role Name">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        {{-- Ranah Select --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ranah</label>
                            <select wire:model="ranah" class="w-full border px-3 py-2 rounded">
                                <option value="">-- Select Ranah --</option>
                                <option value="Website">Website</option>
                                <option value="Mobile">Mobile</option>
                            </select>
                            @error('ranah') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        {{-- Permission List --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Permissions</label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($allPermissions as $permission)
                                    <label class="flex items-center space-x-2">
                                        <input 
                                            type="checkbox" 
                                            wire:model="selectedPermissions" 
                                            value="{{ $permission->id }}" 
                                            class="rounded border-gray-300 text-blue-600"
                                            @if($ranah === 'Mobile') disabled @endif
                                        >
                                        <span class="{{ $ranah === 'Mobile' ? 'text-gray-400' : 'text-black' }}">
                                            {{ $permission->akses }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            @error('selectedPermissions') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex justify-end gap-2">
                            <button type="button" wire:click="$set('showModal', false)" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                {{ $isEdit ? 'Update' : 'Create' }}
                            </button>
                        </div>
                    </form>
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
        {{-- @endif --}}
    </div>

</div>