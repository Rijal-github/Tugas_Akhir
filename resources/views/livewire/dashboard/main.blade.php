{{-- @section('breadcrumb', 'Dashboard') --}}

<div x-data="{ sidebarOpen: true }" class="flex min-h-screen bg-[#E8F0FE] text-gray-800">

    <div class="flex-1 flex flex-col w-full">
    {{-- Sidebar --}}
    {{-- @include('layouts.partials.sidebar') --}}

    {{-- Header --}}
    @include('layouts.partials.header')
        {{-- Main Content --}}
        <main class="flex-1 p-8 space-y-6 transition-all duration-300">

            {{-- Stats Cards --}}
            <div class="bg-white p-4 space-y-4 rounded-lg">
                <div class="flex items-center gap-3">
                    <div class="flex items-center font-bold text-xl">
                        <h1>Tempat Pengumpulan Sampah</h1>
                    </div>
                    <div class="bg-indigo-100 text-indigo-600 px-3 py-2 rounded-full">
                        <i class="fas fa-recycle text-xl"></i>
                    </div>
                </div>
                @livewire('dashboard.stats-cards')
            </div>

            {{-- maps API --}}
            <div class="bg-white space-y-4 rounded-lg p-2">
                <div class="flex items-center gap-3">
                    <div class="flex items-center font-bold text-xl gap-3 ml-3">
                        <h2>Koordinat Tempat Pembuangan Sementara</h2>
                    </div>
                    <div class="bg-indigo-100 text-indigo-600 px-3 py-2 rounded-full">
                        <i class="fas fa-map-location-dot text-xl"></i>
                    </div>
                </div>
                <div class="bg-white p-3 rounded-lg">
                    @livewire('dashboard.maps')
                </div>
            </div>

            {{-- Chart + Profile --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch">
                <div class="md:col-span-2">
                    @livewire('dashboard.ritasi-chart')
                </div>
                <div>
                    @livewire('dashboard.user-profile-card')
                </div>
            </div>

            {{-- Bottom Section --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @livewire('dashboard.data-tpa')
                @livewire('dashboard.jadwal-driver')
                @livewire('dashboard.data-iot')
            </div>

        </main>
    </div>
</div>
