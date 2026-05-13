<x-app-layout>
    @section('title', 'Peta Rumah Ibadah')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peta Rumah Ibadah Terdekat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <button onclick="getLocation()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
                    📍 Dapatkan Lokasi Saya
                </button>
            </div>

            <div id="map" class="w-full h-96 bg-gray-200 rounded-lg mb-6 flex items-center justify-center">
                <p class="text-gray-500">Klik "Dapatkan Lokasi Saya" untuk menampilkan peta</p>
            </div>

            <div id="results" class="space-y-4">
                @foreach($places as $place)
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <h4 class="font-semibold">{{ $place['displayName']['text'] ?? 'Rumah Ibadah' }}</h4>
                    <p class="text-sm text-gray-500">{{ $place['formattedAddress'] ?? '' }}</p>
                    @if($place['rating'])
                    <p class="text-sm text-yellow-600">⭐ {{ $place['rating'] }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                window.location.href = `/ibadah/peta?lat=${lat}&lng=${lng}`;
            });
        } else {
            alert('Geolocation tidak didukung oleh browser ini');
        }
    }
    </script>
</x-app-layout>