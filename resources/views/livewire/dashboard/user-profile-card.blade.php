
<div class="bg-white rounded-2xl shadow-md p-6 w-full text-center">
    <div class="flex justify-center border border-black">
        <img src="{{ asset('storage/assets/img/github.jpg') }}" alt="avatar" class="w-40 h-40 border border-black rounded-full mb-4">
    </div>
    <h2 class="font-bold text-lg text-gray-800">{{ $userName }}</h2>
    <p class="text-sm text-gray-400 flex items-center justify-center gap-1">
        <i class="fas fa-map-marker-alt"></i> {{ $addres }}
    </p>

    <div class="mt-6 grid grid-cols-3 gap-1 text-xs text-gray-600 font-medium">
        <div class="flex flex-col">
            <span class="text-gray-400">Bagian</span>
            <span class="text-indigo-600 font-semibold">{{ $userName }}</span>
        </div>
        <div class="flex flex-col">
            <span class="text-gray-400">Status</span>
            <span class="text-indigo-600 font-semibold">{{ $userName }}</span>
        </div>
        <div class="flex items-center justify-center">
            <a href="#" class="text-indigo-600 hover:underline text-sm flex items-center gap-1">
                View More <i class="fas fa-chevron-right text-xs"></i>
            </a>
        </div>
    </div>
</div>

