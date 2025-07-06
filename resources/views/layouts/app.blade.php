<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <html lang="en" class="scroll-smooth">
            
        <title>{{ $title ?? 'Page Title' }}</title>

        @yield('head-meta-field')
        <title>@yield('titlePage', 'AGT')</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="crossorigin=""/>
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:slnt,wght@-10..0,100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="icon" href="{{asset('components/icon/logo/logoD.svg')}}" type="image/x-icon">
        @yield('head-link-field')
        {{-- <link rel="stylesheet" href="{{ asset('main/css/s.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('main/css/font.css') }}" type="text/css"> --}}
        <script src="https://kit.fontawesome.com/15f35fc9f3.js" crossorigin="anonymous"></script>
        @yield('head-style-field')

        @livewireStyles
    </head>
    <body class="text-gray-800">
        <div x-data="{ sidebarOpen: true }" class="flex min-h-screen">
            @include('layouts.partials.sidebar')
    
            <main :class="sidebarOpen ? 'pl-64' : 'pl-24'" class="flex-1 transition-all duration-300">
                {{-- @include('layouts.partials.header') --}}
    
{{--     
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold">@yield('breadcrumb')</h2>
                        <h1 class="text-3xl font-bold text-indigo-700">@yield('title')</h1>
                    </div>
                    <div class="">
                        <input type="text" placeholder="Search..." class="px-4 py-2 rounded-lg shadow-sm border focus:outline-none" />
                    </div>
                </div> --}}
                
                
                
                {{-- Main Content --}}
                {{ $slot }}
            </main>
        </div>
            {{-- @stack('scripts') --}}
            @livewireScripts
        <script>
            document.addEventListener('livewire:load', function () {
                Livewire.hook('message.sent', () => {
                    // Mengganti title halaman (jika ingin)
                    document.title = 'Loading...';
                });
        
                Livewire.hook('message.processed', () => {
                    // Mengembalikan title ke normal setelah load selesai
                    document.title = 'Dashboard'; // Ganti dengan title asli halaman
                });
            });
        </script>
        {{-- @yield('script-field') --}}
    </body>
</html>
