<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asisten Ibadah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('ibadah.schedule') }}" class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md text-center">
                    <span class="text-4xl">🕌</span>
                    <h3 class="font-semibold mt-3">Jadwal Ibadah</h3>
                    <p class="text-sm text-gray-500">Jadwal salat dan hari besar keagamaan</p>
                </a>

                <a href="{{ route('ibadah.map') }}" class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md text-center">
                    <span class="text-4xl">🗺️</span>
                    <h3 class="font-semibold mt-3">Peta Rumah Ibadah</h3>
                    <p class="text-sm text-gray-500">Temukan rumah ibadah terdekat</p>
                </a>

                <a href="{{ route('ibadah.guide', 'islam') }}" class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md text-center">
                    <span class="text-4xl">📖</span>
                    <h3 class="font-semibold mt-3">Panduan Ritual</h3>
                    <p class="text-sm text-gray-500">Tata cara ibadah per agama</p>
                </a>

                <a href="{{ route('ibadah.etiquette', 'islam') }}" class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md text-center">
                    <span class="text-4xl">🤝</span>
                    <h3 class="font-semibold mt-3">Etiket Bertamu</h3>
                    <p class="text-sm text-gray-500">Cara посещения rumah ibadah agama lain</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>