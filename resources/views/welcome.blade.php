<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
            @hasSection('title')
                @yield('title') | Harmoni Nusantara
            @else
                Harmoni Nusantara - Platform Toleransi Indonesia
            @endif
        </title>
    <meta name="description" content="Platform digital inklusif untuk mempererat toleransi dan merayakan keberagaman agama di Indonesia" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html { scroll-behavior: smooth; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .glass-effect {
            background: rgba(251, 249, 248, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>

<body class="bg-surface-light text-on-surface font-sans antialiased">
    <!-- TopNavBar -->
    <nav x-data="{ 
        mobileMenuOpen: false,
        agamaDropdownOpen: false,
        mobileAgamaOpen: false
    }" class="glass-effect sticky top-0 z-50 border-b border-accent-sand/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-primary tracking-tight flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary text-3xl">auto_awesome</span>
                <span>Harmoni<span class="text-primary-700">Nusantara</span></span>
            </a>
            
            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-1">
                <a href="#about" class="px-4 py-2 text-on-surface-variant hover:text-primary hover:bg-primary-50 rounded-lg font-medium text-sm transition-all duration-200">
                    About
                </a>
                <a href="#jadwal" class="px-4 py-2 text-on-surface-variant hover:text-primary hover:bg-primary-50 rounded-lg font-medium text-sm transition-all duration-200">
                    Jadwal Ibadah
                </a>
                <a href="#kisah" class="px-4 py-2 text-on-surface-variant hover:text-primary hover:bg-primary-50 rounded-lg font-medium text-sm transition-all duration-200">
                    Kisah Inspiratif
                </a>
                <a href="{{ route('edukasi.index') }}" class="px-4 py-2 text-on-surface-variant hover:text-primary hover:bg-primary-50 rounded-lg font-medium text-sm transition-all duration-200">
                    Konten Edukasi
                </a>
                
                <!-- Dropdown Agama -->
                <div class="relative" x-data="{ open: false }" @click.outside="open = false" @click="open = !open">
                    <button class="flex items-center gap-1 px-4 py-2 text-on-surface-variant hover:text-primary hover:bg-primary-50 rounded-lg font-medium text-sm transition-all duration-200">
                        Agama
                        <span class="material-symbols-outlined text-lg transition-transform" :class="open ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute top-full mt-1 left-0 w-48 bg-white rounded-xl shadow-lg border border-accent-sand/50 py-2 z-50"
                         style="display: none;">
                        @php
                        $religions = [
                            ['slug' => 'islam', 'name' => 'Islam', 'icon' => 'mosque'],
                            ['slug' => 'kristen', 'name' => 'Kristen', 'icon' => 'church'],
                            ['slug' => 'katolik', 'name' => 'Katolik', 'icon' => 'cross'],
                            ['slug' => 'hindu', 'name' => 'Hindu', 'icon' => 'spa'],
                            ['slug' => 'buddha', 'name' => 'Buddha', 'icon' => 'self_improvement'],
                            ['slug' => 'konghucu', 'name' => 'Konghucu', 'icon' => 'elderly'],
                        ];
                        @endphp
                        @foreach($religions as $religion)
                        <a href="{{ route('edukasi.agama', $religion['slug']) }}" 
                           class="block px-4 py-2.5 text-on-surface-variant hover:text-primary hover:bg-primary-50 transition-colors">
                            {{ $religion['name'] }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="hidden lg:flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-primary text-white px-5 py-2.5 rounded-lg font-semibold text-sm hover:bg-primary-600 transition-all shadow-sm hover:shadow-md">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-on-surface-variant hover:text-primary font-medium text-sm transition-colors">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-primary text-white px-5 py-2.5 rounded-lg font-semibold text-sm hover:bg-primary-600 transition-all shadow-sm hover:shadow-md">
                                Daftar
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
            
            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 hover:bg-primary-50 rounded-lg transition-colors">
                <span class="material-symbols-outlined text-primary" x-text="mobileMenuOpen ? 'close' : 'menu'"></span>
            </button>
        </div>
        
        <!-- Mobile Menu Drawer -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden absolute top-full left-0 right-0 bg-white border-b border-accent-sand/50 shadow-lg"
             style="display: none;">
            <div class="px-4 py-4 space-y-3 max-h-[80vh] overflow-y-auto">
                <a href="#about" @click="mobileMenuOpen = false" class="block px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary-50 rounded-lg font-medium transition-colors">
                    About
                </a>
                <a href="#jadwal" @click="mobileMenuOpen = false" class="block px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary-50 rounded-lg font-medium transition-colors">
                    Jadwal Ibadah
                </a>
                <a href="#kisah" @click="mobileMenuOpen = false" class="block px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary-50 rounded-lg font-medium transition-colors">
                    Kisah Inspiratif
                </a>
                <a href="{{ route('edukasi.index') }}" @click="mobileMenuOpen = false" class="block px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary-50 rounded-lg font-medium transition-colors">
                    Konten Edukasi
                </a>
                
                <!-- Mobile Agama Dropdown -->
                <div class="border-t border-accent-sand/30 pt-3">
                    <button @click="mobileAgamaOpen = !mobileAgamaOpen" class="flex items-center justify-between w-full px-4 py-3 text-on-surface-variant hover:bg-primary-50 rounded-lg font-medium transition-colors">
                        <span>Agama</span>
                        <span class="material-symbols-outlined transition-transform" :class="mobileAgamaOpen ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="mobileAgamaOpen" class="mt-2 space-y-1 pl-4" style="display: none;">
                        @foreach($religions as $religion)
                        <a href="{{ route('edukasi.agama', $religion['slug']) }}" class="flex items-center gap-3 px-4 py-2.5 text-on-surface-variant hover:text-primary hover:bg-primary-50 rounded-lg transition-colors">
                            <span class="material-symbols-outlined text-lg">{{ $religion['icon'] }}</span>
                            {{ $religion['name'] }}
                        </a>
                        @endforeach
                    </div>
                </div>
                
                <div class="border-t border-accent-sand/30 pt-3 flex flex-col gap-2">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-primary text-white px-5 py-3 rounded-lg font-semibold text-sm text-center hover:bg-primary-600 transition-all">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-center px-4 py-3 text-on-surface-variant hover:text-primary hover:bg-primary-50 rounded-lg font-medium transition-colors">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-primary text-white px-5 py-3 rounded-lg font-semibold text-sm text-center hover:bg-primary-600 transition-all">
                                    Daftar
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main>
        <!-- Hero Section -->
        <section class="relative h-[85vh] min-h-[600px] flex items-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img 
                    class="w-full h-full object-cover object-top" 
                    src="{{ asset('image/hero.png') }}" 
                    alt="Masjid dengan arsitektur Indonesia" 
                />
                <div class="absolute inset-0 bg-gradient-to-r from-surface-light to-transparent"></div>
            </div>
            <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-10 pt-32">
                <div class="inline-flex items-center gap-2 bg-primary-100/80 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                    <span class="material-symbols-outlined text-primary text-sm">diversity_3</span>
                    <span class="text-primary-700 font-medium text-sm">Platform Toleransi Indonesia</span>
                </div>
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-primary mb-6 leading-[1.1] tracking-tight">
                    Merajut Keberagaman<br/>
                    <span class="text-secondary">dalam Harmoni</span> Nusantara
                </h1>
                <p class="text-xl text-on-surface-variant mb-8 max-w-2xl leading-relaxed">
                    Ruang digital inklusif untuk mempererat toleransi, berbagi inspirasi, dan merayakan indahnya perbedaan di tanah air tercinta.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('forum') }}" class="bg-primary text-white px-8 py-4 rounded-xl font-semibold hover:bg-primary-600 transition-all shadow-lg shadow-primary/20 hover:shadow-xl hover:-translate-y-0.5 flex items-center gap-2">
                        <span class="material-symbols-outlined">forum</span>
                        Mulai Berdialog
                    </a>
                    <a href="{{ route('edukasi.index') }}" class="border-2 border-secondary text-secondary px-8 py-4 rounded-xl font-semibold hover:bg-secondary hover:text-white transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined">school</span>
                        Pelajari Lebih Lanjut
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="flex flex-wrap gap-8 mt-12 pt-8 border-t border-accent-sand/30">
                    <div>
                        <p class="text-3xl font-bold text-primary">6</p>
                        <p class="text-sm text-on-surface-variant">Agama Diakui</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-primary">17K+</p>
                        <p class="text-sm text-on-surface-variant">Komunitas Aktif</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-primary">2.5M</p>
                        <p class="text-sm text-on-surface-variant">Pengguna凑</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-24 px-4 sm:px-6 lg:px-10 bg-gradient-to-b from-white via-surface-light to-white">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-16">
                    <span class="inline-flex items-center gap-2 bg-primary-100 text-primary-700 px-4 py-1.5 rounded-full text-sm font-medium mb-4">
                        <span class="material-symbols-outlined text-sm">info</span>
                        Tentang Kami
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-bold text-primary mb-4">Merajut Keberagaman,<br/>Membangun Harmoni</h2>
                    <p class="text-on-surface-variant max-w-2xl mx-auto text-lg">Platform digital inklusif yang menghubungkan hati-hati lintas keyakinan demi Indonesia yang lebih damai.</p>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
                    <div>
                        <h3 class="text-2xl font-bold text-primary mb-6">Menjadi Jembatan Antar Umat</h3>
                        <p class="text-on-surface-variant text-lg leading-relaxed mb-6">
                            <strong>Harmoni Nusantara</strong> lahir dari kesadaran bahwa Indonesia adalah rumah bersama bagi pemeluk enam agama. Kami percaya bahwa <em>perbedaan keyakinan bukanlah pemisah, melainkan kekuatan</em> yang memperkaya budaya bangsa.
                        </p>
                        <p class="text-on-surface-variant leading-relaxed mb-8">
                            Melalui platform ini, kami menghubungkan sesama anak bangsa untuk saling memahami, menghargai, dan bekerja sama — mulai dari edukasi lintas agama, temukan jadwal & tempat ibadah, hingga partisipasi dalam aksi sosial yang membawa manfaat bagi semua.
                        </p>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center p-4 bg-primary-50 rounded-xl border border-primary-100">
                                <span class="material-symbols-outlined text-3xl text-primary mb-2">favorite</span>
                                <p class="font-semibold text-primary text-sm">Toleransi</p>
                                <p class="text-xs text-on-surface-variant mt-1">Menghormati perbedaan</p>
                            </div>
                            <div class="text-center p-4 bg-secondary-50 rounded-xl border border-secondary-100">
                                <span class="material-symbols-outlined text-3xl text-secondary mb-2">group</span>
                                <p class="font-semibold text-secondary text-sm">Inklusivitas</p>
                                <p class="text-xs text-on-surface-variant mt-1">Terbukanya semua</p>
                            </div>
                            <div class="text-center p-4 bg-primary-50 rounded-xl border border-primary-100">
                                <span class="material-symbols-outlined text-3xl text-primary mb-2">handshake</span>
                                <p class="font-semibold text-primary text-sm">Persatuan</p>
                                <p class="text-xs text-on-surface-variant mt-1">Berasatu dalam perbedaan</p>
                            </div>
                            <div class="text-center p-4 bg-secondary-50 rounded-xl border border-secondary-100">
                                <span class="material-symbols-outlined text-3xl text-secondary mb-2">volunteer_activism</span>
                                <p class="font-semibold text-secondary text-sm">Gotong Royong</p>
                                <p class="text-xs text-on-surface-variant mt-1">Berkarya bersama</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative flex flex-col items-center justify-center h-full min-h-[300px] bg-gradient-to-br from-primary-50 via-white to-secondary-50 rounded-3xl p-8 border border-accent-sand/30">
                        <div class="text-center mb-6">
                            <span class="material-symbols-outlined text-6xl text-primary mb-4">auto_awesome</span>
                            <h3 class="text-2xl font-bold text-primary">Harmoni Nusantara</h3>
                            <p class="text-on-surface-variant mt-2">Merajut Keberagaman dalam Harmoni</p>
                        </div>
                        <div class="flex flex-wrap justify-center gap-6 mt-6">
                            <div class="text-center">
                                <span class="material-symbols-outlined text-3xl text-accent-gold">mosque</span>
                                <p class="text-xs mt-1">Islam</p>
                            </div>
                            <div class="text-center">
                                <span class="material-symbols-outlined text-3xl text-blue-600">church</span>
                                <p class="text-xs mt-1">Kristen</p>
                            </div>
                            <div class="text-center">
                                <span class="material-symbols-outlined text-3xl text-violet-600">church</span>
                                <p class="text-xs mt-1">Katolik</p>
                            </div>
                            <div class="text-center">
                                <span class="material-symbols-outlined text-3xl text-orange-500">temple_hindu</span>
                                <p class="text-xs mt-1">Hindu</p>
                            </div>
                            <div class="text-center">
                                <span class="material-symbols-outlined text-3xl text-amber-500">self_improvement</span>
                                <p class="text-xs mt-1">Buddha</p>
                            </div>
                            <div class="text-center">
                                <span class="material-symbols-outlined text-3xl text-red-500">elderly</span>
                                <p class="text-xs mt-1">Konghucu</p>
                            </div>
                        </div>
                        <div class="absolute -bottom-4 -right-4 bg-gradient-to-br from-primary to-primary-600 text-white px-6 py-4 rounded-2xl shadow-xl">
                            <p class="text-3xl font-bold">6</p>
                            <p class="text-sm">Agama di Indonesia</p>
                        </div>
                    </div>
                </div>
        {{-- Keberagaman Agama di Indonesia — Enhanced Section --}}
        @php
            $typeMeta = [
                'worship_place' => ['icon' => 'temple_buddhist', 'label' => 'Tempat Ibadah'],
                'figure' => ['icon' => 'person', 'label' => 'Tokoh Agama'],
                'historical_site' => ['icon' => 'fort', 'label' => 'Situs Sejarah'],
            ];
            $religionMeta = [
                'islam'    => ['name' => 'Islam',              'icon' => 'mosque',       'badge' => 'bg-emerald-500/90',  'gradient' => 'from-emerald-600 to-emerald-800'],
                'kristen'  => ['name' => 'Kristen Protestan',  'icon' => 'church',       'badge' => 'bg-blue-500/90',     'gradient' => 'from-blue-600 to-blue-800'],
                'katolik'  => ['name' => 'Katolik',            'icon' => 'church',       'badge' => 'bg-violet-500/90',   'gradient' => 'from-violet-600 to-violet-800'],
                'hindu'    => ['name' => 'Hindu',              'icon' => 'temple_hindu',  'badge' => 'bg-orange-500/90',   'gradient' => 'from-orange-600 to-orange-800'],
                'buddha'   => ['name' => 'Buddha',             'icon' => 'self_improvement','badge' => 'bg-amber-500/90',  'gradient' => 'from-amber-600 to-amber-800'],
                'konghucu' => ['name' => 'Konghucu',           'icon' => 'elderly',      'badge' => 'bg-red-500/90',     'gradient' => 'from-red-600 to-red-800'],
            ];
            $typeIcon = fn($t) => $typeMeta[$t]['icon'] ?? 'star';
            $typeLabel = fn($t) => $typeMeta[$t]['label'] ?? $t;
        @endphp

         <section class="py-20 px-4 sm:px-6 lg:px-10 bg-surface"
                  x-data="{
            activeFilter: 'all',
            selected: null,
            showAll: false,
            showCount: 8,
            typeIcon: '{{ $typeIcon('worship_place') }}',
            typeLabel: '{{ $typeLabel('worship_place') }}',
        }">
            <div class="max-w-7xl mx-auto">
                {{-- Header --}}
                <div class="text-center mb-10">
                    <span class="inline-flex items-center gap-2 bg-primary-100 text-primary-700 px-4 py-1.5 rounded-full text-sm font-medium mb-4">
                        <span class="material-symbols-outlined text-sm">diversity_3</span>
                        Keberagaman
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-bold text-primary mb-3">Keberagaman Agama di Indonesia</h2>
                    <p class="text-on-surface-variant max-w-2xl mx-auto">Jelajahi tempat ibadah, tokoh, dan situs bersejarah dari enam agama resmi yang hidup berdampingan dalam harmoni.</p>
                </div>

                {{-- Filter Chips --}}
                <div class="flex flex-wrap justify-center gap-2 mb-12">
                    <button @click="activeFilter = 'all'"
                            :class="activeFilter === 'all'
                                ? 'bg-primary text-white shadow-md shadow-primary/20'
                                : 'bg-white text-on-surface-variant hover:bg-primary-50 border border-accent-sand/50'"
                            class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-200 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-lg">apps</span>
                        Semua
                    </button>
                    <button @click="activeFilter = 'worship_place'"
                            :class="activeFilter === 'worship_place'
                                ? 'bg-secondary text-white shadow-md shadow-secondary/20'
                                : 'bg-white text-on-surface-variant hover:bg-primary-50 border border-accent-sand/50'"
                            class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-200 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-lg">temple_buddhist</span>
                        Tempat Ibadah
                    </button>
                    <button @click="activeFilter = 'figure'"
                            :class="activeFilter === 'figure'
                                ? 'bg-secondary text-white shadow-md shadow-secondary/20'
                                : 'bg-white text-on-surface-variant hover:bg-primary-50 border border-accent-sand/50'"
                            class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-200 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-lg">person</span>
                        Tokoh Agama
                    </button>
                    <button @click="activeFilter = 'historical_site'"
                            :class="activeFilter === 'historical_site'
                                ? 'bg-secondary text-white shadow-md shadow-secondary/20'
                                : 'bg-white text-on-surface-variant hover:bg-primary-50 border border-accent-sand/50'"
                            class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-200 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-lg">fort</span>
                        Situs Sejarah
                    </button>
                </div>

                {{-- Card Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($highlights as $item)
                    @php
                        $rm = $religionMeta[$item->religion->slug] ?? null;
                    @endphp
                    <div x-show="showAll || activeFilter !== 'all' || {{ $loop->index }} < 8"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="group relative rounded-2xl overflow-hidden cursor-pointer bg-white border border-accent-sand/30 hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                         @click="selected = {
                            name: '{{ addslashes($item->name) }}',
                            type: '{{ $item->type }}',
                            typeLabel: '{{ $typeLabel($item->type) }}',
                            typeIcon: '{{ $typeIcon($item->type) }}',
                            image: {{ $item->image_url ? "'" . $item->image_url . "'" : 'null' }},
                            religion: '{{ addslashes($rm['name'] ?? '') }}',
                            religionSlug: '{{ $item->religion->slug }}',
                            religionBadge: '{{ $rm['badge'] ?? 'bg-primary' }}',
                            description: {{ json_encode($item->description) }},
                            location: {{ json_encode($item->location) }},
                            reference: '{{ $item->reference_url }}',
                         }">
                        {{-- Image area --}}
                        <div class="aspect-[4/3] overflow-hidden">
                            @if($item->image_url)
                            <img src="{{ $item->image_url }}"
                                 alt="{{ $item->name }}"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                 loading="lazy">
                            @else
                            <div class="w-full h-full bg-gradient-to-br {{ $rm['gradient'] ?? 'from-primary-600 to-primary-800' }} flex items-center justify-center">
                                <div class="text-center px-4">
                                    <span class="material-symbols-outlined text-6xl text-white/60 block mb-2">{{ $rm['icon'] ?? 'person' }}</span>
                                    <span class="text-white/40 text-xs font-medium uppercase tracking-wider">{{ strtoupper($item->religion->slug) }}</span>
                                </div>
                            </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                        </div>

                        {{-- Type Badge --}}
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center gap-1 bg-white/90 backdrop-blur-sm text-on-surface-variant text-xs font-medium px-2.5 py-1 rounded-full shadow-sm">
                                <span class="material-symbols-outlined text-sm">{{ $typeIcon($item->type) }}</span>
                                {{ $typeLabel($item->type) }}
                            </span>
                        </div>

                        {{-- Bottom overlay --}}
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <h3 class="text-white font-bold text-base leading-snug mb-1.5 drop-shadow-sm">{{ $item->name }}</h3>
                            @if($rm)
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <span class="inline-flex items-center gap-1 text-xs font-medium px-2 py-0.5 rounded-full {{ $rm['badge'] }} text-white shadow-sm">
                                    <span class="material-symbols-outlined text-xs">{{ $rm['icon'] }}</span>
                                    {{ $rm['name'] }}
                                </span>
                                @if($item->location)
                                <span class="text-white/70 text-xs flex items-center gap-0.5">
                                    <span class="material-symbols-outlined text-xs">location_on</span>
                                    {{ Str::limit($item->location, 20) }}
                                </span>
                                @endif
                            </div>
                            @endif
                        </div>

                        {{-- Hover indicator --}}
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none">
                            <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-3xl">touch_app</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-16 bg-white/60 rounded-2xl border border-dashed border-accent-sand/50">
                        <span class="material-symbols-outlined text-6xl text-accent-sand">search_off</span>
                        <p class="text-on-surface-variant mt-3">Belum ada data keberagamaan. Silakan kembali nanti.</p>
                    </div>
                    @endforelse
                </div>

                {{-- Toggle button --}}
                @if($highlights->count() > 8)
                <div class="flex justify-center mt-10">
                    <button @click="showAll = !showAll"
                            x-text="showAll ? 'Sembunyikan' : 'Tampilkan Semua ({{ $highlights->count() }})'"
                            class="inline-flex items-center gap-2 bg-white text-primary border-2 border-primary/30 px-7 py-3 rounded-xl font-semibold text-sm hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm hover:shadow-md">
                        <span class="material-symbols-outlined text-lg" x-text="showAll ? 'expand_less' : 'expand_more'"></span>
                        <span x-text="showAll ? 'Sembunyikan' : 'Tampilkan Semua ({{ $highlights->count() }})'"></span>
                    </button>
                </div>
                @endif
            </div>

            {{-- ✦ Detail Modal --}}
            <template x-teleport="body">
                <div x-show="selected"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 z-[100] flex items-start sm:items-center justify-center p-0 sm:p-6 overflow-y-auto"
                     @click.self="selected = null"
                     @keydown.escape.window="selected = null"
                     style="display: none;">
                    {{-- Backdrop --}}
                    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>

                    {{-- Modal panel --}}
                    <div x-show="selected"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                         class="relative z-10 w-full sm:max-w-2xl bg-surface-light rounded-none sm:rounded-2xl shadow-2xl overflow-hidden my-0 sm:my-8"
                         style="display: none;">
                        {{-- Close button --}}
                        <button @click="selected = null"
                                class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-black/30 hover:bg-black/50 backdrop-blur-sm flex items-center justify-center transition-colors">
                            <span class="material-symbols-outlined text-white text-xl">close</span>
                        </button>

                        {{-- Hero image --}}
                        <div class="relative h-56 sm:h-72 overflow-hidden">
                            <template x-if="selected?.image">
                                <img :src="selected.image"
                                     :alt="selected.name"
                                     class="w-full h-full object-cover"
                                     loading="lazy">
                            </template>
                            <template x-if="!selected?.image">
                                <div class="w-full h-full bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center">
                                    <div class="text-center">
                                        <span class="material-symbols-outlined text-8xl text-white/30 block mb-2" x-text="selected?.typeIcon || 'star'"></span>
                                        <span class="text-white/20 text-xs font-medium uppercase tracking-widest" x-text="selected?.religion || ''"></span>
                                    </div>
                                </div>
                            </template>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                            {{-- Badge overlay --}}
                            <div class="absolute bottom-4 left-4 right-4 flex items-start justify-between gap-3">
                                <div>
                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                        <span class="inline-flex items-center gap-1 bg-white/90 backdrop-blur-sm text-on-surface-variant text-xs font-medium px-3 py-1 rounded-full shadow-sm">
                                            <span class="material-symbols-outlined text-sm" x-text="selected?.typeIcon"></span>
                                            <span x-text="selected?.typeLabel"></span>
                                        </span>
                                        <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full text-white shadow-sm"
                                              :class="selected?.religionBadge">
                                            <span class="material-symbols-outlined text-xs" x-text="selected?.religionSlug === 'islam' ? 'mosque' : selected?.religionSlug === 'kristen' || selected?.religionSlug === 'katolik' ? 'church' : selected?.religionSlug === 'hindu' ? 'temple_hindu' : selected?.religionSlug === 'buddha' ? 'self_improvement' : 'elderly'"></span>
                                            <span x-text="selected?.religion"></span>
                                        </span>
                                    </div>
                                    <h3 class="text-white font-bold text-xl sm:text-2xl drop-shadow-sm leading-snug" x-text="selected?.name"></h3>
                                </div>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-5 sm:p-7 space-y-5">
                            {{-- Description --}}
                            <div>
                                <h4 class="text-sm font-semibold text-primary uppercase tracking-wider mb-3">Deskripsi</h4>
                                <p class="text-on-surface-variant text-sm sm:text-base leading-relaxed" x-text="selected?.description"></p>
                            </div>

                            {{-- Location --}}
                            <template x-if="selected?.location">
                                <div class="flex items-start gap-2.5 p-4 bg-primary-50/70 rounded-xl border border-primary-100/50">
                                    <span class="material-symbols-outlined text-primary mt-0.5">location_on</span>
                                    <div>
                                        <p class="text-xs font-semibold text-primary uppercase tracking-wider mb-0.5">Lokasi</p>
                                        <p class="text-on-surface-variant text-sm" x-text="selected?.location"></p>
                                    </div>
                                </div>
                            </template>

                            {{-- Reference Link --}}
                            <template x-if="selected?.reference">
                                <a :href="selected?.reference"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="flex items-center justify-center gap-2 w-full bg-primary text-white px-6 py-3.5 rounded-xl font-semibold text-sm hover:bg-primary-600 transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                                    <span class="material-symbols-outlined">search</span>
                                    Cari di Google — <span x-text="selected?.name"></span>
                                </a>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </section>

        {{-- Explore Edukasi CTA --}}
        <section class="py-16 px-4 sm:px-6 lg:px-10 bg-white">
            <div class="max-w-7xl mx-auto text-center">
                <span class="material-symbols-outlined text-5xl text-primary mb-4">school</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-primary mb-3">Jelajahi Edukasi Keagamaan</h2>
                <p class="text-on-surface-variant max-w-xl mx-auto mb-8">Pelajari lebih dalam tentang setiap agama melalui artikel, video, dan wisata virtual yang tersedia.</p>
                <a href="{{ route('edukasi.index') }}"
                   class="inline-flex items-center gap-2 bg-primary text-white px-8 py-3.5 rounded-xl font-semibold text-base
                          hover:bg-primary-700 transition-all shadow-md hover:shadow-lg">
                    <span class="material-symbols-outlined">explore</span>
                    Jelajahi Semua Edukasi
                </a>
            </div>
        </section>

        <!-- Widget Section -->
        <section id="jadwal" class="py-20 px-4 sm:px-6 lg:px-10 max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Jadwal Ibadah Widget -->
                <div class="lg:col-span-4 bg-surface rounded-2xl p-6 border border-accent-sand/50 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-primary flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary">schedule</span> 
                            Jadwal Ibadah
                        </h3>
                        <span class="text-sm text-on-surface-variant bg-primary-100 px-3 py-1 rounded-full">Jakarta</span>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        @php
                        $prayers = [
                            ['name' => 'Subuh', 'time' => '04:32', 'isNext' => false],
                            ['name' => 'Zuhur', 'time' => '11:58', 'isNext' => false],
                            ['name' => 'Asar', 'time' => '15:18', 'isNext' => false],
                            ['name' => 'Magrib', 'time' => '18:12', 'isNext' => true],
                            ['name' => 'Isya', 'time' => '19:25', 'isNext' => false],
                            ['name' => 'Dhuha', 'time' => '06:45', 'isNext' => false],
                        ];
                        @endphp
                        @foreach($prayers as $prayer)
                        <div class="p-3 rounded-xl {{ $prayer['isNext'] ? 'bg-secondary-50 border-2 border-secondary/30' : 'bg-surface-light' }}">
                            <span class="text-xs {{ $prayer['isNext'] ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">{{ $prayer['name'] }}</span>
                            <p class="text-lg font-semibold {{ $prayer['isNext'] ? 'text-secondary' : 'text-primary' }}">{{ $prayer['time'] }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6 text-center">
                        <a href="{{ route('ibadah.jadwal') }}" class="text-primary hover:text-primary-700 font-medium text-sm inline-flex items-center gap-1">
                            Lihat Semua Wilayah 
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
                
                <!-- Kalender Toleransi -->
                <div class="lg:col-span-8 bg-surface rounded-2xl p-6 border border-accent-sand/50">
                    <h3 class="text-xl font-bold text-primary flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-secondary">calendar_month</span> 
                        Kalender Toleransi
                    </h3>
                    <div class="flex flex-col lg:flex-row gap-6">
                        <!-- Featured Event -->
                        <div class="flex-1 relative bg-gradient-to-br from-secondary-100 to-secondary-50 rounded-2xl p-6 border border-secondary/20 overflow-hidden">
                            <div class="absolute -right-8 -top-8 opacity-10">
                                <span class="material-symbols-outlined text-[160px] text-secondary">celebration</span>
                            </div>
                            <span class="inline-block bg-secondary text-white px-3 py-1 rounded-full text-xs font-bold mb-3">Terdekat</span>
                            <h4 class="text-2xl font-bold text-secondary-800 mb-2">Hari Raya Idul Fitri</h4>
                            <p class="text-secondary-700 mb-4">1 Syawal 1446 H - 31 Maret 2025</p>
                            <div class="flex items-center gap-3">
                                <div class="flex -space-x-2">
                                    <img src="https://i.pravatar.cc/40?img=1" class="w-8 h-8 rounded-full border-2 border-white" />
                                    <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full border-2 border-white" />
                                    <img src="https://i.pravatar.cc/40?img=3" class="w-8 h-8 rounded-full border-2 border-white" />
                                </div>
                                <span class="text-sm text-secondary-700">+12rb akan berinteraksi</span>
                            </div>
                        </div>
                        
                        <!-- Upcoming Events -->
                        <div class="flex-1 space-y-3">
                            @php
                            $events = [
                                ['day' => '09', 'month' => 'Mei', 'title' => 'Kenaikan Isa Almasih', 'religion' => 'kristen'],
                                ['day' => '23', 'month' => 'Mei', 'title' => 'Hari Raya Waisak', 'religion' => 'buddha'],
                                ['day' => '01', 'month' => 'Jun', 'title' => 'Hari Lahir Pancasila', 'religion' => 'nasional'],
                            ];
                            @endphp
                            @foreach($events as $event)
                            <a href="{{ route('edukasi.index') }}" class="flex items-center gap-4 p-3 rounded-xl hover:bg-surface-light transition-colors group">
                                <div class="w-12 h-12 bg-primary-100 flex items-center justify-center rounded-lg">
                                    <span class="text-primary font-bold">{{ $event['day'] }}</span>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-on-surface group-hover:text-primary transition-colors">{{ $event['title'] }}</h5>
                                    <p class="text-xs text-on-surface-variant">{{ $event['month'] }} 2025</p>
                                </div>
                                <span class="material-symbols-outlined text-on-surface-variant ml-auto opacity-0 group-hover:opacity-100 transition-opacity">arrow_forward</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Stories -->
        <section id="kisah" class="py-20 px-4 sm:px-6 lg:px-10 bg-primary-50/50">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-bold text-primary mb-3">Kisah Inspiratif</h2>
                        <p class="text-on-surface-variant">Inspirasi dari tokoh agama dan pemuda nusantara</p>
                    </div>
                    <a href="{{ route('edukasi.video.index') }}" class="hidden sm:inline-flex items-center gap-2 text-secondary hover:text-secondary-700 font-medium transition-colors">
                        Lihat Semua 
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
                
                <div class="flex overflow-x-auto gap-6 pb-4 hide-scrollbar -mx-4 px-4 sm:-mx-0 sm:px-0">
                    @php
                    $stories = [
                        [
                            'title' => 'Bhante Sumananda', 
                            'desc' => 'Perjalanan spiritual seorang bhikkhu yang memperjuangkan dialog antarumat.', 
                            'img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&q=80',
                            'type' => 'Video'
                        ],
                        [
                            'title' => 'Romo Markus & Kyai Ahmad', 
                            'desc' => 'Persahabatan lintas iman yang menginspirasi pendampingan komunitas.', 
                            'img' => 'https://images.unsplash.com/photo-1559523161-0fc0d8b38a7a?w=600&q=80',
                            'type' => 'Artikel'
                        ],
                        [
                            'title' => 'Wayan & Keluarga', 
                            'desc' => 'Tri Hita Karana dalam kehidupan sehari-hari di Bali.', 
                            'img' => 'https://images.unsplash.com/photo-1531804226535-71dc18d589d6?w=600&q=80',
                            'type' => 'Podcast'
                        ],
                        [
                            'title' => 'Komunitas Pramuka Toleran', 
                            'desc' => 'Membentuk karakter muda melalui nilai-nilai kebangsaan.', 
                            'img' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=600&q=80',
                            'type' => 'Video'
                        ],
                    ];
                    @endphp
                    @foreach($stories as $story)
                    <article class="relative min-w-[280px] sm:min-w-[320px] h-[420px] rounded-2xl overflow-hidden group flex-shrink-0 cursor-pointer">
                        <img src="{{ $story['img'] }}" alt="{{ $story['title'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                        
                        <span class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm text-white text-xs font-medium px-3 py-1 rounded-full flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">play_circle</span>
                            {{ $story['type'] }}
                        </span>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-full bg-primary-300 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary-700">person</span>
                                </div>
                                <span class="text-white font-medium">{{ $story['title'] }}</span>
                            </div>
                            <p class="text-white/80 text-sm line-clamp-2">{{ $story['desc'] }}</p>
                        </div>
                        
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-5xl">play_circle</span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
                
                <div class="text-center mt-6 sm:hidden">
                    <a href="{{ route('edukasi.video.index') }}" class="inline-flex items-center gap-2 text-secondary font-medium">
                        Lihat Semua Cerita
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Donation Section -->
        <section class="py-20 px-4 sm:px-6 lg:px-10">
            <div class="max-w-5xl mx-auto">
                <div class="bg-gradient-to-br from-primary-100 via-primary-50 to-surface rounded-3xl p-8 md:p-12 border border-primary-200/50">
                    <div class="flex flex-col lg:flex-row items-center gap-10">
                        <div class="flex-1">
                            <span class="inline-flex items-center gap-2 bg-primary-200/50 text-primary-800 px-4 py-1.5 rounded-full text-sm font-medium mb-4">
                                <span class="material-symbols-outlined text-sm">volunteer_activism</span>
                                Aksi Baik Hari Ini
                            </span>
                            <h2 class="text-2xl md:text-3xl font-bold text-primary mb-4">Membangun Rumah Ibadah Ramah Disabilitas</h2>
                            <p class="text-on-surface-variant mb-6">Bersama-sama kita mewujudkan ruang suci yang inklusif bagi semua saudara kita tanpa terkecuali.</p>
                            
                            <div class="space-y-3 mb-8">
                                <div class="flex justify-between text-sm">
                                    <span class="text-on-surface-variant">Terkumpul: <strong class="text-primary">Rp 75.400.000</strong></span>
                                    <span class="text-primary font-bold">75%</span>
                                </div>
                                <div class="w-full bg-primary-200/30 h-3 rounded-full overflow-hidden">
                                    <div class="bg-primary h-full rounded-full" style="width: 75%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-on-surface-variant">
                                    <span>Target: Rp 100.000.000</span>
                                    <span>12 Hari Lagi</span>
                                </div>
                            </div>
                            
                            <a href="{{ route('aksi.donasi.index') }}" class="w-full sm:w-auto bg-secondary text-white px-10 py-4 rounded-xl font-semibold shadow-lg shadow-secondary/20 hover:shadow-xl hover:opacity-90 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">favorite</span>
                                Berikan Donasi
                            </a>
                        </div>
                        
                        <div class="flex-1 w-full grid grid-cols-2 gap-4">
                            <div class="bg-white/70 p-6 rounded-2xl flex flex-col items-center text-center">
                                <span class="material-symbols-outlined text-4xl text-primary mb-2">groups</span>
                                <span class="text-2xl font-bold text-primary">1.240</span>
                                <span class="text-xs text-on-surface-variant">Donatur Baru</span>
                            </div>
                            <div class="bg-white/70 p-6 rounded-2xl flex flex-col items-center text-center">
                                <span class="material-symbols-outlined text-4xl text-secondary mb-2">handshake</span>
                                <span class="text-2xl font-bold text-primary">45</span>
                                <span class="text-xs text-on-surface-variant">Komunitas</span>
                            </div>
                            <div class="col-span-2 flex items-center gap-4 bg-white/70 p-4 rounded-2xl">
                                <div class="flex -space-x-2 overflow-hidden">
                                    <img src="https://i.pravatar.cc/40?img=1" class="w-10 h-10 rounded-full border-2 border-white" />
                                    <img src="https://i.pravatar.cc/40?img=2" class="w-10 h-10 rounded-full border-2 border-white" />
                                    <img src="https://i.pravatar.cc/40?img=3" class="w-10 h-10 rounded-full border-2 border-white" />
                                </div>
                                <p class="text-sm text-on-surface-variant italic">"Telah bergabung sebagai pahlawan toleransi."</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kisah Bahagia Mereka Section -->
        <section class="py-20 px-4 sm:px-6 lg:px-10 bg-primary-50/50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <span class="inline-flex items-center gap-2 bg-primary-200/50 text-primary-800 px-4 py-1.5 rounded-full text-sm font-medium mb-4">
                        <span class="material-symbols-outlined text-sm">auto_awesome</span>
                        Testimoni Pengguna
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-bold text-primary mb-3">Kisah Bahagia Mereka</h2>
                    <p class="text-on-surface-variant max-w-2xl mx-auto">
                        Dampak nyata dari penggunaan Harmoni Nusantara dalam kehidupan sehari-hari
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @forelse($testimonials as $testimonial)
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-accent-sand/50 hover:shadow-md transition-shadow flex flex-col">
                            <span class="material-symbols-outlined text-3xl text-secondary/30 mb-3">format_quote</span>
                            <p class="text-on-surface-variant leading-relaxed line-clamp-4 flex-1">{{ $testimonial->content }}</p>
                            <div class="flex items-center gap-3 mt-4 pt-4 border-t border-accent-sand/30">
                                @if($testimonial->user && $testimonial->user->avatar)
                                    <img src="{{ Storage::url($testimonial->user->avatar) }}" alt="{{ $testimonial->name }}" class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <span class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary font-bold text-sm">
                                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                    </span>
                                @endif
                                <div>
                                    <p class="font-semibold text-primary text-sm">{{ $testimonial->name }}</p>
                                    <p class="text-xs text-on-surface-variant font-medium">{{ $testimonial->title ?? 'Pengguna Harmoni Nusantara' }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white/60 rounded-2xl p-8 border border-dashed border-accent-sand/50 text-center md:col-span-2 lg:col-span-3">
                            <span class="material-symbols-outlined text-5xl text-accent-sand mb-3">edit_note</span>
                            <p class="text-on-surface-variant">Belum ada kisah yang dibagikan. Jadilah yang pertama!</p>
                        </div>
                    @endforelse
                </div>

                @auth
                <div class="text-center">
                    <a href="{{ route('testimoni.create') }}"
                       class="inline-flex items-center gap-2 bg-secondary text-white px-8 py-3.5 rounded-xl font-semibold shadow-lg shadow-secondary/20 hover:shadow-xl hover:opacity-90 hover:-translate-y-0.5 transition-all">
                        <span class="material-symbols-outlined">edit_note</span>
                        Bagikan Kisah Anda
                    </a>
                </div>
                @else
                <div class="text-center max-w-lg mx-auto bg-white/60 rounded-2xl p-8 border border-dashed border-accent-sand/50">
                    <span class="material-symbols-outlined text-4xl text-accent-sand mb-2">lock</span>
                    <p class="text-on-surface-variant">
                        <a href="{{ route('login') }}" class="text-secondary hover:underline font-medium">Masuk</a> atau
                        <a href="{{ route('register') }}" class="text-secondary hover:underline font-medium">daftar</a>
                        untuk membagikan kisah Anda.
                    </p>
                </div>
                @endauth
            </div>
        </section>

        <!-- CTA Section -->
        <!-- <section class="py-20 px-4 sm:px-6 lg:px-10 bg-primary">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">Mari Bersama Membangun Indonesia yang Inklusif</h2>
                <p class="text-white/80 text-lg mb-8 max-w-2xl mx-auto">Bergabunglah dengan komunitas kami untuk menciptakan dialog yang bermakna antar pemeluk berbagai agama.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('register') }}" class="bg-white text-primary px-8 py-4 rounded-xl font-semibold hover:bg-white/90 transition-all shadow-lg">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('edukasi.index') }}" class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold hover:bg-white/10 transition-all">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </section> -->
    </main>

    <!-- Footer -->
    <footer class="bg-surface border-t border-accent-sand/50">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-secondary text-3xl">auto_awesome</span>
                        <span class="text-xl font-bold text-primary">HarmoniNusantara</span>
                    </div>
                    <p class="text-on-surface-variant max-w-sm">Platform digital untuk mempererat toleransi dan merayakan keberagaman agama di Indonesia.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-primary mb-4">Navigasi</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('edukasi.index') }}" class="text-on-surface-variant hover:text-primary transition-colors">Edukasi</a></li>
                        <li><a href="{{ route('ibadah.jadwal') }}" class="text-on-surface-variant hover:text-primary transition-colors">Jadwal Ibadah</a></li>
                        <li><a href="{{ route('edukasi.video.index') }}" class="text-on-surface-variant hover:text-primary transition-colors">Kisah Inspiratif</a></li>
                        <li><a href="{{ route('aksi.donasi.index') }}" class="text-on-surface-variant hover:text-primary transition-colors">Donasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-primary mb-4">Kontak</h4>
                    <ul class="space-y-2 text-on-surface-variant">
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">email</span>
                            hello@harmoni.id
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">phone</span>
                            +62 21 1234 5678
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-accent-sand/30 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-on-surface-variant">© 2025 Harmoni Nusantara. Menjaga Toleransi, Merawat Keberagaman Indonesia.</p>
                <div class="flex gap-4">
                    <a href="#" class="p-2 text-primary hover:bg-primary-50 rounded-full transition-colors">
                        <span class="material-symbols-outlined">share</span>
                    </a>
                    <a href="#" class="p-2 text-primary hover:bg-primary-50 rounded-full transition-colors">
                        <span class="material-symbols-outlined">language</span>
                    </a>
                    <a href="#" class="p-2 text-primary hover:bg-primary-50 rounded-full transition-colors">
                        <span class="material-symbols-outlined">rss_feed</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>