<div>
    <div class="bg-[#063970] text-white font-sans">
        {{-- Navbar --}}
        <header class="bg-[#063970] backdrop-blur-md shadow-md text-sm text-white sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
                {{-- Logo / Brand --}}
                <div class="text-lg font-bold text-[#ffffff]">Pengelolaan Sampah</div>

                {{-- Navigation Menu --}}
                <nav class="hidden md:flex space-x-6">
                    <a href="#information" class="hover:text-yellow-500">Information</a>
                    <a href="#about" class="hover:text-yellow-500">About Us</a>
                    <a href="#contact" class="hover:text-yellow-500">Contact</a>
                </nav>

                {{-- Login / Register --}}
                <div class="flex items-center space-x-5">
                    <a href="/login" class="px-5 py-2 bg-yellow-300 text-blue-500 rounded hover:bg-yellow-400 hover:text-white transition">Login</a>
                    <a href="/register" class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Registrasi</a>
                </div>
            </div>
        </header>

        {{-- Hero Section --}}
        <div class="flex flex-col lg:flex-row items-center justify-between px-6 py-20  mx-auto">
            <div class="lg:w-1/2 space-y-4">
                <h1 class="text-3xl md:text-4xl font-bold leading-tight">
                    Pengelolaan Sampah yang Bijak untuk Masa Depan Berkelanjutan
                </h1>
                <p class="text-sm text-slate-200">Mari bersama wujudkan bumi yang lebih bersih dan sehat dengan langkah kecil dari diri kita sendiri!</p>
                <a href="#" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Mulai sekarang →
                </a>
            </div>
            <div class="lg:w-1/2 mt-10 lg:mt-0 bg-blue-200 h-64 w-full rounded-lg"></div>
        </div>
    
        {{-- Ubah Sampah Section --}}
        <div id="information" class="bg-white text-black px-6 py-16  mx-auto">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div>
                    <h2 class="text-3xl font-bold mb-4">Ubah Sampah Menjadi Manfaat</h2>
                    <p class="text-sm text-gray-600">
                        Dengan pengelolaan yang tepat, sampah bisa didaur ulang, dikomposkan, bahkan diubah menjadi energi.
                        Mari bersama-sama mengelola sampah dengan bijak untuk menciptakan lingkungan yang lebih bersih dan sehat!
                    </p>
                </div>
                <div class="bg-blue-200 h-48 w-full rounded-lg"></div>
            </div>
        </div>
    
        {{-- Sampah Terolah Section --}}
        <div class="bg-white text-black  mx-auto">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div class="flex items-center justify-center relative">
                    <img src="{{ asset('storage/assets/img/Work Together Image.svg') }}" alt="Logo" 
                    style="width: 400px; height: auto;"
                    class="transform -translate-y-10 -translate-x-8">
                </div>
                <div>
                    <h2 class="text-3xl font-bold mb-4">Sampah Terolah, Lingkungan Terjaga</h2>
                    <p class="text-sm text-gray-600">
                        Bersama, kita bisa menciptakan sistem pengelolaan sampah yang efisien dan ramah lingkungan.
                        Jangan biarkan sampah mengotori masa depan kita!
                    </p>
                </div>
            </div>
        </div>
        {{-- Decorative dots or icons (gunakan SVG/icon sesuai kebutuhan) --}}
        {{-- <div class="absolute h-40 w-40 rounded-full border-dashed border-2 border-blue-400 animate-spin-slow"></div>
        <div class="absolute h-80 w-80 rounded-full border-dashed border-2 border-blue-400 animate-spin-slow"></div>
        <div class="absolute h-6 w-6 bg-yellow-400 rounded-full"></div> --}}
    
        <div class="bg-[#063970] text-center px-6 py-16">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 text-white">
                Sampah Hari Ini, Tanggung Jawab Kita Semua
            </h2>
            <p class="text-sm text-slate-200 mb-6">
                Dengan mengelola sampah secara bijak, kita tidak hanya menjaga kebersihan,
                tetapi juga menciptakan lingkungan yang nyaman bagi generasi mendatang.
                Saatnya bertindak, saatnya berubah!
            </p>
        </div>

        {{-- About Section --}}
        <div id="about" class="bg-white text-black p-4 mx-auto">
            <div class="flex items-center justify-center">
                <div>
                    <div class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                        About Us
                    </div>
                </div>
            </div>
        </div>
    
        {{-- Footer --}}
        <footer id="contact" class="bg-[#042f5c] text-white px-6 py-10 text-sm">
            <div class="grid md:grid-cols-5 gap-6  mx-auto">
                <div>
                    <p class="font-bold mb-2">Whitespace</p>
                    <p>Whitespace was created for the new ways we live and work. We make a better workspace around the world</p>
                </div>
                <div>
                    <p class="font-bold mb-2">Product</p>
                    <ul>
                        <li>Overview</li>
                        <li>Pricing</li>
                        <li>Customer stories</li>
                    </ul>
                </div>
                <div>
                    <p class="font-bold mb-2">Resources</p>
                    <ul>
                        <li>Blog</li>
                        <li>Guides & Tutorials</li>
                        <li>Help Center</li>
                    </ul>
                </div>
                <div>
                    <p class="font-bold mb-2">Company</p>
                    <ul>
                        <li>About Us</li>
                        <li>Careers</li>
                        <li>Media Kit</li>
                    </ul>
                </div>
                <div>
                    <p class="font-bold mb-2">Try It Today</p>
                    <p>Get started for free. Add your whole team as your needs grow.</p>
                    <a href="#" class="inline-block mt-2 px-3 py-2 bg-blue-500 rounded hover:bg-blue-600">
                        Start Today →
                    </a>
                </div>
            </div>
        </footer>
    </div>
    
</div>
