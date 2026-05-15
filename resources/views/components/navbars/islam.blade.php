@props(['activeRoute' => ''])

@php
    $prayerTimes = [
        ['name' => 'Subuh',  'time' => '04:20', 'icon' => 'wb_twilight'],
        ['name' => 'Zuhur',  'time' => '11:52', 'icon' => 'wb_sunny'],
        ['name' => 'Asar',   'time' => '15:10', 'icon' => 'light_mode'],
        ['name' => 'Magrib', 'time' => '17:45', 'icon' => 'nightlight'],
        ['name' => 'Isya',   'time' => '19:00', 'icon' => 'dark_mode'],
    ];

    $nextPrayer = collect($prayerTimes)->first(
        fn($p) => $p['time'] > now()->format('H:i')
    ) ?: $prayerTimes[0];

    $isActive = fn($patterns) => collect((array) $patterns)->contains(
        fn($p) => str_starts_with($activeRoute, $p)
    );
@endphp

<nav x-data="{ mobile: false, prayerOpen: false }"
     class="bg-gradient-to-r from-emerald-900 via-primary to-emerald-700 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <span class="material-symbols-outlined text-accent-gold text-3xl
                                 group-hover:scale-110 transition-transform duration-300">
                        mosque
                    </span>
                    <div>
                        <span class="text-white font-bold text-lg tracking-tight">
                            Harmoni<span class="text-accent-gold">Nusantara</span>
                        </span>
                        <p class="text-[11px] text-emerald-200/80 -mt-0.5" style="font-family: 'Amiri', serif;">
                            ﷽ بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                        </p>
                    </div>
                </a>
            </div>

            {{-- Desktop Nav --}}
            <div class="hidden lg:flex items-center gap-1">

                {{-- Jadwal Sholat (badge + dropdown) --}}
                <div class="relative" x-data="{ open: false }"
                     @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-2 px-3 py-1.5 rounded-full
                                   bg-white/10 hover:bg-white/20 text-white text-sm
                                   transition-all border border-white/10">
                        <span class="material-symbols-outlined text-accent-gold text-lg">alarm</span>
                        <span class="text-accent-gold font-semibold text-xs">{{ $nextPrayer['name'] }}</span>
                        <span class="text-white/80 text-xs">{{ $nextPrayer['time'] }}</span>
                        <span class="material-symbols-outlined text-white/50 text-sm">expand_more</span>
                    </button>
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute right-0 mt-2 w-56 rounded-xl bg-white shadow-xl ring-1 ring-black/5 overflow-hidden"
                         style="display: none;">
                        <div class="p-2">
                            <p class="px-3 py-1.5 text-xs font-semibold text-primary uppercase tracking-wider">
                                Jadwal Sholat Hari Ini
                            </p>
                            @foreach ($prayerTimes as $p)
                                <div class="flex items-center justify-between px-3 py-2 rounded-lg
                                            {{ $p['name'] === $nextPrayer['name'] ? 'bg-primary-50 text-primary-800' : 'text-gray-600 hover:bg-gray-50' }}">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm {{ $p['name'] === $nextPrayer['name'] ? 'text-accent-gold' : 'text-gray-400' }}">
                                            {{ $p['icon'] }}
                                        </span>
                                        <span class="text-sm font-medium">{{ $p['name'] }}</span>
                                    </div>
                                    <span class="text-sm {{ $p['name'] === $nextPrayer['name'] ? 'font-bold text-accent-gold' : 'font-medium' }}">
                                        {{ $p['time'] }}
                                    </span>
                                </div>
                            @endforeach
                            <a href="{{ route('ibadah.jadwal') }}"
                               class="mt-1 flex items-center justify-center gap-1 px-3 py-2 text-xs text-primary font-medium hover:bg-primary-50 rounded-lg transition-colors">
                                <span>Lihat Semua Wilayah</span>
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Nav links --}}
                <a href="{{ route('ibadah.jadwal') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition-all
                          {{ $isActive('ibadah.jadwal') ? 'text-accent-gold bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <span class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px]">schedule</span> Jadwal
                    </span>
                </a>
                <a href="{{ route('edukasi.agama', 'islam') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition-all
                          {{ $isActive('edukasi') ? 'text-accent-gold bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <span class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px]">menu_book</span> Al-Qur'an
                    </span>
                </a>
                <a href="{{ route('ibadah.panduan', 'islam') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition-all
                          {{ $isActive('ibadah.panduan') ? 'text-accent-gold bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <span class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px]">live_help</span> Panduan
                    </span>
                </a>
                <a href="{{ route('ibadah.etiket', 'islam') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition-all
                          {{ $isActive('ibadah.etiket') ? 'text-accent-gold bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <span class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px]">account_balance</span> Etiket
                    </span>
                </a>

                {{-- User Menu --}}
                @auth
                    <div class="ms-3 relative" x-data="{ open: false }"
                         @click.outside="open = false" @close.stop="open = false">
                        <button @click="open = ! open"
                                class="flex items-center gap-2 px-2 py-1.5 rounded-full
                                       bg-white/10 hover:bg-white/20 transition-all border border-white/10">
                            <span class="w-7 h-7 rounded-full bg-accent-gold/30 flex items-center justify-center
                                         text-white text-sm font-semibold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span class="text-white/80 text-sm hidden md:block">{{ Auth::user()->name }}</span>
                            <span class="material-symbols-outlined text-white/50 text-sm">expand_more</span>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 rounded-xl bg-white shadow-xl ring-1 ring-black/5 overflow-hidden z-50"
                             style="display: none;"
                             @click="open = false">
                            <div class="py-1">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Dashboard</a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Log Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="ms-3 flex items-center gap-2">
                        <a href="{{ route('login') }}"
                           class="text-sm text-white/80 hover:text-white transition-colors px-3 py-1.5">Masuk</a>
                        <a href="{{ route('register') }}"
                           class="text-sm bg-white/15 hover:bg-white/25 text-white px-4 py-1.5 rounded-full transition-all border border-white/20">Daftar</a>
                    </div>
                @endauth
            </div>

            {{-- Mobile buttons --}}
            <div class="flex items-center gap-1 lg:hidden">
                <button @click="prayerOpen = ! prayerOpen"
                        class="p-2 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all">
                    <span class="material-symbols-outlined text-lg">alarm</span>
                </button>
                <button @click="mobile = ! mobile"
                        class="p-2 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all">
                    <span x-show="!mobile" class="material-symbols-outlined">menu</span>
                    <span x-show="mobile" class="material-symbols-outlined" style="display: none;">close</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile: Prayer Panel --}}
    <div x-show="prayerOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden border-t border-white/10 bg-emerald-800/90"
         style="display: none;">
        <div class="px-4 py-3">
            <p class="text-[11px] text-emerald-200 uppercase tracking-wider mb-2">Jadwal Sholat Hari Ini</p>
            <div class="grid grid-cols-5 gap-1">
                @foreach ($prayerTimes as $p)
                    <div class="text-center p-1.5 rounded-lg
                                {{ $p['name'] === $nextPrayer['name'] ? 'bg-accent-gold/20 ring-1 ring-accent-gold/50' : 'bg-white/5' }}">
                        <p class="text-[10px] text-emerald-200">{{ $p['name'] }}</p>
                        <p class="text-sm font-semibold {{ $p['name'] === $nextPrayer['name'] ? 'text-accent-gold' : 'text-white' }}">
                            {{ $p['time'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Mobile: Nav Menu --}}
    <div x-show="mobile"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden border-t border-white/10 bg-emerald-800/95 backdrop-blur"
         style="display: none;">
        <div class="px-4 py-3 space-y-0.5">
            <a href="{{ route('ibadah.jadwal') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all">
                <span class="material-symbols-outlined text-lg">schedule</span> Jadwal Sholat
            </a>
            <a href="{{ route('edukasi.agama', 'islam') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all">
                <span class="material-symbols-outlined text-lg">menu_book</span> Al-Qur'an & Edukasi
            </a>
            <a href="{{ route('ibadah.panduan', 'islam') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all">
                <span class="material-symbols-outlined text-lg">live_help</span> Panduan Ibadah
            </a>
            <a href="{{ route('ibadah.etiket', 'islam') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all">
                <span class="material-symbols-outlined text-lg">account_balance</span> Etiket Masjid
            </a>
            <a href="{{ route('ibadah.peta') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all">
                <span class="material-symbols-outlined text-lg">map</span> Peta Masjid
            </a>
            <div class="border-t border-white/10 my-2"></div>
            @auth
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all">
                    <span class="material-symbols-outlined text-lg">dashboard</span> Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" class="px-3 py-2.5">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 text-sm font-medium text-white/60 hover:text-white transition-all">
                        <span class="material-symbols-outlined text-lg">logout</span> Keluar
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all">
                    <span class="material-symbols-outlined text-lg">login</span> Masuk
                </a>
                <a href="{{ route('register') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all">
                    <span class="material-symbols-outlined text-lg">person_add</span> Daftar
                </a>
            @endauth
            <a href="{{ route('home') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/60 hover:text-white hover:bg-white/10 transition-all">
                <span class="material-symbols-outlined text-lg">home</span> Beranda
            </a>
        </div>
    </div>
</nav>
