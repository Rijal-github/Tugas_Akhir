<div class="ctr-mainMaps z-0">
    {{-- <div class="flex items-center gap-3 mb-5 font-semibold text-lg">
        <i class="fas fa-map-location-dot"></i>
        <h2>Koordinat Tps</h2>
    </div> --}}

    <div id="map" class="cMainmaps" style="height: 500px; width: 100%; position: relative; z-index: 0;"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const lokasiList = @json($lokasiList);
        
            // Cek apakah data valid
            const hasValidLocation = Array.isArray(lokasiList) && lokasiList.length > 0;
        
            // Jika tidak ada data, gunakan default koordinat (contoh: Jakarta)
            const defaultLat = hasValidLocation ? lokasiList[0].latitude : -6.3473692;
            const defaultLng = hasValidLocation ? lokasiList[0].longitude : 108.2884701;
        
            // Inisialisasi peta dengan posisi default
            const map = L.map('map').setView([defaultLat, defaultLng], 11);
        
            // Tampilkan tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
        
            // Kalau ada lokasi, tambahkan marker dan garis
            if (hasValidLocation) {
                const routePoints = [];
        
                lokasiList.forEach(loc => {
                    const marker = L.marker([loc.latitude, loc.longitude]).addTo(map);
                    marker.bindPopup(loc.lokasi);
                    routePoints.push([loc.latitude, loc.longitude]);
                });
        
                // if (routePoints.length > 1) {
                //     L.polyline(routePoints, { color: 'blue' }).addTo(map);
                // }
            } else {
                console.log("Tidak ada data lokasi. Menampilkan peta default.");
            }
        });
        </script>
</div>

