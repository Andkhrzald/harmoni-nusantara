@php
    $religionMeta = [
        'islam'    => ['icon' => 'mosque',        'primary' => 'emerald', 'gradient' => 'from-emerald-900 via-primary to-emerald-700', 'accent' => 'accent-gold', 'badge' => 'bg-emerald-50 text-emerald-700'],
        'kristen'  => ['icon' => 'church',        'primary' => 'blue',    'gradient' => 'from-blue-900 via-blue-700 to-blue-600',       'accent' => 'yellow-300', 'badge' => 'bg-blue-50 text-blue-700'],
        'katolik'  => ['icon' => 'church',        'primary' => 'violet',  'gradient' => 'from-violet-900 via-violet-700 to-violet-600', 'accent' => 'yellow-300', 'badge' => 'bg-violet-50 text-violet-700'],
        'hindu'    => ['icon' => 'temple_hindu',   'primary' => 'orange',  'gradient' => 'from-orange-800 via-orange-600 to-orange-500','accent' => 'yellow-200', 'badge' => 'bg-orange-50 text-orange-700'],
        'buddha'   => ['icon' => 'temple_buddhist','primary' => 'amber',  'gradient' => 'from-amber-900 via-amber-700 to-amber-600',   'accent' => 'yellow-200', 'badge' => 'bg-amber-50 text-amber-700'],
        'konghucu' => ['icon' => 'temple_buddhist','primary' => 'red',    'gradient' => 'from-red-800 via-red-600 to-red-500',         'accent' => 'yellow-200', 'badge' => 'bg-red-50 text-red-700'],
    ];
    $meta = $religionMeta[$religion->slug] ?? $religionMeta['islam'];
    $filter = request('filter', 'all');
    $search = request('search');
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-2">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-2xl text-primary">{{ $meta['icon'] }}</span>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $religion->name }}</h2>
            </div>
            <x-tts-button target="#content-body" label="Dengarkan" />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Hero agama --}}
            <div class="bg-gradient-to-r {{ $meta['gradient'] }} rounded-2xl p-6 sm:p-8 mb-6 text-white">
                <div class="flex items-start gap-4">
                    <span class="material-symbols-outlined text-5xl text-white/80 hidden sm:block">{{ $meta['icon'] }}</span>
                    <div class="flex-1">
                        <h1 class="text-2xl sm:text-3xl font-bold">{{ $religion->name }}</h1>
                        <p class="mt-1 text-white/80 text-sm sm:text-base max-w-2xl">{{ $religion->description }}</p>
                    </div>
                    <span class="material-symbols-outlined text-6xl text-white/10 hidden lg:block">{{ $meta['icon'] }}</span>
                </div>
                <div class="mt-4 flex flex-wrap gap-2">
                    <a href="{{ route('edukasi.index') }}" class="inline-flex items-center gap-1 text-xs bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 rounded-full transition-colors">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        Semua Agama
                    </a>
                    @if ($religion->slug === 'islam')
                        <a href="{{ route('ibadah.schedule') }}" class="inline-flex items-center gap-1 text-xs bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 rounded-full transition-colors">
                            <span class="material-symbols-outlined text-sm">schedule</span>
                            Jadwal Sholat
                        </a>
                        <a href="{{ route('ibadah.guide', 'islam') }}" class="inline-flex items-center gap-1 text-xs bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 rounded-full transition-colors">
                            <span class="material-symbols-outlined text-sm">live_help</span>
                            Panduan Ibadah
                        </a>
                    @endif
                </div>
            </div>

            {{-- Filter & Search --}}
            <div class="bg-white shadow-sm sm:rounded-xl p-4 mb-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    <div class="flex items-center gap-1 bg-gray-100 rounded-lg p-1">
                        <a href="{{ route('edukasi.religion', [$religion->slug, 'filter' => 'all']) }}"
                           class="px-3 py-1.5 text-sm font-medium rounded-md transition-all
                                  {{ $filter === 'all' ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                            Semua
                        </a>
                        <a href="{{ route('edukasi.religion', [$religion->slug, 'filter' => 'article']) }}"
                           class="px-3 py-1.5 text-sm font-medium rounded-md transition-all flex items-center gap-1
                                  {{ $filter === 'article' ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                            <span class="material-symbols-outlined text-sm">article</span>
                            Artikel
                        </a>
                        <a href="{{ route('edukasi.religion', [$religion->slug, 'filter' => 'video']) }}"
                           class="px-3 py-1.5 text-sm font-medium rounded-md transition-all flex items-center gap-1
                                  {{ $filter === 'video' ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                            <span class="material-symbols-outlined text-sm">play_circle</span>
                            Video
                        </a>
                    </div>

                    <form method="GET" action="{{ route('edukasi.religion', $religion->slug) }}" class="flex-1 flex gap-2 w-full sm:w-auto">
                        @if ($filter !== 'all')
                            <input type="hidden" name="filter" value="{{ $filter }}">
                        @endif
                        <div class="relative flex-1">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">search</span>
                            <input type="text" name="search" value="{{ $search }}"
                                   placeholder="Cari konten {{ strtolower($religion->name) }}..."
                                   class="w-full pl-9 pr-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
                        </div>
                        @if ($search)
                            <a href="{{ route('edukasi.religion', [$religion->slug, 'filter' => $filter !== 'all' ? $filter : null]) }}"
                               class="px-3 py-1.5 text-sm text-gray-500 hover:text-gray-700">Reset</a>
                        @endif
                    </form>
                </div>
            </div>

            {{-- Content grid --}}
            @if ($contents->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($contents as $content)
                        @php $isVideo = $content->content_type === 'video'; @endphp
                        <a href="{{ route('edukasi.show', $content->slug) }}"
                           class="group bg-white rounded-xl overflow-hidden border border-gray-100 hover:shadow-md transition-all">
                            <div class="relative overflow-hidden">
                                @if($content->thumbnail_url)
                                    <img src="{{ $content->thumbnail_url }}"
                                         alt="{{ $content->title }}"
                                         class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-300"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-44 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-5xl text-gray-300">
                                            {{ $isVideo ? 'play_circle' : 'auto_stories' }}
                                        </span>
                                    </div>
                                @endif
                                @if ($isVideo)
                                    <span class="absolute top-3 right-3 bg-black/70 text-white text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">play_arrow</span>
                                        Video
                                    </span>
                                @endif
                            </div>
                            <div class="p-4">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span class="text-xs {{ $isVideo ? 'bg-red-50 text-red-600' : 'bg-blue-50 text-blue-600' }} px-2 py-0.5 rounded-full font-medium">
                                        {{ $isVideo ? 'Video' : 'Artikel' }}
                                    </span>
                                </div>
                                <h4 class="font-semibold text-gray-800 group-hover:text-primary transition-colors leading-snug line-clamp-2">{{ $content->title }}</h4>
                                <p class="text-xs text-gray-400 mt-2 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">visibility</span>
                                    {{ $content->views_count }}x dilihat
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $contents->withQueryString()->links() }}
                </div>
            @else
                <div class="bg-white rounded-xl p-12 text-center">
                    <span class="material-symbols-outlined text-6xl text-gray-200">search_off</span>
                    <h3 class="text-lg font-semibold text-gray-500 mt-3">Konten Tidak Ditemukan</h3>
                    <p class="text-sm text-gray-400 mt-1">
                        @if ($search)
                            Tidak ada konten untuk pencarian "{{ $search }}".
                        @else
                            Belum ada konten untuk {{ $religion->name }}. Silakan cek kembali nanti.
                        @endif
                    </p>
                    @if ($search || $filter !== 'all')
                        <a href="{{ route('edukasi.religion', $religion->slug) }}"
                           class="mt-4 inline-flex items-center gap-1 text-sm text-primary hover:text-primary-700 font-medium">
                            <span class="material-symbols-outlined text-sm">refresh</span>
                            Tampilkan semua konten
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
