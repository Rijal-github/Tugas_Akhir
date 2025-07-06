<div>
    <div class="bg-white rounded-2xl shadow-md p-6 w-full">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Data Driver</h2>
        <div class="space-y-4">
            @foreach ($vehicles as $vehicle)
                @php
                    $driverCount = $driverPerVehicleType->firstWhere('jenis_kendaraan', $vehicle->jenis_kendaraan)?->total_driver ?? 0;
                @endphp
                <div class="flex items-center gap-3">
                    <div class="
                        @if ($vehicle->jenis_kendaraan === 'Dump Truck') bg-indigo-100 text-indigo-600
                        @elseif ($vehicle->jenis_kendaraan === 'Truck Amroll') bg-green-100 text-green-600
                        @else bg-yellow-100 text-yellow-600
                        @endif
                        px-3 py-2 rounded-full">
                        <i class="
                            @if ($vehicle->jenis_kendaraan === 'Dump Truck') fas fa-truck
                            @elseif ($vehicle->jenis_kendaraan === 'Truck Amroll') fas fa-truck-front
                            @else fas fa-truck-pickup
                            @endif text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <div class="font-semibold text-sm">{{ $vehicle->jenis_kendaraan }}</div>
                            <div class="relative group cursor-pointer">
                                <div class="absolute -top-6 translate-x-[-22px] mx-auto w-max text-xs text-white bg-gray-700 px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition duration-200">
                                    Total driver
                                </div>
                                <div class="text-sm font-medium text-gray-700 bg-green-100 text-green-500 px-3 py-1 rounded-full">
                                    {{ $driverCount }}
                                </div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">supir: {{ $vehicle->driver->name ?? '-' }}</div>
                    </div>
                </div>
            @endforeach
        </div>        
        <div class="text-right mt-4">
            <a href="#" class="text-indigo-600 text-sm font-semibold hover:underline">View all →</a>
        </div>
    </div>
    
</div>
