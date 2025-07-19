<div class="ctr-LupaPassword min-h-screen flex items-center justify-center bg-gradient-to-b from-blue-400 to-slate-200 p-4">
    <div class="cLupaPassword bg-white rounded-xl shadow-lg p-6 w-full max-w-md">
        <div class="image-contain flex items-center justify-center">
            <img src="{{ asset('storage/assets/img/logo.png') }}" alt="Logo" class="w-24 h-auto">
        </div>
        <h1 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Lupa Password?</h1>
        <p class="text-sm text-gray-600 mb-6 text-center">Masukkan nomor handphone yang terdaftar untuk menerima link reset password.</p>

        <form wire:submit.prevent="submit" class="space-y-4">
            <input
                type="text"
                wire:model="no_hp"
                placeholder="Masukkan nomor handphone"
                class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <div class="flex gap-2">
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
            <div class="mt-4 bg-green-100 text-green-700 p-3 rounded-lg text-center">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>

