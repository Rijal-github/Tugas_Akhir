<div x-show="showDetailPopup" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-xl p-6 w-full max-w-3xl relative shadow-xl">
        <!-- Tombol close -->
        <button @click="showDetailPopup = false" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-2xl font-semibold bg-slate-100 hover:bg-slate-200 rounded-full px-3 py-1 items-center">
            &times;
        </button>
        <div class="LabelJudul">
            <div class="Jdudl text-2xl font-bold text-gray-800 text-center">
                <!-- Judul utama -->
                <h2>Detail Informasi</h2>
            </div>
            <!-- Gambar -->
            <div class=" flex items-center justify-center mb-4">
                <img src="{{ asset('storage/assets/img/github.jpg') }}" alt="avatar" class="w-40 h-40 object-cover rounded-lg shadow-md border border-gray-300">
            </div>
        </div>

        <!-- Informasi -->
        <div class="grid grid-cols-1 border-b space-y-3 border border-black">
            <div class="flex items-center ml-[7rem] gap-3">
                <i class="fas fa-pen-to-square text-slate-700 w-5 text-center"></i>
                <span class="w-48">Nama TPS</span>
                <span>:</span>
                <span id="detailJenis"></span>
            </div>
            <div class="flex items-center ml-[7rem] gap-3">
                <i class="fas fa-dumpster text-slate-700 w-5 text-center"></i>
                <span class="w-48">Jenis TPS</span>
                <span>:</span>
                <span id="detailNoPolisi"></span>
            </div>
            <div class="flex items-center ml-[7rem] gap-3">
                <i class="far fa-calendar text-slate-700 w-5 text-center"></i>
                <span class="w-48">Tahun Pembuatan</span>
                <span>:</span>
                <span id="detailKapasitas"></span>
            </div>
            <div class="flex items-center ml-[7rem] gap-3">
                <i class="fas fa-location-dot text-slate-700 w-5 text-center"></i>
                <span class="w-48">Lokasi</span>
                <span>:</span>
                <span id="detailEmail2"></span>
            </div>
            <div class="flex items-center ml-[7rem] gap-3">
                <i class="fas fa-location-crosshairs text-slate-700 w-5 text-center"></i>
                <span class="w-48">Lattitude</span>
                <span>:</span>
                <span id="detailPhone"></span>
            </div>
            <div class="flex items-center ml-[7rem] gap-3">
                <i class="fas fa-magnifying-glass-location text-slate-700 w-5 text-center"></i>
                <span class="w-48">Longitude</span>
                <span>:</span>
                <span id="detail-address"></span>
            </div>
        </div>
        <!-- Riwayat -->
        <h3 class="text-lg font-semibold mb-3 text-gray-800 border-b pb-1">Riwayat Pengangkutan</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-700 font-medium">
                    <tr>
                        <th class="px-4 py-2 border-b text-left">No</th>
                        <th class="px-4 py-2 border-b text-left">Nama Driver</th>
                        <th class="px-4 py-2 border-b text-left">Tanggal</th>
                        <th class="px-4 py-2 border-b text-left">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">1</td>
                        <td class="px-4 py-2 border-b">Ahmad</td>
                        <td class="px-4 py-2 border-b">2024-06-01</td>
                        <td class="px-4 py-2 border-b">Selesai</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">2</td>
                        <td class="px-4 py-2 border-b">Budi</td>
                        <td class="px-4 py-2 border-b">2024-06-15</td>
                        <td class="px-4 py-2 border-b">Tepat Waktu</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">3</td>
                        <td class="px-4 py-2 border-b">Dewi</td>
                        <td class="px-4 py-2 border-b">2024-07-01</td>
                        <td class="px-4 py-2 border-b">Terlambat</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">4</td>
                        <td class="px-4 py-2 border-b">Rian</td>
                        <td class="px-4 py-2 border-b">2024-07-10</td>
                        <td class="px-4 py-2 border-b">Selesai</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">5</td>
                        <td class="px-4 py-2">Sari</td>
                        <td class="px-4 py-2">2024-07-15</td>
                        <td class="px-4 py-2">Proses</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

