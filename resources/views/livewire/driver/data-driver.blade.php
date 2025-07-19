@section('breadcrumb', 'Data Driver')

<div class="mt-4">
    <div class="ctr-contentMainUser">
        <div class="cContentMainUser flex flex-col lg:flex-row gap-2 p-5">
            <div class="ctr-lstContentMainUser list-shwAllData shrink-0 mt-2 w-full sticky top-0 overflow-auto p-4 rounded-2xl border border-spacing-2 bg-white">
                <div class="cLstContentMainUser">
                    <div class="ctr-headContentMainRoles head-listShwAllData flex items-center justify-between border-b dark:border-primary p-5 ">
                        <div class="selectAll flex items-center gap-4">
                            <div class="ctrBtn-headBack items-center hidden" id="backButton">
                                <div class="cBtn-iconBack">
                                    <span class="icon block items-center bg-black/10 hover:bg-slate-300 rounded-[100%] px-2 py-1 ">
                                        <i class="fas fa-arrow-left text-xl font-semibold text-slate-600 hover:text-slate-900"></i>
                                    </span>
                                </div>
                            </div>
                            <span class="block font-semibold text-lg">
                                List Driver
                            </span>
                        </div>
                        {{-- <div class="flex items-center gap-4">                              
                            <div class="relative group">
                                <button class="text-red-500 hover:text-red-600 transition-transform transform hover:scale-110 bg-red-100 px-2 py-1 rounded-full">
                                    <i class="fas fa-trash text-lg"></i>
                                </button>
                                <div class="absolute bottom-full mb-1 left-1/2 -translate-x-1/2 bg-gray-900 text-white px-3 py-1 text-xs rounded-md opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                                    Hapus
                                </div>
                            </div>
                            
                            @livewire('driver.driver-form')
                        </div> --}}

                        
                    </div>
                    <div class="ctr-listDataMainUser body-listShwAllData">
                        <div class="cListDataMainUser">
                            @foreach ($vehicles as $vehicle)
                                @if ($vehicle->driver && $vehicle->uptd)

                                @php
                                    $driverData = [
                                        'name' => $vehicle->driver->name,
                                        'email' => $vehicle->driver->email,
                                        'jenis_kendaraan' => $vehicle->jenis_kendaraan,
                                        'no_polisi' => $vehicle->no_polisi,
                                        'kapasitas' => $vehicle->kapasitas_angkutan,
                                        'phone' => $vehicle->driver->no_hp,
                                        'photo' => asset('storage/assets/img/github.jpg'),
                                        'join_date' => \Carbon\Carbon::parse($vehicle->driver->created_at)->format('d/m/Y'),
                                        'addres' => $vehicle->driver->alamat_user ?? '-', // kalau kolom address tidak nullable
                                        "role" => $vehicle->driver->role->name ?? '-',
                                    ];
                                @endphp
                                    <div class="ctr-itmContentMainUser wrapper-item mt-4 p-3 bg-slate-100 rounded-md dark:bg-darker transition duration-50 hover:bg-slate-200">
                                        <div class="cItmContentMainUser row-dataItem flex items-center justify-between mb-2 rounded-md cursor-pointer text-black"
                                        data-driver='@json($driverData)'>
                                            <div class="lftContent flex items-center gap-4">
                                                <div class="selectThsItm flex items-center justify-center shrink-0">
                                                    <input type="checkbox" name="" id=""
                                                        class="checkDataElemn rounded-md focus:ring-0 focus:ring-transparent cursor-pointer">
                                                </div>
                                                <div class="summUser flex items-center gap-2">
                                                    <img src="{{ asset('storage/assets/img/github.jpg') }}"
                                                        alt="" class="w-10 aspect-square rounded-full object-cover object-center border">
                                                    <div class="nmeUser">
                                                        <p class="block text-sm font-semibold">{{ $vehicle->driver->name }}</p>
                                                        <span class="block text-xs text-slate-400">{{ $vehicle->uptd->nama_uptd }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex size-10 shrink-0 items-center justify-start rounded-full relative">
                                                <span class="icon">
                                                    <i class="fas fa-chevron-right text-xl text-slate-400"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
          
            </div>
            <div id="userDetail" class="ctr-detailMainUser flex-grow rounded-2xl border bg-white mt-2 hidden">
                <div class="cDetailMainUser p-4 rounded-2xl">
                    <div class="summUser flex items-center justify-between gap-5 border-b p-4">
                        <div class="flex items-center gap-5">
                            <!-- Foto -->
                            <img id="detailPhoto" src="{{ asset('storage/assets/img/github.jpg') }}"
                            class="w-24 aspect-square rounded-[100%] object-cover object-center border border-black">
                            <div class="nmeUser ">
                                <!-- Bagian nama dan email -->
                                <p class="block text-xl font-bold" id="detailName"></p>
                                <span class="block text-sm text-slate-400" id="detailEmail"></span>
                            </div>
                            
                        </div>
                        <a href="#" class="flex items-center gap-2 rounded-lg px-2 py-2 bg-gray-600 hover:bg-gray-500">
                            <i class="fas fa-gear text-sm text-white"></i>
                            <p class="flex items-center text-md-center text-white">Edit Profile</p>
                        </a>
                    </div>
                    <div class="ctr-userBadgesProfileUser mt-4">
                        <div class="cUserBadgesProfileUser">
                            <div class="headBadgesProfileUser">
                                <div class="txSince text-lg font-semibold p-2">
                                    <p>Driver Information</p>
                                </div>
                            </div>               
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 border-b p-3 space-y-3">
                        <div class="flex items-center mt-2 gap-3">
                            <i class="fas fa-car-side text-slate-700 w-5 text-center"></i>
                            <span class="w-48">Jenis Kendaraan</span>
                            <span>:</span>
                            <span id="detailJenis"></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="far fa-id-card text-slate-700 w-5 text-center"></i>
                            <span class="w-48">No Polisi</span>
                            <span>:</span>
                            <span id="detailNoPolisi"></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-weight-scale text-slate-700 w-5 text-center"></i>
                            <span class="w-48">Kapasitas angkutan</span>
                            <span>:</span>
                            <span id="detailKapasitas"></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="far fa-envelope text-slate-700 w-5 text-center"></i>
                            <span class="w-48">Email</span>
                            <span>:</span>
                            <span id="detailEmail2"></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="far fa-phone text-slate-700 w-5 text-center"></i>
                            <span class="w-48">Phone</span>
                            <span>:</span>
                            <span id="detailPhone"></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-map-marker-alt text-slate-700 w-5 text-center"></i>
                            <span class="w-48">Alamat</span>
                            <span>:</span>
                            <span id="detail-address"></span>
                        </div>
                    </div>
                    <div class="ctr-roleUserProfile mt-4">
                        <div class="cRoleUserProfile">
                            <div class="headRoleUserProfile">
                                <div class="txSince text-xs font-semibold">
                                    <p>Role</p>
                                </div>
                            </div>
                            <div class="ctr-listRoleUser mt-1">
                                <div class="cListRoleUser flex items-center flex-wrap gap-1 text-xs">
                                    <div class="ctr-itmRoleUser group relative">
                                        <div class="cItemRoleUser flex items-center gap-2 px-2 py-0.5 bg-gray-200 rounded-md">
                                            <span class="iconCircle text-green-600">
                                                <i class="fas fa-circle"></i>
                                            </span>
                                            <div class="txRole">
                                                <p id="detail-role">Driver</p>
                                            </div>
                                        </div>
                                        <div class="detSinceGetRoles bg-gray-300 absolute text-xs -top-[125%] left-1/2 -translate-x-1/2 px-1 py-0.5 rounded-md hidden group-hover:block delay-150">
                                            <div class="txP">
                                                <p>{{ date('d/m/Y', mt_rand(1262055681, time())) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ctr-userSinceProfile mt-4">
                        <div class="cUserSinceProfile">
                            <div class="headSinceProfile">
                                <div class="txSince text-xs font-semibold">
                                    <p>Join Date</p>
                                </div>
                            </div>
                            <div class="cSinceProfile mt-1 text-sm flex items-center gap-2">
                                <span class="icon w-5 aspect-square flex items-center justify-center border border-black rounded-full p-[2px]">
                                    <img src="{{ asset('storage/assets/img/github.jpg') }}" alt="" class="w-full object-cover object-center">
                                </span>
                                <div class="txSince">
                                    <p id="detailJoinDate"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ctr-mainItemProduct bg-white">
                         <div class="cMainItemProduct">
                            <div class="ctr-headMainItemProduct">
                                <div class="cHeadMainItemProduct flex items-center border-b p-4">
                                    <div class="mainHeadItemProduct flex-grow w-1/2 ml-20">
                                        <h2 class="text-lg font-semibold text-slate-500">Jenis TPS</h2>
                                    </div>
                                    <div class="priceDateHeadItemProduct w-1/2 shrink-0 flex">
                                        <div class="priceHeadItemProduct flex-grow w-1/2 text-balance">
                                            <h2 class="text-lg font-semibold text-slate-500">Alamat</h2>
                                        </div>
                                        <div class="dateHeadItemProduct flex-grow w-1/2 text-center">
                                            <h2 class="text-lg font-semibold text-slate-500">Tanggal</h2>                                  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ctr-listItemProduct p-2">
                                <div class="cListItemProduct space-y-2">
                                    @for ($i = 0; $i < 5; $i++)
                                        <div class="itmProduct flex items-center border mt-4 p-2 bg-slate-100 rounded-md dark:bg-darker transition duration-50 focus:outline-none hover:bg-slate-200">
                                            <div class="mainProduct flex-grow w-1/2 flex items-center gap-5">
                                                <img src="{{ asset('storage/assets/img/github.jpg') }}"
                                                    fill="black" alt=""class="w-10 aspect-square rounded-[100%] object-cover object-center border">
                                                <div class="nmeProduct mt-4">
                                                    <p class="block text-sm font-semibold">Jenis tps</p>
                                                    <span class="block text-sm text-slate-400">Unit : 1</span>
                                                </div>
                                            </div>
                                            <div class="priceDateProduct w-1/2 shrink-0 flex items-center justify-start">
                                                <div class="ctr-priceProduct flex-grow w-1/2 flex justify-start">
                                                    <div class="cPriceProduct mt-4">
                                                        <p class="text-sm font-semibold text-slate-400">Ds. Lohbener</p>
                                                    </div>
                                                </div>
                                                <div class="ctr-dateProduct flex-grow w-1/2 flex justify-center">
                                                    <div class="cDateProduct  bg-green-500 mt-4 w-fit px-2 py-1 rounded-md">
                                                        <p class="text-sm font-semibold text-white">{{ date('d/m/Y', time()) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('storage/assets/Dashboard/driver.js') }}"></script>
</div>

