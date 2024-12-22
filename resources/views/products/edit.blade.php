<x-app-layout>
    <x-slot name="header">
        <h2>{{ __('Edit Product') }}</h2>
    </x-slot>

    <x-slot name="app_asset">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    </x-slot>

    <div class="container">
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i>
                Back</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                            placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Detail:</strong>
                        <textarea class="form-control" name="detail" placeholder="Detail" style="height:150px">{{ $product->detail }}</textarea>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="latitude">Latitude:</label>
                        <input type="text" id="latitude" name="latitude" value="{{ $product->latitude }}"
                            class="form-control" readonly>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="longitude">Longitude:</label>
                        <input type="text" id="longitude" name="longitude" value="{{ $product->longitude }}"
                            class="form-control" readonly>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 pt-2">
                    <div id="map" style="height: 250px;"></div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btn-sm mb-2 mt-2"><i
                            class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
            </div>
        </form>
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
