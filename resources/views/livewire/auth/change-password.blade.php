<div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-blue-400 to-slate-200 p-4">
    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md">
        <div class="icon-contain flex items-center justify-center mb-3">
            <i class="fas fa-user-shield rounded-full px-4 py-5 text-6xl bg-indigo-100 text-indigo-600"></i>
        </div>
        <h1 class="text-xl font-bold text-gray-800 mt-3 text-center">Atur Ulang Password</h1>

        @if (session()->has('message'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="resetPassword" class="space-y-4">
            <div class="mt-3">
                <label class="font-semibold">Password Baru</label>
                <div class="relative">
                    <input
                        :type="$wire.showPassword ? 'text' : 'password'"
                        wire:model="password"
                        placeholder="Password baru"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 pr-12"
                    >
                    <button type="button"
                        wire:click="$toggle('showPassword')"
                        class="absolute top-1/2 right-3 transform -translate-y-1/2 text-gray-500"
                        tabindex="-1">
                        @if ($showPassword)
                            <i class="far fa-eye-slash"></i>
                        @else
                            <i class="far fa-eye"></i>
                        @endif
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">mohon masukkan password baru anda</p>
                @enderror
            </div>

            <div class="mt-3">
                <label class="font-semibold">Konfirmasi Password</label>
                <div class="relative">
                    <input
                        :type="$wire.showPasswordConfirm ? 'text' : 'password'"
                        wire:model="password_confirmation"
                        placeholder="Konfirmasi password"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 pr-12"
                    >
                    <button type="button"
                        wire:click="$toggle('showPasswordConfirm')"
                        class="absolute top-1/2 right-3 transform -translate-y-1/2 text-gray-500"
                        tabindex="-1">
                        @if ($showPasswordConfirm)
                            <i class="far fa-eye-slash"></i>
                        @else
                            <i class="far fa-eye"></i>
                        @endif
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">mohon konfirmasi password baru anda</p>
                @enderror
            </div>

            <div class="flex flex-col gap-3 mt-6">
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold"
                >
                    Simpan Password
                </button>

                <a
                    href="{{ route('login') }}"
                    class="w-full block text-center bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 rounded-lg font-semibold"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

