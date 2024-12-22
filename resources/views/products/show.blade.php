<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Show Products') }}
        </h2>
    </x-slot>
    <x-slot name="app_asset">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $product->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Details:</strong>
                    {{ $product->detail }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Harga:</strong>
                    {{ $product->price}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Latitude:</strong>
                    {{ $product->latitude}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Longitude:</strong>
                    {{ $product->longitude}}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 pt-2">
                <div id="map" style="height: 250px;"></div>
            </div>
        </div>
    </div>
<x-slot name="page_script">
    <script>
        // Ambil data latitude dan longitude dari input form
        var initialLat = {{ $product->latitude }};
        var initialLng = {{ $product->longitude }};

        // Inisialisasi peta
        var map = L.map('map').setView([initialLat, initialLng], 13);
        var marker = L.marker([initialLat, initialLng]).addTo(map);

        // Tambahkan tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Event klik pada peta
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            // Perbarui form latitude dan longitude
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // Pindahkan marker ke lokasi baru
            marker.setLatLng(e.latlng);
        });
    </script>
</x-slot>
</x-app-layout>
