<div class="ctr-LupaPassword min-h-screen flex items-center justify-center bg-gradient-to-b from-blue-400 to-slate-200 p-4">
    <div class="cLupaPassword bg-white rounded-xl shadow-lg p-6 w-full max-w-md">
        <div class="icon-contain flex items-center justify-center mb-3">
            <i class="fas fa-user-lock rounded-full px-4 py-5 text-6xl bg-red-100 text-red-500"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-4 text-center">Lupa Password?</h1>
        <p class="text-sm text-gray-600 mb-6 text-center font-semibold">Masukkan nomor handphone yang terdaftar untuk menerima link reset password.</p>

        <form wire:submit.prevent="submit" class="space-y-4">
            <input
                type="email"
                wire:model="email"
                id="email"
                required
                placeholder="Masukkan email yang anda daftarkan"
                class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-1 focus:ring-blue-500"
            >
            @error('email') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            <div class="flex gap-2 mt-3">
                <button
                        type="button"
                        wire:click="goBack"
                        class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 rounded-lg font-medium transition"
                    >
                        Kembali
                </button>
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition"
                >
                    Kirim Link Reset
                </button>
            </div>
        </form>

        @if (session()->has('message'))
            <div class="mt-4 bg-green-100 text-green-700 p-3 rounded-lg text-center break-words">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>

