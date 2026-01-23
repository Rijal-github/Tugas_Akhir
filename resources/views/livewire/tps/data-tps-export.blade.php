<div class="space-y-4">
    <!-- Dropdown pilih UPTD -->
    <div class="flex justify-center gap-3">
        <div>
            <select wire:model="selectedUptd"
                    class="border rounded p-2 w-64">
                <option value="">-- Pilih UPTD --</option>
                @foreach($uptds as $uptd)
                    <option value="{{ $uptd->id_uptd }}">{{ $uptd->nama_uptd }}</option>
                @endforeach
            </select>
        </div>
    
        <!-- Tombol export -->
        <div>
            <button wire:click="export"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Export
            </button>
        </div>
    </div>

    <!-- Pesan error -->
    @if (session()->has('error'))
        <div class="text-red-600">{{ session('error') }}</div>
    @endif

     <!-- 🔍 Debug -->
    {{-- <div class="mt-4 p-2 bg-gray-100 rounded text-sm">
        <strong>Debug:</strong><br>
        selectedUptd = <span class="text-blue-600">{{ $selectedUptd }}</span>
    </div> --}}
</div>

