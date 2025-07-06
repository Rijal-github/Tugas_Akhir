    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div class="bg-gradient-to-r from-indigo-100 to-indigo-300 p-4 rounded-2xl shadow flex justify-between items-center transform transition duration-300 hover:scale-105">
            <div class="font-semibold text-sm text-gray-500">
                <p>Landasan Kontainer</p>
                <p class="text-2xl font-bold text-indigo-600">{{ $kontainer }}</p>
            </div>
            <div class="bg-blue-50 text-indigo-600 px-3 py-2 rounded-full">
                <i class="fas fa-truck-loading text-2xl"></i>
            </div>
        </div>
    
        <div class="bg-gradient-to-r from-purple-100 to-purple-300 p-4 rounded-2xl shadow flex justify-between items-center transform transition duration-300 hover:scale-105">
            <div class="font-semibold text-sm text-gray-500">
                <p>Landasan Beratap</p>
                <p class="text-2xl font-bold text-purple-600">{{ $beratap }}</p>
            </div>
            <div class="bg-purple-50 text-purple-600 px-3 py-2 rounded-full">
                <i class="fas fa-warehouse text-2xl"></i>
            </div>
        </div>
    
        <div class="bg-gradient-to-r from-blue-100 to-blue-300 p-4 rounded-2xl shadow flex justify-between items-center transform transition duration-300 hover:scale-105">
            <div class="font-semibold text-sm text-gray-500">
                <p>TPS Kecil</p>
                <p class="text-2xl font-bold text-blue-600">{{ $tpsKecil }}</p>
            </div>
            <div class="bg-blue-50 text-blue-600 px-3 py-2 rounded-full">
                <i class="fa-solid fa-dumpster text-2xl"></i> 
            </div>
        </div>
    </div>