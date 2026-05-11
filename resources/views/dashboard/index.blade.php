<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Selamat Datang, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600">Ini adalah halaman dashboard Anda untuk melihat aktivitas dan progres belajar.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('dashboard.donations') }}" class="p-6 bg-white shadow-sm sm:rounded-lg hover:bg-gray-50 transition">
                    <h4 class="font-semibold text-gray-800">Riwayat Donasi</h4>
                    <p class="text-sm text-gray-500 mt-2">Lihat campaign donasi Anda</p>
                </a>

                <a href="{{ route('dashboard.learning') }}" class="p-6 bg-white shadow-sm sm:rounded-lg hover:bg-gray-50 transition">
                    <h4 class="font-semibold text-gray-800">Progres Belajar</h4>
                    <p class="text-sm text-gray-500 mt-2">Konten yang telah Anda baca</p>
                </a>

                <a href="{{ route('dashboard.consultations') }}" class="p-6 bg-white shadow-sm sm:rounded-lg hover:bg-gray-50 transition">
                    <h4 class="font-semibold text-gray-800">Konsultasi</h4>
                    <p class="text-sm text-gray-500 mt-2">Riwayat konsultasi dengan penyuluh</p>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-4">Informasi Akun</h4>
                    <dl class="space-y-2">
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Email:</dt>
                            <dd class="text-gray-900">{{ Auth::user()->email }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Role:</dt>
                            <dd class="text-gray-900 capitalize">{{ Auth::user()->role }}</dd>
                        </div>
                        @if(Auth::user()->religion_preference)
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Agama:</dt>
                            <dd class="text-gray-900 capitalize">{{ Auth::user()->religion_preference }}</dd>
                        </div>
                        @endif
                    </dl>
                    <a href="{{ route('profile.edit') }}" class="inline-block mt-4 text-sm text-indigo-600 hover:text-indigo-800">
                        Edit Profil →
                    </a>
                </div>

                <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-4">Akses Cepat</h4>
                    <div class="space-y-2">
                        <a href="{{ route('edukasi.index') }}" class="block text-indigo-600 hover:text-indigo-800">📚 Jelajahi Edukasi</a>
                        <a href="{{ route('ibadah.index') }}" class="block text-indigo-600 hover:text-indigo-800">🕌 Jadwal Ibadah</a>
                        <a href="{{ route('aksi.donasi.index') }}" class="block text-indigo-600 hover:text-indigo-800">💝 Donasi</a>
                        <a href="{{ route('aksi.volunteers.index') }}" class="block text-indigo-600 hover:text-indigo-800">🤝 Jadi Relawan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>