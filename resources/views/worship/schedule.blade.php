@php
    $prayerNames = [
        'Fajr' => 'Subuh', 'Sunrise' => 'Terbit', 'Dhuhr' => 'Zuhur',
        'Asr' => 'Asar', 'Maghrib' => 'Magrib', 'Isha' => 'Isya',
    ];
    $prayerIcons = [
        'Fajr' => 'wb_twilight', 'Sunrise' => 'wb_sunny', 'Dhuhr' => 'light_mode',
        'Asr' => 'light_mode', 'Maghrib' => 'nightlight', 'Isha' => 'dark_mode',
    ];
    $nextKey = null;
    $nowTime = now()->format('H:i');
    if ($todayTimes) {
        foreach (['Fajr', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'] as $key) {
            if (isset($todayTimes[$key]) && $todayTimes[$key] > $nowTime) {
                $nextKey = $key;
                break;
            }
        }
        if (!$nextKey) $nextKey = 'Fajr';
    }
    $cities = ['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Makassar', 'Yogyakarta', 'Semarang', 'Palembang'];
@endphp

<x-app-layout>
    @section('title', 'Jadwal Sholat')
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl text-primary">schedule</span>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jadwal Sholat</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Hero --}}
            <div class="bg-gradient-to-r from-emerald-900 via-primary to-emerald-700 rounded-2xl p-6 sm:p-8 mb-6 text-white">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <span class="material-symbols-outlined text-5xl text-white/60">mosque</span>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold">Jadwal Sholat</h1>
                            <p class="text-white/70 text-sm mt-1">{{ now()->format('l, d F Y') }}</p>
                        </div>
                    </div>
                    <form action="{{ route('ibadah.schedule') }}" method="get" class="flex items-center gap-2">
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-white/50 text-sm">location_city</span>
                            <select name="city" onchange="this.form.submit()"
                                    class="appearance-none bg-white/15 hover:bg-white/25 text-white border border-white/20 rounded-xl pl-9 pr-8 py-2 text-sm
                                           focus:outline-none focus:ring-2 focus:ring-white/30 cursor-pointer transition-colors">
                                @foreach ($cities as $c)
                                    <option value="{{ $c }}" {{ $city === $c ? 'selected' : '' }} class="text-gray-800">{{ $c }}</option>
                                @endforeach
                            </select>
                            <span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-white/50 text-sm">expand_more</span>
                        </div>
                        <noscript><button type="submit" class="bg-white/20 text-white px-3 py-2 rounded-xl text-sm">Cari</button></noscript>
                    </form>
                </div>
            </div>

            {{-- Prayer times grid --}}
            @if ($todayTimes)
                <div class="bg-white shadow-sm rounded-2xl p-6 sm:p-8 mb-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">today</span>
                            Jadwal Sholat <span class="text-primary font-bold">{{ $city }}</span>
                        </h3>
                        @if ($nextKey)
                            <span class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">alarm</span>
                                Berikutnya: {{ $prayerNames[$nextKey] ?? $nextKey }} {{ $todayTimes[$nextKey] ?? '' }}
                            </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                        @foreach (['Fajr', 'Sunrise', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'] as $key)
                            @php
                                $name = $prayerNames[$key] ?? $key;
                                $isNext = $key === $nextKey;
                                $isSunrise = $key === 'Sunrise';
                            @endphp
                            <div class="relative rounded-xl p-4 text-center transition-all duration-200
                                        {{ $isNext ? 'bg-gradient-to-br from-emerald-50 to-emerald-100 ring-2 ring-emerald-400 shadow-md scale-105' : 'bg-gray-50 hover:bg-gray-100' }}
                                        {{ $isSunrise ? 'opacity-70' : '' }}">
                                @if ($isNext)
                                    <span class="absolute -top-2 -right-2 bg-emerald-500 text-white text-[10px] px-2 py-0.5 rounded-full font-semibold shadow">SEKARANG</span>
                                @endif
                                <span class="material-symbols-outlined text-2xl {{ $isNext ? 'text-emerald-600' : ($isSunrise ? 'text-amber-400' : 'text-gray-400') }}">
                                    {{ $prayerIcons[$key] ?? 'schedule' }}
                                </span>
                                <p class="text-sm font-medium mt-1 {{ $isNext ? 'text-emerald-800' : 'text-gray-500' }}">{{ $name }}</p>
                                <p class="text-lg font-bold mt-0.5 {{ $isNext ? 'text-emerald-700' : 'text-gray-800' }}">
                                    {{ $todayTimes[$key] ?? '-' }}
                                </p>
                                @if ($isSunrise)
                                    <p class="text-[10px] text-amber-500 mt-0.5">(terbit)</p>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    {{-- Info metode perhitungan --}}
                    <p class="text-xs text-gray-400 mt-4 flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">info</span>
                        Waktu sholat untuk {{ $city }}, Indonesia — Metode Kemenag RI (Aladhan API)
                    </p>
                </div>
            @else
                {{-- Fallback statis jika API gagal --}}
                @php
                    $fallback = [
                        'Fajr' => '04:20', 'Sunrise' => '05:35', 'Dhuhr' => '11:52',
                        'Asr' => '15:10', 'Maghrib' => '17:45', 'Isha' => '19:00',
                    ];
                @endphp
                <div class="bg-white shadow-sm rounded-2xl p-6 sm:p-8 mb-6">
                    <div class="flex items-center gap-2 text-amber-600 bg-amber-50 px-4 py-2 rounded-lg mb-4 text-sm">
                        <span class="material-symbols-outlined text-sm">cloud_off</span>
                        Tidak dapat mengambil data dari server. Menampilkan waktu perkiraan untuk {{ $city }}.
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                        @foreach (['Fajr', 'Sunrise', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'] as $key)
                            @php $name = $prayerNames[$key] ?? $key; @endphp
                            <div class="bg-gray-50 rounded-xl p-4 text-center">
                                <span class="material-symbols-outlined text-2xl text-gray-400">{{ $prayerIcons[$key] ?? 'schedule' }}</span>
                                <p class="text-sm font-medium mt-1 text-gray-500">{{ $name }}</p>
                                <p class="text-lg font-bold mt-0.5 text-gray-800">{{ $fallback[$key] ?? '-' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Hari Besar --}}
            @if (!empty($holidays) && count($holidays) > 0)
                <div class="bg-white shadow-sm rounded-2xl p-6 sm:p-8">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">celebration</span>
                        Hari Besar Bulan {{ now()->translatedFormat('F') }}
                    </h3>
                    <div class="space-y-2">
                        @foreach ($holidays as $holiday)
                            <div class="flex items-center justify-between px-4 py-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-amber-500">star</span>
                                    <span class="font-medium text-gray-700">{{ $holiday['name'] ?? 'Hari Besar' }}</span>
                                </div>
                                <span class="text-sm text-gray-400">{{ \Carbon\Carbon::parse($holiday['date']['iso'] ?? '')->translatedFormat('d M Y') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
