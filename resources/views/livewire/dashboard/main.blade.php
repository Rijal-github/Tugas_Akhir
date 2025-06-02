{{-- @section('breadcrumb', 'Dashboard') --}}

<div x-data="{ sidebarOpen: true }" class="flex min-h-screen bg-[#e8f0fe] text-gray-800">

    <div class="flex-1 flex flex-col w-full">
    {{-- Sidebar --}}
    {{-- @include('layouts.partials.sidebar') --}}

    {{-- Header --}}
    @include('layouts.partials.header')
        {{-- Main Content --}}
        <main class="flex-1 p-8 space-y-6 transition-all duration-300">
            
            

            {{-- Stats Cards --}}
            <div class="p-6 space-y-6">
                @livewire('dashboard.stats-cards')
            </div>

            {{-- Chart + Profile --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    @livewire('dashboard.ritasi-chart')
                </div>
                <div>
                    @livewire('dashboard.user-profile-card')
                </div>
            </div>

            {{-- Bottom Section --}}
            <div class="grid grid-cols-3 gap-6">
                @livewire('dashboard.data-tpa')
                @livewire('dashboard.jadwal-driver')
                @livewire('dashboard.data-iot')
            </div>

            {{-- maps API --}}
            <div class="p-3 rounded-xl bg-white">
                @livewire('dashboard.maps')
            </div>
        </main>
    </div>
</div>
