{{-- <div>
    <div id="map" style="height: 500px; width: 100%; border: 2px solid red; margin-bottom: 1rem;"></div>

    <script>
        // Polling untuk memastikan Leaflet (L) sudah tersedia
        const waitForLeaflet = setInterval(function () {
            if (typeof L !== "undefined") {
                
                clearInterval(waitForLeaflet); // stop polling

                // Data lokasi dari PHP
                const lokasiList = @json($lokasiList);

                if (lokasiList.length === 0) return;

                // Hapus peta lama jika ada
                if (window.mapInstance) {
                    window.mapInstance.remove();
                }

                const map = L.map('map').setView([lokasiList[0].latitude, lokasiList[0].longitude], 13);
                window.mapInstance = map;

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
            }
        }, 100); // cek tiap 100ms
    </script>
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
</div>
 --}}
