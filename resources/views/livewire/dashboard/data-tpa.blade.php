<div class="bg-white rounded-2xl shadow-md p-6 w-full">
    <div class="flex justify-between items-start mb-4">
        <h2 class="text-lg font-bold text-gray-800">Data UPTD</h2>
        <span class="text-green-500 text-sm font-semibold"></span>
    </div>

    <div class="space-y-4">
        @foreach ($uptdVehicles as $uptd)
            @php
                $totalPerJenis = $vehicleCountPerUptd->where('nama_uptd', $uptd->nama_uptd);
            @endphp
    
            @foreach ($totalPerJenis as $item)
                <div class="flex items-center gap-3">
                    <div class="bg-indigo-100 text-indigo-600 px-3 py-2 rounded-full">
                        <i class="fas fa-building-user text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <div class="font-semibold text-sm">{{ $uptd->nama_uptd }}</div>
                            <div class="relative group">
                                <div class="absolute -top-6 right-0 translate-x-[-10px] w-max text-xs text-white bg-gray-700 px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition duration-200">
                                    Total kendaraan
                                </div>
                                <div class="text-sm font-medium text-gray-700 bg-green-100 text-green-500 px-3 py-1 rounded-full">
                                    {{ $item->total_kendaraan }}
                                </div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">Kendaraan: {{ $item->jenis_kendaraan }}</div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
    
</div>

