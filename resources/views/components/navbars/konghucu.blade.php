@props(['activeRoute' => ''])

@php $isActive = fn($patterns) => collect((array) $patterns)->contains(fn($p) => str_starts_with($activeRoute, $p)); @endphp

<nav x-data="{ mobile: false }" class="bg-gradient-to-r from-red-800 via-red-600 to-red-500 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <span class="material-symbols-outlined text-yellow-200 text-3xl group-hover:scale-110 transition-transform duration-300">temple_buddhist</span>
                    <div>
                        <span class="text-white font-bold text-lg tracking-tight">Harmoni<span class="text-yellow-200">Nusantara</span></span>
                        <p class="text-[11px] text-red-200/80 -mt-0.5">Konghucu</p>
                    </div>
                </a>
            </div>
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ route('edukasi.religion', 'konghucu') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all {{ $isActive('edukasi') ? 'text-yellow-200 bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px]">menu_book</span> Kitab</span>
                </a>
                <a href="{{ route('ibadah.guide', 'konghucu') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all {{ $isActive('ibadah.guide') ? 'text-yellow-200 bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px]">live_help</span> Panduan</span>
                </a>
                <a href="{{ route('ibadah.etiquette', 'konghucu') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all {{ $isActive('ibadah.etiquette') ? 'text-yellow-200 bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[18px]">account_balance</span> Etiket</span>
                </a>
                @auth
                    <div class="ms-3 relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = ! open" class="flex items-center gap-2 px-2 py-1.5 rounded-full bg-white/10 hover:bg-white/20 transition-all border border-white/10">
                            <span class="w-7 h-7 rounded-full bg-yellow-200/30 flex items-center justify-center text-white text-sm font-semibold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            <span class="text-white/80 text-sm hidden md:block">{{ Auth::user()->name }}</span>
                            <span class="material-symbols-outlined text-white/50 text-sm">expand_more</span>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-48 rounded-xl bg-white shadow-xl ring-1 ring-black/5 overflow-hidden z-50" style="display: none;" @click="open = false">
                            <div class="py-1">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Dashboard</a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Log Out</button></form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="ms-3 flex items-center gap-2">
                        <a href="{{ route('login') }}" class="text-sm text-white/80 hover:text-white transition-colors px-3 py-1.5">Masuk</a>
                        <a href="{{ route('register') }}" class="text-sm bg-white/15 hover:bg-white/25 text-white px-4 py-1.5 rounded-full transition-all border border-white/20">Daftar</a>
                    </div>
                @endauth
            </div>
            <div class="flex items-center gap-1 lg:hidden">
                <button @click="mobile = ! mobile" class="p-2 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all">
                    <span x-show="!mobile" class="material-symbols-outlined">menu</span>
                    <span x-show="mobile" class="material-symbols-outlined" style="display: none;">close</span>
                </button>
            </div>
        </div>
    </div>
    <div x-show="mobile" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="lg:hidden border-t border-white/10 bg-red-700" style="display: none;">
        <div class="px-4 py-3 space-y-0.5">
            <a href="{{ route('edukasi.religion', 'konghucu') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all"><span class="material-symbols-outlined text-lg">menu_book</span> Kitab & Edukasi</a>
            <a href="{{ route('ibadah.guide', 'konghucu') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all"><span class="material-symbols-outlined text-lg">live_help</span> Panduan Ibadah</a>
            <a href="{{ route('ibadah.etiquette', 'konghucu') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all"><span class="material-symbols-outlined text-lg">account_balance</span> Etiket Kelenteng</a>
            <div class="border-t border-white/10 my-2"></div>
            @auth
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all"><span class="material-symbols-outlined text-lg">dashboard</span> Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="px-3 py-2.5">@csrf<button type="submit" class="flex items-center gap-3 text-sm font-medium text-white/60 hover:text-white transition-all"><span class="material-symbols-outlined text-lg">logout</span> Keluar</button></form>
            @else
                <a href="{{ route('login') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all"><span class="material-symbols-outlined text-lg">login</span> Masuk</a>
                <a href="{{ route('register') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all"><span class="material-symbols-outlined text-lg">person_add</span> Daftar</a>
            @endauth
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/60 hover:text-white hover:bg-white/10 transition-all"><span class="material-symbols-outlined text-lg">home</span> Beranda</a>
        </div>
    </div>
</nav>
