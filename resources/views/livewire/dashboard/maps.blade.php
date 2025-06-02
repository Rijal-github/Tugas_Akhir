<div class="ctr-mainMaps">


    <div id="map" class="cMainmaps" style="height: 500px; width: 100%; border: 2px solid red; margin-bottom: 1rem;"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const lokasiList = @json($lokasiList);
        
            // Cek apakah data valid
            const hasValidLocation = Array.isArray(lokasiList) && lokasiList.length > 0;
        
            // Jika tidak ada data, gunakan default koordinat (contoh: Jakarta)
            const defaultLat = hasValidLocation ? lokasiList[0].latitude : -6.3473692;
            const defaultLng = hasValidLocation ? lokasiList[0].longitude : 108.2884701;
        
            // Inisialisasi peta dengan posisi default
            const map = L.map('map').setView([defaultLat, defaultLng], 13);
        
            // Tampilkan tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
        
            // Kalau ada lokasi, tambahkan marker dan garis
            if (hasValidLocation) {
                const routePoints = [];
        
                lokasiList.forEach(loc => {
                    const marker = L.marker([loc.latitude, loc.longitude]).addTo(map);
                    marker.bindPopup(loc.nama_lokasi);
                    routePoints.push([loc.latitude, loc.longitude]);
                });
        
                if (routePoints.length > 1) {
                    L.polyline(routePoints, { color: 'blue' }).addTo(map);
                }
            } else {
                console.log("Tidak ada data lokasi. Menampilkan peta default.");
            }
        });
        </script>
        
        {{-- <script>
            document.addEventListener("DOMContentLoaded", function () {
                if (typeof L === "undefined") {
                    console.error("Leaflet (L) is not defined. Periksa apakah script Leaflet berhasil dimuat.");
                    return;
                }
            
                const lokasiList = @json($lokasiList);
            
                const map = L.map('map').setView([lokasiList[0].latitude, lokasiList[0].longitude], 13);
            
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors',
                    maxZoom: 19
                }).addTo(map);
            
                const routePoints = [];
            
                lokasiList.forEach(loc => {
                    const marker = L.marker([loc.latitude, loc.longitude]).addTo(map);
                    marker.bindPopup(loc.nama_lokasi);
                    routePoints.push([loc.latitude, loc.longitude]);
                });
            
                if (routePoints.length > 1) {
                    L.polyline(routePoints, { color: 'blue' }).addTo(map);
                }
            });
        </script> --}}
        
    
        {{-- <script>
            document.addEventListener("DOMContentLoaded", function () {
            if (typeof L === "undefined") {
                console.error("Leaflet (L) is not defined. Periksa apakah script Leaflet berhasil dimuat.");
                return;
            }

            const lokasiList = @json($lokasiList);

            const map = L.map('map').setView([lokasiList[0].latitude, lokasiList[0].longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            const routePoints = [];

            lokasiList.forEach(loc => {
                const marker = L.marker([loc.latitude, loc.longitude]).addTo(map);
                marker.bindPopup(loc.nama_lokasi);

                routePoints.push([loc.latitude, loc.longitude]);
            });

            if (routePoints.length > 1) {
                L.polyline(routePoints, { color: 'blue' }).addTo(map);
            }
        });
    
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
        </script> --}}
    
</div>







{{-- <div>
    <div id="map" class="w-full" style="height: 500px; width: 100%; border: 2px solid red; margin-bottom: 1rem;"></div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
        setTimeout(function () {
            const lokasiList = @json($lokasiList);

            if (lokasiList.length === 0) {
                document.getElementById("map").innerHTML = "Tidak ada lokasi.";
                console.log("Lokasi:", lokasiList);
                return;
            }

            if (typeof L === "undefined") {
                console.error("Leaflet belum dimuat.");
                console.log("Leaflet object:", typeof L);
                return;
            }

            // Hapus map lama
            if (window.mapInstance) {
                window.mapInstance.remove();
            }

            const map = L.map('map').setView([lokasiList[0].latitude, lokasiList[0].longitude], 13);
            window.mapInstance = map;

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            lokasiList.forEach(loc => {
                L.marker([loc.latitude, loc.longitude]).addTo(map)
                    .bindPopup(loc.nama_lokasi);
            });
        }, 300); // Delay 300ms agar DOM siap
    });
    </script>
    @endpush
</div> --}}

        {{-- // // Polling untuk memastikan Leaflet (L) sudah tersedia
        // const waitForLeaflet = setInterval(function () {
        //     if (typeof L !== "undefined") {
        //         console.log("Leaflet L status:", typeof L);
        //         clearInterval(waitForLeaflet); // stop polling

        //         // Data lokasi dari PHP
        //         const lokasiList = @json($lokasiList);

        //         if (lokasiList.length === 0) return;

        //         // Hapus peta lama jika ada
        //         if (window.mapInstance) {
        //             window.mapInstance.remove();
        //         }

        //         const map = L.map('map').setView([lokasiList[0].latitude, lokasiList[0].longitude], 13);
        //         window.mapInstance = map;

        //         L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //             attribution: '&copy; OpenStreetMap contributors'
        //         }).addTo(map);

        //         const routePoints = [];

        //         lokasiList.forEach(loc => {
        //             const marker = L.marker([loc.latitude, loc.longitude]).addTo(map);
        //             marker.bindPopup(loc.nama_lokasi);
        //             routePoints.push([loc.latitude, loc.longitude]);
        //         });

        //         if (routePoints.length > 1) {
        //             L.polyline(routePoints, { color: 'blue' }).addTo(map);
        //         }
        //     }
        // }, 100); // cek tiap 100ms --}}
        {{-- // function initMap() {
        //     const map = new google.maps.Map(document.getElementById("map"), {
        //         zoom: 13,
        //         center: { lat: -6.327583, lng: 108.324936 }
        //     });

        //     const lokasiList = @json($lokasiList);

        //     const markers = [];
        //     const bounds = new google.maps.LatLngBounds();
        //     const waypoints = [];

        //     lokasiList.forEach(loc => {
        //         const position = new google.maps.LatLng(parseFloat(loc.latitude), parseFloat(loc.longitude));
        //         const marker = new google.maps.Marker({
        //             position: position,
        //             map: map,
        //             title: loc.nama_lokasi
        //         });

        //         markers.push(marker);
        //         bounds.extend(position);
        //         waypoints.push({
        //             location: position,
        //             stopover: true
        //         });
        //     });

        //     if (waypoints.length > 1) {
        //         const directionsService = new google.maps.DirectionsService();
        //         const directionsRenderer = new google.maps.DirectionsRenderer();
        //         directionsRenderer.setMap(map);

        //         directionsService.route({
        //             origin: waypoints[0].location,
        //             destination: waypoints[waypoints.length - 1].location,
        //             waypoints: waypoints.slice(1, -1),
        //             travelMode: google.maps.TravelMode.DRIVING
        //         }, (response, status) => {
        //             if (status === google.maps.DirectionsStatus.OK) {
        //                 directionsRenderer.setDirections(response);
        //             } else {
        //                 alert('Gagal menampilkan rute: ' + status);
        //             }
        //         });
        //     }

        //     map.fitBounds(bounds);
        // } --}}

    {{-- <script>
        function initMap() {
            const location = { lat: -6.327583, lng: 108.324936 }; // Ganti dengan lokasi kamu

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13,
                center: location,
            });

            const marker = new google.maps.Marker({
                position: location,
                map: map,
            });
        }
    </script> --}}

    {{-- <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPVDzvfsPtC5HYTxivZ71DET2PyDzZx5Y&callback=initMap">
    </script> --}}


