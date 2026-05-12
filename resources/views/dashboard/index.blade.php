<x-app-layout>
    @php
        $user = Auth::user();
        $initial = strtoupper(substr($user->name, 0, 1));
    @endphp

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl text-primary">dashboard</span>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome card --}}
            <div class="bg-gradient-to-r from-primary-800 to-primary rounded-2xl p-6 sm:p-8 text-white">
                <div class="flex items-start sm:items-center justify-between flex-col sm:flex-row gap-4">
                    <div class="flex items-center gap-4">
                        <span class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                            {{ $initial }}
                        </span>
                        <div>
                            <h1 class="text-xl sm:text-2xl font-bold">Selamat Datang, {{ $user->name }}!</h1>
                            <p class="text-white/70 text-sm mt-0.5">{{ $user->email }}</p>
                            @if ($user->religion_preference)
                                <span class="inline-flex items-center gap-1 mt-2 text-xs bg-white/15 text-white/90 px-3 py-1 rounded-full">
                                    <span class="material-symbols-outlined text-sm">favorite</span>
                                    {{ ucfirst($user->religion_preference) }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('profile.edit') }}"
                       class="inline-flex items-center gap-1.5 text-sm bg-white/15 hover:bg-white/25 text-white px-4 py-2 rounded-xl transition-all">
                        <span class="material-symbols-outlined text-sm">edit</span>
                        Edit Profil
                    </a>
                </div>
            </div>

            {{-- Stats cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-50 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-400 font-medium">Donasi</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">0</p>
                        </div>
                        <span class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-emerald-600">volunteer_activism</span>
                        </span>
                    </div>
                    <a href="{{ route('dashboard.donations') }}" class="text-xs text-emerald-600 hover:text-emerald-700 mt-3 inline-flex items-center gap-0.5">
                        Lihat riwayat <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </a>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-50 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-400 font-medium">Konten Dibaca</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">0</p>
                        </div>
                        <span class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-blue-600">menu_book</span>
                        </span>
                    </div>
                    <a href="{{ route('dashboard.learning') }}" class="text-xs text-blue-600 hover:text-blue-700 mt-3 inline-flex items-center gap-0.5">
                        Progres belajar <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </a>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-50 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-400 font-medium">Konsultasi</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">0</p>
                        </div>
                        <span class="w-10 h-10 rounded-xl bg-secondary-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-secondary">forum</span>
                        </span>
                    </div>
                    <a href="{{ route('dashboard.consultations') }}" class="text-xs text-secondary hover:text-secondary-700 mt-3 inline-flex items-center gap-0.5">
                        Lihat konsultasi <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </a>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-50 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-400 font-medium">Role</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1 capitalize">{{ $user->role }}</p>
                        </div>
                        <span class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-amber-600">badge</span>
                        </span>
                    </div>
                    <p class="text-xs text-gray-400 mt-3">Akun terdaftar</p>
                </div>
            </div>

            {{-- Quick access & info --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Quick Access --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-50">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">explore</span>
                        Akses Cepat
                    </h3>
                    <div class="space-y-2">
                        @php
                            $quickLinks = [
                                ['route' => 'edukasi.index', 'icon' => 'school', 'label' => 'Jelajahi Edukasi', 'color' => 'text-emerald-600', 'bg' => 'bg-emerald-50'],
                                ['route' => 'ibadah.schedule', 'icon' => 'schedule', 'label' => 'Jadwal Sholat', 'color' => 'text-primary', 'bg' => 'bg-primary-50'],
                                ['route' => 'ibadah.index', 'icon' => 'self_improvement', 'label' => 'Panduan Ibadah', 'color' => 'text-secondary', 'bg' => 'bg-secondary-50'],
                                ['route' => 'aksi.donasi.index', 'icon' => 'volunteer_activism', 'label' => 'Donasi', 'color' => 'text-red-600', 'bg' => 'bg-red-50'],
                                ['route' => 'aksi.volunteers.index', 'icon' => 'groups', 'label' => 'Jadi Relawan', 'color' => 'text-blue-600', 'bg' => 'bg-blue-50'],
                                ['route' => 'aksi.cek-fakta.index', 'icon' => 'fact_check', 'label' => 'Cek Fakta', 'color' => 'text-amber-600', 'bg' => 'bg-amber-50'],
                            ];
                        @endphp
                        @foreach ($quickLinks as $link)
                            <a href="{{ route($link['route']) }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 transition-colors group">
                                <span class="w-9 h-9 rounded-lg {{ $link['bg'] }} flex items-center justify-center">
                                    <span class="material-symbols-outlined text-sm {{ $link['color'] }}">{{ $link['icon'] }}</span>
                                </span>
                                <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">{{ $link['label'] }}</span>
                                <span class="material-symbols-outlined text-sm ml-auto text-gray-300 group-hover:text-gray-500">arrow_forward</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Info Akun --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-50">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">info</span>
                        Informasi Akun
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between px-4 py-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-500">Email</span>
                            <span class="text-sm font-medium text-gray-800">{{ $user->email }}</span>
                        </div>
                        <div class="flex items-center justify-between px-4 py-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-500">Role</span>
                            <span class="text-sm font-medium text-gray-800 capitalize">{{ $user->role }}</span>
                        </div>
                        @if ($user->religion_preference)
                            <div class="flex items-center justify-between px-4 py-3 bg-gray-50 rounded-xl">
                                <span class="text-sm text-gray-500">Preferensi Agama</span>
                                <span class="text-sm font-medium text-gray-800 capitalize">{{ $user->religion_preference }}</span>
                            </div>
                        @endif
                        <div class="flex items-center justify-between px-4 py-3 bg-gray-50 rounded-xl">
                            <span class="text-sm text-gray-500">Bergabung Sejak</span>
                            <span class="text-sm font-medium text-gray-800">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</span>
                        </div>
                    </div>
                    <a href="{{ route('profile.edit') }}"
                       class="mt-4 inline-flex items-center gap-1 text-sm text-primary hover:text-primary-700 font-medium">
                        <span class="material-symbols-outlined text-sm">settings</span>
                        Kelola Profil
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
