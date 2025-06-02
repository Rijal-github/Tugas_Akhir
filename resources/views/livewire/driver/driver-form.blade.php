<div x-data="{ showModal: @entangle('showModal') }, { show: false }">

<!-- Trigger -->
    {{-- <button wire:click="openModal"
        class="flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-transform transform hover:scale-105">
        <i class="fas fa-user-plus mr-2"></i> Tambah Driver
    </button> --}}
    <div class="relative group">
        <button wire:click="openModal" class="text-blue-500 hover:text-blue-600 transition-transform transform hover:scale-110 bg-blue-100 border border-slate-200 p-1 rounded-full">
            <i class="fas fa-user-plus fa-lg"></i>
        </button>
        <div class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs rounded-md py-1 px-3 opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
            Tambah
        </div>
    </div>

    <!-- Modal -->
    <div x-show="showModal" 
         x-transition 
         x-on:show-success-message.window="show = true"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
         style="display: none;">
        <div @click.outside="showModal = false"
            class="bg-white w-full max-w-md rounded-xl p-6 shadow-lg relative">
            <h2 class="text-xl font-semibold mb-4">Tambah Driver Baru</h2>

            <form wire:submit.prevent="save">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input wire:model.defer="nama_supir" type="text"
                        class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('nama_supir') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input wire:model.defer="password" type="text"
                        class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input wire:model.defer="email" type="email"
                        class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
                    <input wire:model.defer="no_hp" type="text"
                        class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('no_hp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" @click="showModal = false"
                        class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400 text-gray-800">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- <div x-show="show" class="fixed top-0 right-0 p-4 bg-green-500 text-white rounded">
        Data berhasil disimpan!
    </div> --}}
</div>

