@section('breadcrumb', 'Setting / Profile')

<div class="min-h-screen p-4 mr-4">
    <div class="mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold">Informasi Profile</h2>
        </div>

        <div class="flex flex-col md:flex-row items-center bg-gray-100 p-4 rounded-lg mb-6">
            <img src="https://avatars.githubusercontent.com/u/9919?s=200&v=4" alt="Avatar"
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
</div>

