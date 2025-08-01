@section('breadcrumb', 'Setting / Profile')

<div class="min-h-screen p-4 mr-4">
    @if ($successMessage)
    <div 
            x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 3000)" 
            x-show="show"
            class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 
               bg-green-100 border border-green-300 text-green-800 
               text-sm px-4 py-2 rounded shadow-lg transition-opacity duration-500">
            {{ $successMessage }}
    </div>
    @endif
    <div class="mx-auto bg-white p-6 rounded-lg shadow-md">

        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-2xl font-semibold">Informasi Profile</h2>
            <button wire:click="toggleEdit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                {{ $isEditing ? 'Batal' : 'Edit Profile' }}
            </button>
        </div>
        <div class="flex flex-col md:flex-row items-center bg-gray-100 p-4 rounded-lg mb-6">
            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://avatars.githubusercontent.com/u/9919?s=200&v=4' }}"
                class="w-24 h-24 rounded-full object-cover mb-4 md:mb-0 md:mr-6">
            <div class="text-center md:text-left">
                <h3 class="text-lg font-semibold">{{ $username }}</h3>
                <p class="text-gray-500">{{ $email }}</p>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-gray-100 p-4 rounded-lg">
                <h4 class="font-bold mb-4">Informasi Kontak</h4>
                <div class="space-y-4 p-3">
                    <div class="flex flex-col md:flex-row bg-white p-2">
                        <div class="md:w-40 font-medium flex">
                            <span>Nomor Telepon</span>
                            <span class="ml-1">:</span>
                        </div>
                        <span class="flex-1">{{ $no_hp }}</span>
                    </div>
                    <div class="flex flex-col md:flex-row bg-white p-2">
                        <div class="md:w-40 font-medium flex">
                            <span>Email</span>
                            <span class="ml-1">:</span>
                        </div>
                        <span class="flex-1">{{ $email }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-gray-100 p-4 rounded-lg">
                <h4 class="font-bold mb-4">Informasi Pengguna</h4>
                <div class="space-y-4 p-3">
                    <div class="flex flex-col md:flex-row bg-white p-2">
                        <div class="md:w-40 font-medium flex">
                            <span>Nama</span>
                            <span class="ml-1">:</span>
                        </div>
                        <span>{{ $name }}</span>
                    </div>
                    <div class="flex flex-col md:flex-row bg-white p-2">
                        <div class="md:w-40 font-medium flex">
                            <span>Tanggal Bergabung</span>
                            <span class="ml-1">:</span>
                        </div>
                        <span>{{ date('d/m/Y', mt_rand(1262055681, time())) }}</span>
                    </div>
                    <div class="flex flex-col md:flex-row bg-white p-2">
                        <div class="md:w-40 font-medium flex">
                            <span>Alamat</span>
                            <span class="ml-1">:</span>
                        </div>
                        <span>{{ $alamat_user }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit Profile -->
    @if($isEditing)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-lg relative">
            <button wire:click="toggleEdit" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-2xl">
                &times;
            </button>
            <h3 class="text-xl font-semibold mb-4">Edit Profile</h3>

            <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <label class="block font-medium">Avatar</label>
                    <input type="file" wire:model="avatar" class="border p-2 w-full rounded">
                    @error('avatar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-medium">Nama</label>
                    <input type="text" wire:model="name" class="border p-2 w-full rounded">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-medium">Email</label>
                    <input type="email" wire:model="email" class="border p-2 w-full rounded">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-medium">Nomor Telepon</label>
                    <input type="text" wire:model="no_hp" class="border p-2 w-full rounded">
                    @error('no_hp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block font-medium">Alamat</label>
                    <textarea wire:model="alamat_user" class="border p-2 w-full rounded" rows="3"></textarea>
                    @error('alamat_user') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="text-right">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>

