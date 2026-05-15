<x-app-layout>
    @section('title', 'Galeri Video Edukasi')
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Galeri Video Edukasi
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('edukasi.index') }}" class="text-sm text-gray-500 hover:text-gray-700 inline-flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Kembali ke Edukasi
                </a>
            </div>

            {{-- Religion filter chips --}}
            <div class="flex flex-wrap gap-2 mb-6">
                @foreach($religions as $religion)
                    <a href="{{ url()->current() }}?religion={{ $religion->slug }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium transition-colors
                           {{ $activeSlug === $religion->slug
                               ? 'bg-indigo-600 text-white shadow-sm'
                               : 'bg-white text-gray-600 border border-gray-200 hover:border-indigo-400 hover:text-indigo-600' }}">
                        @switch($religion->slug)
                            @case('islam') <span class="material-symbols-outlined text-sm">cruelty_free</span> @break
                            @case('kristen') <span class="material-symbols-outlined text-sm">church</span> @break
                            @case('katolik') <span class="material-symbols-outlined text-sm">church</span> @break
                            @case('hindu') <span class="material-symbols-outlined text-sm">self_improvement</span> @break
                            @case('buddha') <span class="material-symbols-outlined text-sm">spa</span> @break
                            @case('konghucu') <span class="material-symbols-outlined text-sm">diversity_3</span> @break
                        @endswitch
                        {{ $religion->name }}
                    </a>
                @endforeach
            </div>

            {{-- Video grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($videos as $video)
                    <a href="https://www.youtube.com/watch?v={{ $video['video_id'] }}"
                       target="_blank" rel="noopener noreferrer"
                       class="group bg-white shadow-sm rounded-xl overflow-hidden hover:shadow-md transition-shadow">
                        <div class="relative overflow-hidden">
                            <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}"
                                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                            <span class="absolute bottom-3 right-3 bg-black/80 text-white text-xs px-2.5 py-1 rounded-full flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">play_arrow</span>
                                Tonton
                            </span>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="text-xs bg-red-50 text-red-600 px-2 py-0.5 rounded-full font-medium">YouTube</span>
                                <span class="text-xs text-gray-400 truncate">{{ $video['channel'] ?? '' }}</span>
                            </div>
                            <h4 class="font-semibold text-gray-800 group-hover:text-indigo-600 transition-colors leading-snug line-clamp-2">{{ $video['title'] }}</h4>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-16 text-gray-400">
                        <span class="material-symbols-outlined text-5xl">videocam_off</span>
                        <p class="mt-2">Belum ada video tersedia untuk agama ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
