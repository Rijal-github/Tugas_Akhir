<div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-2xl shadow flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Landasan Kontainer</p>
                <p class="text-2xl font-bold text-indigo-600">{{ $kontainer }}</p>
            </div>
            <i class="fas fa-truck-loading text-2xl text-blue-800"></i>
        </div>
    
        <div class="bg-white p-4 rounded-2xl shadow flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Landasan Beratap</p>
                <p class="text-2xl font-bold text-purple-600">{{ $beratap }}</p>
            </div>
            {{-- <x-icons.user-group class="w-8 h-8 text-purple-500" /> --}}
            <i class="fas fa-warehouse text-2xl text-blue-800"></i>
        </div>
    
        <div class="bg-white p-4 rounded-2xl shadow flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">TPS Kecil</p>
                <p class="text-2xl font-bold text-blue-600">{{ $tpsKecil }}</p>
            </div>
            {{-- <x-icons.chart-dots class="w-8 h-8 text-blue-500" /> --}}
            <i class="fa-solid fa-dumpster text-2xl text-blue-800"></i> 
        </div>
    </div>
    
</div>
