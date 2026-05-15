<x-app-layout>
    @php
        $religionMeta = [
            'islam'    => ['icon' => 'mosque',       'color' => 'emerald', 'gradient' => 'from-emerald-50 to-emerald-100', 'text' => 'text-emerald-700'],
            'kristen'  => ['icon' => 'church',       'color' => 'blue',    'gradient' => 'from-blue-50 to-blue-100',     'text' => 'text-blue-700'],
            'katolik'  => ['icon' => 'church',       'color' => 'violet',  'gradient' => 'from-violet-50 to-violet-100',  'text' => 'text-violet-700'],
            'hindu'    => ['icon' => 'temple_hindu',  'color' => 'orange',  'gradient' => 'from-orange-50 to-orange-100',  'text' => 'text-orange-700'],
            'buddha'   => ['icon' => 'temple_buddhist','color' => 'amber',  'gradient' => 'from-amber-50 to-amber-100',   'text' => 'text-amber-700'],
            'konghucu' => ['icon' => 'temple_buddhist','color' => 'red',    'gradient' => 'from-red-50 to-red-100',       'text' => 'text-red-700'],
        ];
    @endphp

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl text-primary">school</span>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edukasi & Literasi Keagamaan</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Pilih Agama --}}
            <div class="bg-white shadow-sm sm:rounded-xl p-6">
                <h3 class="text-base font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">explore</span>
                    Pilih Agama
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
                    @foreach($religions as $religion)
                        @php $meta = $religionMeta[$religion->slug] ?? ['icon' => 'menu_book', 'gradient' => 'from-gray-50 to-gray-100', 'text' => 'text-gray-700']; @endphp
                        <a href="{{ route('edukasi.agama', $religion->slug) }}"
                           class="group flex flex-col items-center p-5 bg-gradient-to-br {{ $meta['gradient'] }} rounded-xl
                                  border border-transparent hover:border-current hover:shadow-md transition-all duration-200">
                            <span class="material-symbols-outlined text-3xl {{ $meta['text'] }} group-hover:scale-110 transition-transform duration-300">
                                {{ $meta['icon'] }}
                            </span>
                            <p class="mt-2 text-sm font-medium text-gray-700 group-hover:text-gray-900 text-center">{{ $religion->name }}</p>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Konten Terbaru --}}
            <div class="mt-6 bg-white shadow-sm sm:rounded-xl p-6">
                <h3 class="text-base font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">newspaper</span>
                    Konten Terbaru
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @forelse($featuredContents as $content)
                        <a href="{{ route('edukasi.video.show', $content->slug) }}"
                           class="group border border-gray-100 rounded-xl overflow-hidden hover:shadow-md transition-shadow">
                            @if($content->thumbnail_url)
                                <img src="{{ $content->thumbnail_url }}" alt="{{ $content->title }}"
                                     class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300"
                                     loading="lazy">
                            @else
                                <div class="w-full h-40 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-5xl text-gray-300">auto_stories</span>
                                </div>
                            @endif
                            <div class="p-4">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs {{ $content->content_type === 'video' ? 'bg-red-50 text-red-600' : 'bg-blue-50 text-blue-600' }} px-2 py-0.5 rounded-full font-medium">
                                        {{ $content->content_type === 'video' ? 'Video' : 'Artikel' }}
                                    </span>
                                    @if ($content->religion)
                                        <span class="text-xs text-gray-400">{{ $content->religion->name }}</span>
                                    @endif
                                </div>
                                <h4 class="font-semibold text-gray-800 group-hover:text-primary transition-colors leading-snug">{{ $content->title }}</h4>
                                <p class="text-xs text-gray-400 mt-1.5">{{ $content->views_count }}x dibaca</p>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-3 text-center py-12 text-gray-400">
                            <span class="material-symbols-outlined text-5xl">library_books</span>
                            <p class="mt-2">Belum ada konten tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Quick links --}}
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('edukasi.video.index') }}"
                   class="group flex items-center gap-4 bg-gradient-to-r from-indigo-50 to-indigo-100 p-5 rounded-xl hover:shadow-md transition-all">
                    <span class="material-symbols-outlined text-3xl text-indigo-500">play_circle</span>
                    <div>
                        <h4 class="font-semibold text-indigo-800 group-hover:text-indigo-600">Galeri Video</h4>
                        <p class="text-sm text-indigo-600/70">Tonton video edukasi keagamaan</p>
                    </div>
                    <span class="material-symbols-outlined ml-auto text-indigo-400 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
                <a href="{{ route('edukasi.virtual-tour') }}"
                   class="group flex items-center gap-4 bg-gradient-to-r from-emerald-50 to-emerald-100 p-5 rounded-xl hover:shadow-md transition-all">
                    <span class="material-symbols-outlined text-3xl text-emerald-500">map</span>
                    <div>
                        <h4 class="font-semibold text-emerald-800 group-hover:text-emerald-600">Wisata Virtual</h4>
                        <p class="text-sm text-emerald-600/70">Jelajahi rumah ibadah dari rumah</p>
                    </div>
                    <span class="material-symbols-outlined ml-auto text-emerald-400 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
