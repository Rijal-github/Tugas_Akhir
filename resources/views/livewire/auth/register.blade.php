<div>
    <div>
        <div class="flex h-screen">
            <!-- KIRI: Gambar Background -->
            <div class="w-full hidden md:block">
              <img src="{{ asset('storage/assets/img/TPA.jpeg') }}" alt="Background Sampah" class="w-full h-full object-cover" />
            </div>
          
            <!-- KANAN: Form Register -->
            <div class="w-full md:w-1/2 flex items-center justify-center">
                <div class="max-w-md w-full">
                <!-- LOGO DAN NAMA MITRA -->
                <div class="flex items-center gap-4 transform -translate-y-5">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8">
                    <h2 class="text-lg font-bold text-gray-700">Nama Mitra</h2>
                </div>
          
                <h2 class="flex items-center justify-center text-2xl font-bold text-gray-800 mb-5">Daftar</h2>
                <p class="text-gray-500 mb-8">Nice to see you again</p>
          
                <form action="/login" method="POST" class="space-y-4">
                    <!-- Username -->
                  <div>
                    <label class="block text-sm mb-1 text-gray-700">Email or Phone number</label>
                    <input type="text" name="email" class="w-full  bg-gray-100 border border-gray-200 px-4 py-2 rounded focus:ring-blue-500" placeholder="Email or phone number" />
                  </div>

                  <!-- Email / Phone -->
                  <div>
                    <label class="block text-sm mb-1 text-gray-700">Email or Phone number</label>
                    <input type="text" name="email" class="w-full  bg-gray-100 border border-gray-200 px-4 py-2 rounded focus:ring-blue-500" placeholder="Email or phone number" />
                  </div>
          
                   <!-- Address -->
                   <div>
                    <label class="block text-sm mb-1 text-gray-700">Email or Phone number</label>
                    <input type="text" name="email" class="w-full  bg-gray-100 border border-gray-200 px-4 py-2 rounded focus:ring-blue-500" placeholder="Email or phone number" />
                  </div>

                  <!-- Password -->
                  <div>
                    <label class="block text-sm mb-1 text-gray-700">Password</label>
                    <div class="relative">
                      <input type="password" name="password" class="w-full  bg-gray-100 border border-gray-200 px-4 py-2 rounded focus:ring-blue-500" placeholder="Enter password" />
                      <span class="absolute right-3 top-3 text-gray-400 cursor-pointer">
                        
                      </span>
                    </div>
                  </div>
          
                  <!-- Tombol Login -->
                  <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Daftar</button>
                </form>
          
                <!-- Daftar -->
                <div class="text-sm text-center mt-6">
                  Sudah punya akun?
                  <a href="/login" class="text-blue-600 hover:underline">Masuk</a>
                </div>
          
                <!-- Footer -->
                <footer class="mt-20 pb-8">
                    <div class="grp-cpryApps w-full selectDisable">
                        <div class="ctr-cpryApps">
                            <div class="cCpryApps w-fit mx-auto">
                                <div class="txCpyApps flex items-center gap-2" style="background: -webkit-linear-gradient(#f74803, #0086bb); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                    <div class="icnCpry">
                                        <span class="icn text-xl">
                                            <i class="far fa-copyright"></i>
                                        </span>
                                    </div>
                                    <div class="txCpry text-xs">
                                        <p>{{ date('Y') }} Dinas Lingkungan Hidup</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
              </div>
            </div>
          </div>
          
    </div>
    
</div>
