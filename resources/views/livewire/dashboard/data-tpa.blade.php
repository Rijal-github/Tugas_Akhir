<div class="bg-white rounded-2xl shadow-md p-6 w-full">
    <div class="flex justify-between items-start mb-4">
        <h2 class="text-lg font-bold text-gray-800">Data TPA</h2>
        <span class="text-green-500 text-sm font-semibold">+2.45%</span>
    </div>

    <div class="h-40 flex items-end gap-3">
        @foreach([40, 20, 35, 25, 38, 42, 10] as $val)
            <div class="w-3 flex flex-col justify-end">
                <div class="h-full bg-indigo-100 rounded-t-full flex items-end">
                    <div class="w-full bg-indigo-600 rounded-t-full" style="height: {{ $val }}%;"></div>
                </div>
            </div>
        @endforeach
    </div>
</div>

