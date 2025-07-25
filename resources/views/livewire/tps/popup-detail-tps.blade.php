@if ($showDetailPopup)
<div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-3xl p-6 overflow-y-auto max-h-[90vh]">
    <!-- Tombol Tutup -->
        <div class="text-left">
            <button wire:click="$set('showDetailPopup', false)"
                    class="px-4 py-2 text-sm text-white bg-gray-700 hover:bg-gray-800 rounded-lg transition duration-200">
                Tutup
            </button>
        </div>
        <!-- Judul & Gambar -->
        <div class="LabelJudul">
            <div class="Jdudl text-2xl font-bold text-gray-800 text-center mb-4">
                <h2>Detail Informasi TPS</h2>
            </div>
            <div class="flex items-center justify-center mb-6">
                @if ($selectedTps && $selectedTps->foto_tps)
                    <img src="{{ asset('storage/tps/' . $selectedTps->foto_tps) }}"
                         alt="Foto TPS"
                         class="w-40 h-40 object-cover rounded-lg shadow-md border border-gray-300">
                @else
                    <img src="{{ asset('storage/assets/img/github.jpg') }}"
                         alt="Foto Default"
                         class="w-40 h-40 object-cover rounded-lg shadow-md border border-gray-300">
                @endif
            </div>
        </div>

        <!-- Informasi Detail -->
        @if ($selectedTps)
        <div class="grid grid-cols-1 space-y-3 border-t border-b py-4 px-2 border-gray-200">
            <div class="flex items-center gap-3 ml-28">
                <i class="fas fa-pen-to-square text-slate-700 w-5 text-center"></i>
                <span class="w-48">Nama TPS</span>
                <span>:</span>
                <span>{{ $selectedTps->nama }}</span>
            </div>
            <div class="flex items-center gap-3 ml-28">
                <i class="fas fa-dumpster text-slate-700 w-5 text-center"></i>
                <span class="w-48">Jenis TPS</span>
                <span>:</span>
                <span>{{ $selectedTps->jenis_tps }}</span>
            </div>
            <div class="flex items-center gap-3 ml-28">
                <i class="far fa-calendar text-slate-700 w-5 text-center"></i>
                <span class="w-48">Tahun Pembuatan</span>
                <span>:</span>
                <span>{{ $selectedTps->tahun }}</span>
            </div>
            <div class="flex items-center gap-3 ml-28">
                <i class="fas fa-building text-slate-700 w-5 text-center"></i>
                <span class="w-48">UPTD</span>
                <span>:</span>
                <span>{{ $selectedTps->uptd->nama_uptd ?? '-' }}</span>
            </div>
            <div class="flex gap-3 ml-28 flex-wrap">
                <div class="flex items-start gap-3 min-w-[200px]">
                    <i class="fas fa-location-dot text-slate-700 w-5 text-center mt-1"></i>
                    <span class="w-[22rem]">Lokasi</span>
                    <span>:</span>
                    <div class="text-gray-800">
                        {{ $selectedTps->lokasi }}
                    </div>
                </div>      
            </div>
            <div class="flex items-center gap-3 ml-28">
                <i class="fas fa-location-crosshairs text-slate-700 w-5 text-center"></i>
                <span class="w-48">Latitude</span>
                <span>:</span>
                <span>{{ $selectedTps->latitude }}</span>
            </div>
            <div class="flex items-center gap-3 ml-28">
                <i class="fas fa-magnifying-glass-location text-slate-700 w-5 text-center"></i>
                <span class="w-48">Longitude</span>
                <span>:</span>
                <span>{{ $selectedTps->longitude }}</span>
            </div>
            <div class="flex items-center gap-3 ml-28">
                <i class="fas fa-align-left text-slate-700 w-5 text-center"></i>
                <span class="w-48">Keterangan</span>
                <span>:</span>
                <span>{{ $selectedTps->keterangan }}</span>
            </div>
        </div>
        @endif

        <!-- Riwayat -->
        <h3 class="text-lg font-semibold mb-3 text-gray-800 mt-6 border-b pb-1">Riwayat Pengangkutan</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-700 font-medium">
                    <tr>
                        <th class="px-4 py-2 border-b text-left">No</th>
                        <th class="px-4 py-2 border-b text-left">Nama Driver</th>
                        <th class="px-4 py-2 border-b text-left">Foto Sebelum</th>
                        <th class="px-4 py-2 border-b text-left">Foto Sesudah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($selectedTps->laporanPembersihans as $index => $laporan)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border-b">{{ $laporan->driver->name ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">
                                <img src="{{ asset('storage/' . $laporan->foto_sebelum) }}" alt="Foto Sebelum" class="w-24 h-auto rounded shadow" />
                            </td>
                            <td class="px-4 py-2 border-b">
                                 <img src="{{ asset('storage/' . $laporan->foto_sesudah) }}" alt="Foto Sesudah" class="w-24 h-auto rounded shadow" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif