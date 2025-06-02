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
                        <div class="flex items-center gap-4">                              
                            <div class="relative group">
                                <button class="text-red-500 hover:text-red-600 transition-transform transform hover:scale-110 bg-red-100 px-2 py-1 rounded-full">
                                    <i class="fas fa-trash text-lg"></i>
                                </button>
                                <div class="absolute bottom-full mb-1 left-1/2 -translate-x-1/2 bg-gray-900 text-white px-3 py-1 text-xs rounded-md opacity-0 group-hover:opacity-100 group-hover:translate-y-[-6px] transition-all duration-300">
                                    Hapus
                                </div>
                            </div>
                            
                            @livewire('driver.driver-form')
                        </div>

                        
                    </div>
                    <div class="ctr-listDataMainUser body-listShwAllData">
                        <div class="cListDataMainUser">
                                {{-- @foreach ($supirs as $supir)
                                    <div class="ctr-itmContentMainUser px-2 py-1" data-supir-id="{{ $supir->id_supir }}">
                                        <div
                                            class="cItmContentMainUser row-dataItem flex items-center justify-between p-4 mb-2 bg-slate-100 rounded-md dark:bg-darker transition duration-50 focus:outline-none hover:bg-slate-200">
                                            <div class="lftContent flex items-center gap-4">
                                                <div class="selectThsItm flex items-center justify-center shrink-0">
                                                    <input type="checkbox" name="" id=""
                                                        class="checkDataElemn rounded-md focus:ring-0 focus:ring-transparent cursor-pointer">
                                                </div>
                                                <div class="summUser flex items-center gap-2">
                                                    <img src="{{ asset('storage/assets/img/github.jpg') }}"
                                                        fill="black" alt=""
                                                        class="w-7 h-7 rounded-[100%] object-cover object-center">
                                                    <div class="nmeUser ">
                                                        <p class="block text-sm">{{ $supir->nama_supir }}</p>
                                                        <span
                                                            class="block text-xs text-slate-400">{{ $supir->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="flex size-10 shrink-0 items-center justify-start rounded-full relative">
                                                <span class="icon">
                                                    <i class="fas fa-chevron-right text-xl text-slate-400"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach --}}
                        </div>
                    </div>
                </div>
          
            </div>
            <div id="userDetail" class="ctr-detailMainUser flex-grow rounded-2xl border mt-2 hidden">
                <div class="cDetailMainUser p-4 rounded-2xl">
                    <div class="summUser flex items-center justify-between gap-5 border-b p-4">
                        <div class="flex items-center gap-5">
                            <img src="{{ asset('storage/assets/img/github.jpg') }}" alt=""class="w-24 aspect-square rounded-[100%] object-cover object-center border border-black">
                            {{-- <div class="nmeUser ">
                                <p class="block text-xl font-bold">{{ $supir->nama_supir }}</p>
                                <span class="block text-sm text-slate-400">{{ $supir->email }}</span>
                            </div> --}}
                            
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
                    
                    <div class="border-b p-3">
                        <div class="flex items-center text-slate-300 gap-5 mt-3">
                            <i class="fas fa-phone"></i>
                            <p class="">Phone</p>
                                <div>
                                    <p class="text-end">:</p>
                                </div>
                        </div>
                        <div class="flex items-center text-slate-300 gap-5 mt-3">
                            <i class="far fa-envelope"></i>
                            <p class="">Email</p>
                                <div>
                                    <p class="text-end">:</p>
                                </div>
                        </div>
                    </div>
                    <div class="ctr-roleUserProfile mt-4">
                        <div class="cRoleUserProfile">
                            <div class="headRoleUserProfile">
                                <div class="txSince text-xs font-semibold">
                                    <p>Status</p>
                                </div>
                            </div>
                            <div class="ctr-listRoleUser mt-1">
                                <div class="cListRoleUser flex items-center flex-wrap gap-1 text-xs">
                                    <div class="ctr-itmRoleUser group relative">
                                        <div class="cItemRoleUser flex items-center gap-2 px-2 py-0.5 bg-gray-200 rounded-md">
                                            <span class="iconCircle text-red-600">
                                                <i class="fas fa-circle"></i>
                                            </span>
                                            <div class="txRole">
                                                <p>Driver</p>
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
                                    <p>{{ Carbon\Carbon::parse(Auth::user()->created_at)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ctr-mainItemProduct bg-white">
                         <div class="cMainItemProduct">
                            <div class="ctr-headMainItemProduct">
                                <div class="cHeadMainItemProduct flex items-center border-b p-4">
                                    <div class="mainHeadItemProduct flex-grow w-1/2 ml-20">
                                        <h2 class="text-lg font-semibold text-slate-500">Product</h2>
                                    </div>
                                    <div class="priceDateHeadItemProduct w-1/2 shrink-0 flex">
                                        <div class="priceHeadItemProduct flex-grow w-1/2 text-balance">
                                            <h2 class="text-lg font-semibold text-slate-500">Price</h2>
                                        </div>
                                        <div class="dateHeadItemProduct flex-grow w-1/2 text-center">
                                            <h2 class="text-lg font-semibold text-slate-500">Date</h2>                                  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ctr-listItemProduct p-2">
                                <div class="cListItemProduct space-y-2">
                                    @for ($i = 0; $i < 10; $i++)
                                        <div class="itmProduct flex items-center border mt-4 p-2 bg-slate-100 rounded-md dark:bg-darker transition duration-50 focus:outline-none hover:bg-slate-200">
                                            <div class="mainProduct flex-grow w-1/2 flex items-center gap-5">
                                                <img src="{{ asset('storage/assets/img/github.jpg') }}"
                                                    fill="black" alt=""class="w-10 aspect-square rounded-[100%] object-cover object-center border">
                                                <div class="nmeProduct mt-4">
                                                    <p class="block text-sm font-semibold">Product title</p>
                                                    <span class="block text-sm text-slate-400">Deskription Shop</span>
                                                </div>
                                            </div>
                                            <div class="priceDateProduct w-1/2 shrink-0 flex items-center justify-start">
                                                <div class="ctr-priceProduct flex-grow w-1/2 flex justify-start">
                                                    <div class="cPriceProduct bg-green-500 mt-4 w-fit px-2 py-1 rounded-md">
                                                        <p class="text-sm font-semibold text-white">Rp.{{ number_format(mt_rand(10, 100) * 1000) }}</p>
                                                    </div>
                                                </div>
                                                <div class="ctr-dateProduct flex-grow w-1/2 flex justify-center">
                                                    <div class="cDateProduct mt-4">
                                                        <p class="text-sm font-semibold text-slate-400">{{ date('d/m/Y', time()) }}</p>
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

