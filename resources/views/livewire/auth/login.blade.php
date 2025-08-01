<div class="main-container min-h-screen bg-gradient-to-b from-blue-400 to-slate-200 flex items-center justify-center">
  <div class="ctr-MainLogin w-full max-w-md overflow-auto">
      <div class="cMainLogin">
          <div class="ctr-authLogin">
              <div class="cAuthLogin flex items-center justify-center">
                  <div class="ctr-formFieldlogin">

                    {{-- @if (session()->has('error'))
                        <div class="text-red-600 text-sm text-center mt-2">
                            {{ session('error') }}
                        </div>
                    @endif --}}
                      <form wire:submit.prevent='login' class="cformFieldlogin rounded-md flex items-center justify-center w-full p-5 bg-slate-200">
                          @csrf
                          <div class="Form-contenMain">
                              <div class="image-contain flex items-center justify-center">
                                  <img src="{{ asset('storage/assets/img/Logo.png') }}" alt="Logo" class="w-24 h-auto">
                              </div>
                              <div class="headSignIn flex justify-center text-2xl md:text-[2.5rem] font-bold mt-5">
                                  <div class="tx text-slate-600 flex items-center">
                                      <h1>Login</h1>
                                  </div>
                              </div>
                              <div class="tx text-sm text-slate-500 text-center mt-2">
                                  <p>Please enter username</p>
                              </div>
                              <div class="ctr-formLoginInpt">
                                  <div class="cFormLoginInpt my-6 space-y-8 w-72">
                                      <div class="form-input items-center gap-2 relative wire:ignore">
                                          {{-- <input type="text" id="email" name="email" wire:model.lazy="email" class="peer inptEmail text-sm w-full rounded-md bg-slate-100 border-1 border-gray-300 @error('email') is-invalid @enderror" placeholder=" "> --}}
                                          <input required wire:model.defer="username" type="text" id="username" name="username" class="peer inptEmail text-sm w-full rounded-md bg-slate-100 border-1 border-gray-300">
                                          <label for="username" class="block text-sm cursor-text px-1.5 py-0.5 rounded-lg absolute transition-all -translate-y-1/2 top-1/2 peer-focus:-top-1/4 peer-focus:text-white">
                                              <div class="tx text-slate-400">
                                                  <p>Username</p>
                                              </div>   
                                          </label>
                                          @error('username')
                                            <span class="text-sm text-red-600 absolute -bottom-5 left-0">{{ $message }}</span>
                                          @enderror
                                      </div>
                                      <div class="form-input items-center gap-2 relative wire:ignore">
                                          {{-- <input type="password" id="password" name="password" wire:model.lazy="password" class="peer inptPassword text-sm w-full rounded-md bg-slate-100 border-1 border-gray-300 @error('password') is-invalid @enderror" placeholder=" "> --}}
                                          <input required wire:model.defer='password' type="password" id="password" name="password" class="peer inptPassword text-sm w-full rounded-md bg-slate-100 border-1 border-gray-300">
                                          <label for="password" class="block text-sm cursor-text px-1.5 py-0.5 rounded-lg absolute transition-all -translate-y-1/2 top-1/2 peer-focus:-top-1/4 peer-focus:text-white">
                                              <div class="tx text-slate-400">
                                                  <p>Password</p>
                                              </div>  
                                          </label>
                                          <div class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer" id="togglePassword">
                                            <i class="far fa-eye text-gray-500"></i>
                                        </div>
                                          @error('password')
                                            <span class="text-sm text-red-600 absolute -bottom-5 left-0">{{ $message }}</span>
                                          @enderror                  
                                      </div>
                                  </div>
                              </div>
                              <div class="mt-2">
                                @if (session()->has('error'))
                                    <div class="text-red-600 text-sm text-left">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                              <div class="gotoForgetPass mt-3 ml-2">
                                  <div class="cGTForgetPass text-xs flex items-center gap-1">
                                      <div class="txHref text-slate-700">
                                          <p>Forgot password?</p>
                                      </div>
                                          <div class="txHref text-[#006dc1]">
                                              <a href="{{ route('forgot-password') }}">Click here</a>
                                              {{-- <a href="#">Click here</a> --}}
                                          </div>
                                  </div>
                              </div>
                              <div class="ctr-btnConfirSignIn mt-6 px-2 p-4">
                                  <div class="cBtnConfirSignIn">
                                      <button type="submit" class="block w-full py-2 bg-[#006dc1] hover:bg-[#002cc9] text-white rounded-xl">
                                          <div class="txBtn">
                                              <p>Continue</p>
                                          </div>
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </form>
                      <footer class="mt-10 pb-8">
                          <div class="grp-cpryApps w-full selectDisable">
                              <div class="ctr-cpryApps">
                                  <div class="cCpryApps w-fit mx-auto">
                                      <div class="txCpyApps flex items-center gap-2" style="background: -webkit-linear-gradient(#f74803, #0086bb); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                          <div class="icnCpry">
                                              <span class="icn text-2xl">
                                                  <i class="far fa-copyright"></i>
                                              </span>
                                          </div>
                                          <div class="txCpry text-sm">
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
</div>

@section('script-field')
  <script src="{{ asset('storage/assets/auth/input.js') }}"></script>
  <script src="{{ asset('storage/assets/auth/showHidePassword.js') }}"></script>
@endsection
