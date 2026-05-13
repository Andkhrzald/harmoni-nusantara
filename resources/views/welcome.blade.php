<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ config('app.name', 'Harmoni Nusantara') }}</title>
    <meta name="description" content="Platform digital inklusif untuk mempererat toleransi dan merayakan keberagaman agama di Indonesia" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
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
    <nav class="glass-effect sticky top-0 z-50 border-b border-accent-sand/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-primary tracking-tight flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary text-3xl">auto_awesome</span>
                <span>Harmoni<span class="text-primary-700">Nusantara</span></span>
            </a>
            <div class="hidden lg:flex items-center gap-1">
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
                <a href="{{ route('edukasi.religion', $religion['slug']) }}" 
                   class="px-4 py-2 text-on-surface-variant hover:text-primary hover:bg-primary-50 rounded-lg font-medium text-sm transition-all duration-200">
                    {{ $religion['name'] }}
                </a>
                @endforeach
            </div>
            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="hidden lg:inline-flex bg-primary text-white px-5 py-2.5 rounded-lg font-semibold text-sm hover:bg-primary-600 transition-all shadow-sm hover:shadow-md">
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
                <button class="lg:hidden p-2 hover:bg-primary-50 rounded-lg transition-colors">
                    <span class="material-symbols-outlined text-primary">menu</span>
                </button>
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
                    <a href="{{ route('register') }}" class="bg-primary text-white px-8 py-4 rounded-xl font-semibold hover:bg-primary-600 transition-all shadow-lg shadow-primary/20 hover:shadow-xl hover:-translate-y-0.5 flex items-center gap-2">
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

        <!-- Faith Diversity Section -->
        <section class="py-20 px-4 sm:px-6 lg:px-10 bg-surface">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-primary mb-4">Keberagaman Agama di Indonesia</h2>
                    <p class="text-on-surface-variant max-w-2xl mx-auto">Indonesia memiliki tradisi religius yang kaya dengan enam agama resmi yang hidup berdampingan dalam harmoni.</p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                    @php
                    $faiths = [
                        ['name' => 'Islam', 'slug' => 'islam', 'image' => 'https://images.unsplash.com/photo-1584559582124-bafe7ab03a12?w=400&q=80', 'followers' => ''],
                        ['name' => 'Kristen', 'slug' => 'kristen', 'image' => 'https://images.unsplash.com/photo-1548625361-e80e71c60b68?w=400&q=80', 'followers' => ''],
                        ['name' => 'Katolik', 'slug' => 'katolik', 'image' => 'https://images.unsplash.com/photo-1548625361-e80e71c60b68?w=400&q=80', 'followers' => ''],
                        ['name' => 'Hindu', 'slug' => 'hindu', 'image' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=400&q=80', 'followers' => ''],
                        ['name' => 'Buddha', 'slug' => 'buddha', 'image' => 'https://images.unsplash.com/photo-1564760055775-d63b17a55c44?w=400&q=80', 'followers' => ''],
                        ['name' => 'Konghucu', 'slug' => 'konghucu', 'image' => 'https://images.unsplash.com/photo-1518659526054-190340b32700?w=400&q=80', 'followers' => ''],
                    ];
                    @endphp
                    @foreach($faiths as $faith)
                    <a href="{{ route('edukasi.religion', $faith['slug']) }}" class="group relative aspect-square rounded-2xl overflow-hidden">
                        <img src="{{ $faith['image'] }}" alt="{{ $faith['name'] }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <p class="text-white font-bold text-lg">{{ $faith['name'] }}</p>
                            <p class="text-white/80 text-sm">{{ $faith['followers'] }} penduduk</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
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
        <section class="py-20 px-4 sm:px-6 lg:px-10 max-w-7xl mx-auto">
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
                        <a href="{{ route('ibadah.schedule') }}" class="text-primary hover:text-primary-700 font-medium text-sm inline-flex items-center gap-1">
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
        <section class="py-20 px-4 sm:px-6 lg:px-10 bg-primary-50/50">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-bold text-primary mb-3">Kisah Inspiratif</h2>
                        <p class="text-on-surface-variant">Inspirasi dari tokoh agama dan pemuda nusantara</p>
                    </div>
                    <a href="{{ route('edukasi.gallery') }}" class="hidden sm:inline-flex items-center gap-2 text-secondary hover:text-secondary-700 font-medium transition-colors">
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
                    <a href="{{ route('edukasi.gallery') }}" class="inline-flex items-center gap-2 text-secondary font-medium">
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

        <!-- CTA Section -->
        <section class="py-20 px-4 sm:px-6 lg:px-10 bg-primary">
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
        </section>
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
                        <li><a href="{{ route('ibadah.schedule') }}" class="text-on-surface-variant hover:text-primary transition-colors">Jadwal Ibadah</a></li>
                        <li><a href="{{ route('edukasi.gallery') }}" class="text-on-surface-variant hover:text-primary transition-colors">Kisah Inspiratif</a></li>
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