<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jadwal Ibadah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <form action="{{ route('ibadah.schedule') }}" method="get" class="flex gap-4">
                    <select name="city" class="border rounded-lg px-4 py-2">
                        <option value="Jakarta" {{ $city == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                        <option value="Bandung" {{ $city == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                        <option value="Surabaya" {{ $city == 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
                        <option value="Medan" {{ $city == 'Medan' ? 'selected' : '' }}>Medan</option>
                    </select>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">Cari</button>
                </form>
            </div>

            @if($todayTimes)
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <h3 class="font-semibold text-lg mb-4">Jadwal Salat Hari Ini ({{ now()->format('d M Y') }})</h3>
                <div class="grid grid-cols-3 md:grid-cols-6 gap-4 text-center">
                    @foreach(['Fajr' => 'Subuh', 'Sunrise' => 'Terbit', 'Dhuhr' => 'Zuhur', 'Asr' => 'Asar', 'Maghrib' => 'Magrib', 'Isha' => 'Isya'] as $key => $name)
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">{{ $name }}</p>
                        <p class="text-xl font-bold text-indigo-600">{{ $todayTimes[$key] ?? '-' }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if(count($holidays) > 0)
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="font-semibold text-lg mb-4">Hari Besar Bulan Ini</h3>
                <div class="space-y-3">
                    @foreach($holidays as $holiday)
                    <div class="flex justify-between items-center border-b pb-2">
                        <span>{{ $holiday['name'] ?? 'Hari Besar' }}</span>
                        <span class="text-sm text-gray-500">{{ $holiday['date']['iso'] ?? '' }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>