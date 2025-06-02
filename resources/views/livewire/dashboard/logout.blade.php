<div>
    <button wire:click="confirmLogout" class="flex items-center px-4 py-2 rounded-lg text-sm font-medium text-red-500 hover:bg-red-200 transition gap-3">
        <i class="fas fa-arrow-right-from-bracket text-lg"></i>
        <span x-show="sidebarOpen" x-transition>Log Out</span>
    </button>

     <!-- Popup Konfirmasi -->
     @if ($showConfirm)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 animate-fade-in">
                <div class="text-center">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Konfirmasi Logout</h2>
                    <p class="text-gray-600 mb-6">Apakah Anda yakin ingin keluar dari halaman ini?</p>

                    <div class="flex justify-center gap-4">
                        <button
                            wire:click="logout"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-medium transition">
                            Keluar
                        </button>
                        <button
                            wire:click="cancelLogout"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md font-medium transition">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
