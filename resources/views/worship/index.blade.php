<x-app-layout>
    @section('title', 'Asisten Ibadah')
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl text-primary">self_improvement</span>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Asisten Ibadah</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Jadwal Ibadah --}}
                <a href="{{ route('ibadah.jadwal') }}" class="group relative bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <span class="material-symbols-outlined text-4xl text-emerald-600 relative">schedule</span>
                    <h3 class="font-semibold text-gray-800 mt-3 relative">Jadwal Sholat</h3>
                    <p class="text-sm text-gray-500 mt-1 relative">Waktu salat 5 waktu dan hari besar Islam</p>
                </a>

                {{-- Peta --}}
                <a href="{{ route('ibadah.peta') }}" class="group relative bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <span class="material-symbols-outlined text-4xl text-blue-600 relative">map</span>
                    <h3 class="font-semibold text-gray-800 mt-3 relative">Peta Rumah Ibadah</h3>
                    <p class="text-sm text-gray-500 mt-1 relative">Temukan masjid, gereja, pura, vihara terdekat</p>
                </a>

                {{-- Panduan Ritual --}}
                <a href="{{ route('ibadah.panduan', 'islam') }}" class="group relative bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-secondary-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <span class="material-symbols-outlined text-4xl text-secondary relative">live_help</span>
                    <h3 class="font-semibold text-gray-800 mt-3 relative">Panduan Ibadah</h3>
                    <p class="text-sm text-gray-500 mt-1 relative">Tata cara ibadah 6 agama di Indonesia</p>
                </a>

                {{-- Etiket --}}
                <a href="{{ route('ibadah.etiket', 'islam') }}" class="group relative bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <span class="material-symbols-outlined text-4xl text-amber-600 relative">account_balance</span>
                    <h3 class="font-semibold text-gray-800 mt-3 relative">Etiket Bertamu</h3>
                    <p class="text-sm text-gray-500 mt-1 relative">Tata krama mengunjungi rumah ibadah</p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
