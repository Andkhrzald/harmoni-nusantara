<x-app-layout>
    @section('title', 'Peta Rumah Ibadah')
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl text-primary">map</span>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Peta Rumah Ibadah Terdekat</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Action bar --}}
            <div class="flex items-center justify-between mb-4 flex-wrap gap-3">
                <button id="btn-locate"
                        class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors">
                    <span class="material-symbols-outlined text-base">my_location</span>
                    Ke Lokasi Saya
                </button>
                <span id="status-text" class="text-sm text-gray-500 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm animate-spin">progress_activity</span>
                    Mendeteksi lokasi...
                </span>
            </div>

            {{-- Map container --}}
            <div id="map" class="w-full rounded-2xl mb-6 shadow-sm overflow-hidden" style="height: 480px; background: #e5e7eb;">
                <div id="map-placeholder" class="h-full flex flex-col items-center justify-center text-gray-400 gap-3">
                    <span class="material-symbols-outlined text-6xl">map</span>
                    <p class="text-base font-medium">Klik "Dapatkan Lokasi Saya" untuk menampilkan peta</p>
                </div>
            </div>

            {{-- Place list --}}
            <div id="places-section" class="hidden">
                <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">place</span>
                    Tempat Ibadah Terdekat
                    <span id="places-count" class="text-gray-400 font-normal text-sm"></span>
                </h3>
                <div id="places-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"></div>
            </div>

            <div id="no-results" class="hidden bg-white rounded-2xl p-10 text-center text-gray-400 shadow-sm">
                <span class="material-symbols-outlined text-5xl mb-2 block">search_off</span>
                <p class="font-medium">Tidak ada rumah ibadah ditemukan di wilayah Jakarta</p>
            </div>

        </div>
    </div>

    <script>
    let mapInstance;
    let userMarker = null;
    let searchDone = false;

    // ── Inisialisasi peta + mulai deteksi lokasi real-time ────────────────────
    async function initMap() {
        const { Map }                = await google.maps.importLibrary('maps');
        const { AdvancedMarkerElement } = await google.maps.importLibrary('marker');

        document.getElementById('map-placeholder')?.remove();

        // Peta awal: tengah Jakarta sebagai fallback
        mapInstance = new Map(document.getElementById('map'), {
            center      : { lat: -6.2, lng: 106.816 },
            zoom        : 14,
            mapId       : 'DEMO_MAP_ID',
            mapTypeControl  : false,
            streetViewControl: false,
        });

        // Buat elemen pin user (akan diposisikan ulang setelah GPS ready)
        const userPin = document.createElement('div');
        userPin.style.cssText =
            'width:16px;height:16px;background:#4f46e5;border:3px solid #fff;' +
            'border-radius:50%;box-shadow:0 2px 6px rgba(0,0,0,.4)';

        userMarker = new AdvancedMarkerElement({
            position: { lat: -6.2, lng: 106.816 },
            map     : mapInstance,
            title   : 'Lokasi Saya',
            content : userPin,
        });

        // Deteksi lokasi real-time
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(
                (pos) => {
                    const center = { lat: pos.coords.latitude, lng: pos.coords.longitude };

                    // Perbarui marker posisi user
                    userMarker.position = center;

                    // Pertama kali: pindahkan peta & mulai pencarian
                    if (!searchDone) {
                        searchDone = true;
                        mapInstance.setCenter(center);
                        mapInstance.setZoom(15);
                        searchNearby(center);
                    }
                },
                (err) => {
                    console.warn('Geolocation error:', err.message);
                    document.getElementById('status-text').classList.add('hidden');
                    // Tetap tampilkan peta di Jakarta walaupun GPS gagal
                },
                { enableHighAccuracy: true, maximumAge: 5000, timeout: 10000 }
            );
        } else {
            console.warn('Geolocation tidak didukung browser ini.');
        }
    }

    // ── Cari tempat ibadah berdasarkan nama (Places Text Search legacy) ────────
    async function searchNearby(center) {
        const statusEl = document.getElementById('status-text');
        statusEl.innerHTML = '<span class="material-symbols-outlined text-sm animate-spin">progress_activity</span> Mencari tempat ibadah...';

        try {
            await google.maps.importLibrary('places');
            const service  = new google.maps.places.PlacesService(mapInstance);
            const keywords = ['masjid', 'musholla', 'gereja', 'wihara', 'kelenteng', 'pura', 'vihara'];

            const searchOne = (kw) => new Promise((resolve) => {
                service.textSearch({
                    query   : kw,
                    location: center,
                    radius  : 25000,
                }, (results, status) => {
                    resolve(
                        status === google.maps.places.PlacesServiceStatus.OK && results
                            ? results
                            : []
                    );
                });
            });

            const allResults = await Promise.all(keywords.map(searchOne));

            // Gabungkan & hapus duplikat berdasarkan place_id
            const seen   = new Set();
            const places = allResults.flat().filter(p => {
                if (seen.has(p.place_id)) { return false; }
                seen.add(p.place_id);
                return true;
            });

            statusEl.classList.add('hidden');

            if (!places.length) {
                document.getElementById('no-results').classList.remove('hidden');
                return;
            }

            // Urutkan dari yang paling dekat
            const sorted = [...places].sort((a, b) => {
                const dA = haversineKm(center.lat, center.lng, a.geometry.location.lat(), a.geometry.location.lng());
                const dB = haversineKm(center.lat, center.lng, b.geometry.location.lat(), b.geometry.location.lng());
                return dA - dB;
            });

            renderResults(sorted, center);

        } catch (err) {
            console.error('Places search error:', err);
            statusEl.classList.add('hidden');
            document.getElementById('no-results').classList.remove('hidden');
        }
    }

    // ── Hitung jarak Haversine (km) ──────────────────────────────────────────
    function haversineKm(lat1, lng1, lat2, lng2) {
        const R = 6371;
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLng = (lng2 - lng1) * Math.PI / 180;
        const a = Math.sin(dLat / 2) ** 2
                + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180)
                * Math.sin(dLng / 2) ** 2;
        return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    }

    function formatDist(km) {
        return km < 1 ? `${Math.round(km * 1000)} m` : `${km.toFixed(1)} km`;
    }

    // ── Render marker + kartu daftar ──────────────────────────────────────────
    async function renderResults(places, center) {
        const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary('marker');
        const { InfoWindow } = await google.maps.importLibrary('maps');

        document.getElementById('places-count').textContent = `(${places.length} tempat)`;
        document.getElementById('places-section').classList.remove('hidden');

        const list = document.getElementById('places-list');
        list.innerHTML = '';

        places.forEach(place => {
            const loc      = place.geometry.location;
            const name     = place.name ?? '';
            const address  = place.vicinity ?? place.formatted_address ?? '';
            const distKm   = haversineKm(center.lat, center.lng, loc.lat(), loc.lng());
            const distLabel = formatDist(distKm);

            // Pin merah untuk tempat ibadah
            const pin = new PinElement({ background: '#dc2626', borderColor: '#b91c1c', glyphColor: '#fff' });
            const marker = new AdvancedMarkerElement({
                position: loc,
                map: mapInstance,
                title: name,
                content: pin.element,
            });

            const infoWindow = new InfoWindow({
                content: `<div style="max-width:220px;padding:4px 0">
                    <p style="font-weight:700;margin:0 0 4px;font-size:14px">${name}</p>
                    <p style="font-size:12px;color:#6b7280;margin:0;line-height:1.4">${address}</p>
                    ${place.rating ? `<p style="font-size:12px;color:#d97706;margin:4px 0 0">⭐ ${place.rating}</p>` : ''}
                    <p style="font-size:12px;color:#2563eb;margin:4px 0 0">📍 ${distLabel} dari lokasi Anda</p>
                </div>`,
            });
            marker.addListener('click', () => infoWindow.open({ anchor: marker, map: mapInstance }));

            // Kartu daftar tempat
            const card = document.createElement('div');
            card.className = 'bg-white rounded-xl shadow-sm p-4 flex gap-3 hover:shadow-md transition-shadow cursor-pointer';
            card.innerHTML = `
                <div class="flex-shrink-0 w-10 h-10 bg-indigo-50 rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-indigo-600">place</span>
                </div>
                <div class="min-w-0">
                    <h4 class="font-semibold text-gray-800 text-sm leading-snug">${name}</h4>
                    <p class="text-xs text-gray-500 mt-0.5 leading-relaxed">${address}</p>
                    <div class="flex items-center gap-3 mt-1">
                        ${place.rating ? `<span class="text-xs text-amber-500">⭐ ${place.rating}</span>` : ''}
                        <span class="text-xs text-blue-600 font-medium">📍 ${distLabel}</span>
                    </div>
                </div>
            `;
            card.addEventListener('click', () => {
                mapInstance.panTo(loc);
                mapInstance.setZoom(17);
                infoWindow.open({ anchor: marker, map: mapInstance });
            });
            list.appendChild(card);
        });
    }

    // ── Tombol re-center ke lokasi user ──────────────────────────────────────────
    document.getElementById('btn-locate').addEventListener('click', function () {
        if (userMarker?.position) {
            mapInstance.panTo(userMarker.position);
            mapInstance.setZoom(15);
        } else if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (pos) => {
                    const c = { lat: pos.coords.latitude, lng: pos.coords.longitude };
                    mapInstance.panTo(c);
                    mapInstance.setZoom(15);
                },
                () => alert('Tidak dapat mengakses lokasi. Pastikan izin lokasi diaktifkan.')
            );
        }
    });
    </script>

    {{-- Google Maps Modular Loader — mendukung importLibrary() & Places API baru --}}
    <script>
    (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await(a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("key","{{ $mapsKey }}");e.set("callback",c+".maps."+q);a.src=`https://maps.googleapis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
    ({v:"weekly"});
    </script>
    <script>initMap();</script>
</x-app-layout>
