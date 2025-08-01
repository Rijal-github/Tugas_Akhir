
<aside :class="sidebarOpen ? 'w-64' : 'w-24'" class="fixed h-screen bg-gradient-to-b from-indigo-300 to-blue-300 shadow-lg transition-all duration-300 z-10 flex flex-col text-white overflow-hidden">
    <!-- Logo & Title -->
    <div class="flex items-center justify-between p-4">
        <div class="flex items-center space-x-3" x-show="sidebarOpen" x-transition>
            <div class="flex items-center justify-center py-6">
                <div class="bg-white w-10 h-10 rounded-full">
                  {{-- <img 
                    src="{{ Auth::user()->avatar ? asset('storage/avatars/' . Auth::user()->avatar) : asset('storage/assets/img/Logo.png') }}" 
                    alt="Avatar" 
                    class="w-full h-full object-cover"
                > --}}
                </div>
            </div>
       @auth
            <div>
                <h1 class="font-bold text-md text-indigo-700">{{ Auth::user()->role->name }}</h1>
                <p class="text-sm text-gray-500">DASHBOARD</p>
            </div>
        @endauth
        </div>
        <!-- Toggle Button -->
        <button @click="sidebarOpen = !sidebarOpen" class="focus:outline-none">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 space-y-2 px-4 mt-4">
        @php
            $permissions = auth()->user()->role->permissions->pluck('akses')->toArray();
            // $role = strtolower(auth()->user()->role->name ?? '');
            // dd(auth()->user()->role);
        @endphp
        {{-- Repeat this block as needed for each menu item --}}
        <div>
            <a href="/dashboard" class="flex items-center px-4 py-2 rounded-lg text-sm font-medium gap-3
                {{ request()->routeIs('dashboard') ? 'bg-white text-indigo-700' : 'text-white hover:bg-white hover:text-indigo-700' }}">
                <i class="fas fa-border-all text-lg"></i>
                <span x-show="sidebarOpen" x-transition>Dashboard</span>
            </a>
        </div>

        {{-- @if(in_array($role, ['admin', 'dlh', 'operator tpa'])) --}}
        @if(in_array('data_tps', $permissions))
        <div>
            <a href="/data-tps" class="flex items-center px-4 py-2 rounded-lg text-sm font-medium transition gap-3
            {{ request()->routeIs('data-tps') ? 'bg-white text-indigo-700' : 'text-white hover:bg-white hover:text-indigo-700' }}">
                <i class="fas fa-industry text-lg"></i>
                <span x-show="sidebarOpen" x-transition>Data TPS</span>
            </a>
        </div>
        @endif

        {{-- @if(in_array($role, ['admin', 'dlh', 'operator tpa'])) --}}
        @if(in_array('data_tpa', $permissions))
        <div>
            <a href="/data-tpa" class="flex items-center px-4 py-2 rounded-lg text-sm font-medium transition gap-3
            {{ request()->routeIs('data-tpa') ? 'bg-white text-indigo-700' : 'text-white hover:bg-white hover:text-indigo-700' }}">
                <i class="fas fa-warehouse text-lg-center"></i>
                <span x-show="sidebarOpen" x-transition>Data TPA</span>
            </a>
        </div>
        @endif

        {{-- @if(in_array($role, ['admin', 'dlh', 'uptd'])) --}}
        @if(in_array('data_uptd', $permissions))
        <div>
            <a href="/data-uptd" class="flex items-center px-4 py-2 rounded-lg text-sm font-medium transition gap-3
            {{ request()->routeIs('data-uptd') ? 'bg-white text-indigo-700' : 'text-white hover:bg-white hover:text-indigo-700' }}">
                <i class="fas fa-chart-column text-lg"></i>
                <span x-show="sidebarOpen" x-transition>Data UPTD</span>
            </a>
        </div>
        @endif

        {{-- @if(in_array($role, ['admin', 'operator tpa'])) --}}
        @if(in_array('data_driver', $permissions))
        <div>
            <a href="data-driver" class="flex items-center px-4 py-2 rounded-lg text-sm font-medium transition gap-3
            {{ request()->routeIs('data-driver') ? 'bg-white text-indigo-700' : 'text-white hover:bg-white hover:text-indigo-700' }}">
                <i class="fas fa-car-on text-[1rem]"></i>
                <span x-show="sidebarOpen" x-transition>Data Driver</span>
            </a>
        </div>
        @endif

        {{-- @if(in_array($role, ['admin', 'operator tpa']))
        <div>
            <a href="/data-iot" class="flex items-center px-4 py-2 rounded-lg text-sm font-medium transition gap-3
            {{ request()->routeIs('data-iot') ? 'bg-white text-indigo-700' : 'text-white hover:bg-white hover:text-indigo-700' }}">
                <i class="fas fa-database text-lg"></i>
                <span x-show="sidebarOpen" x-transition>Data IoT</span>
            </a>
        </div>
        @endif --}}

        {{-- @if($role === 'admin') --}}
        @if(in_array('setting_user', $permissions))
        <div>
            <div class="flex flex-col">
                <button type="button" onclick="toggleSubSidebar()" 
                    class="flex items-center w-full px-4 py-2 rounded-lg text-sm font-medium transition gap-3
                    {{ request()->routeIs('manage-role*','roles*') ? 'bg-white text-indigo-700' : 'text-white hover:bg-white hover:text-indigo-700' }}">
                    <i class="fas fa-gear text-[1rem]"></i>
                    <span x-show="sidebarOpen" x-transition>Manage Setting</span>
                    <i id="arrowIcon" class="fas fa-chevron-down ml-auto transition-transform {{ request()->routeIs('manage-role*') ? 'rotate-180' : '' }}"></i>
                </button>
        
                <div id="subSidebar" class="flex flex-col ml-8 mt-2 space-y-2 overflow-hidden transition-all duration-300 max-h-0">
                    <a href="/manage-role" class="flex items-center rounded-lg px-4 py-2 text-xs transition
                    {{ request()->routeIs('manage-role*') ? 'bg-white text-indigo-700' : 'text-white hover:bg-white hover:text-indigo-700' }}">
                        <i class="fas fa-users-cog text-[1rem]"></i>
                        <span class="ml-3">Setting User</span>
                    </a>
                    <div>
                        <a href="/roles" class="flex items-center rounded-lg px-4 py-2 text-xs transition
                        {{ request()->routeIs('roles*') ? 'bg-white text-indigo-700' : 'text-white hover:bg-white hover:text-indigo-700' }}">
                            <i class="fas fa-users-gear text-[1rem]"></i>
                            <span class="ml-3">Setting Role</span>
                        </a>
                    </div>
                </div>           
            </div>
        </div>
        @endif
        <div>
            <a href="/view-profile" class="flex items-center justify-center px-4 py-2 rounded-lg text-lg font-medium gap-2 bg-indigo-600
                {{ request()->routeIs('view-profile') ? : 'hover:bg-indigo-700' }}">
                <i class="fas fa-user-gear text-lg"></i>
                <span x-show="sidebarOpen" x-transition>Profile</span>
            </a>
        </div>
        {{-- Tambahkan menu lainnya sesuai kebutuhan --}}
    </nav>
    <div class="px-4 mb-6 z-10" wire:ignore>
        @livewire('dashboard.logout')
    </div>
</aside>

<script src="{{ asset('storage/assets/subsidebar/subsidebar.js') }}"></script>
<script src="{{ asset('storage/assets/subsidebar/sub-pelaporan.js') }}"></script>



{{-- @if(in_array($role, ['admin', 'dlh', 'uptd', 'operator_tpa']))
<div>
    <div class="flex flex-col">
        <button type="button" class="flex items-center w-full px-4 py-2 rounded-lg text-sm font-medium transition gap-3
        {{ request()->routeIs('pelaporan*') ? 'bg-indigo-200 text-indigo-800' : 'text-indigo-700 bg-indigo-100 hover:bg-indigo-200' }}"
        onclick="toggleSubSidebarLaporan()">
            <i class="far fa-folder-open text-[1rem]"></i>
            <span x-show="sidebarOpen" x-transition>Pelaporan</span>
            <i id="arrowIconLaporan" class="fas fa-chevron-down ml-auto transition-transform {{ request()->routeIs('laporan*') ? 'rotate-180' : '' }}"></i>
        </button>
        <div id="subSidebarLaporan" class="flex flex-col ml-8 mt-2 space-y-2 overflow-hidden transition-all duration-300 
        {{ request()->routeIs('laporan*') ? 'max-h-40' : 'max-h-0' }}">
            <div>
                <a href="/pelaporan" class="flex items-center px-4 py-2 text-sm text-indigo-700 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                    <i class="fas fa-file-lines text-[1rem]"></i>
                    <span class="ml-3">Laporan harian</span>
                </a>
            </div>
            <div>
                <a href="/laporan-mingguan" class="flex items-center px-4 py-2 text-sm text-indigo-700 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                    <i class="fas fa-file-lines text-[1rem]"></i>
                    <span class="ml-3">Laporan mingguan</span>
                </a>
            </div>
            <div>
                <a href="/laporan-bulanan" class="flex items-center px-4 py-2 text-sm text-indigo-700 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                    <i class="fas fa-file-lines text-[1rem]"></i>
                    <span class="ml-3">Laporan bulanan</span>
                </a>
            </div>
            <div>
                <a href="/laporan-tahunan" class="flex items-center px-4 py-2 text-sm text-indigo-700 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                    <i class="fas fa-file-lines text-[1rem]"></i>
                    <span class="ml-3">Laporan Tahunan</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endif --}}