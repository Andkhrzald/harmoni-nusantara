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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($videos as $video)
                    <a href="{{ route('edukasi.show', $video->slug) }}" class="group bg-white shadow-sm rounded-xl overflow-hidden hover:shadow-md transition-shadow">
                        <div class="relative overflow-hidden">
                            @if($video->thumbnail_url)
                                <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-5xl text-gray-400">play_circle</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                            <span class="absolute bottom-3 right-3 bg-black/80 text-white text-xs px-2.5 py-1 rounded-full flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">play_arrow</span>
                                Tonton
                            </span>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="text-xs bg-red-50 text-red-600 px-2 py-0.5 rounded-full font-medium">Video</span>
                                @if ($video->religion)
                                    <span class="text-xs text-gray-400">{{ $video->religion->name }}</span>
                                @endif
                            </div>
                            <h4 class="font-semibold text-gray-800 group-hover:text-indigo-600 transition-colors leading-snug">{{ $video->title }}</h4>
                            <p class="text-sm text-gray-400 mt-1.5 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">visibility</span>
                                {{ $video->views_count }}x ditonton
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-16 text-gray-400">
                        <span class="material-symbols-outlined text-5xl">videocam_off</span>
                        <p class="mt-2">Belum ada video tersedia.</p>
                    </div>
                @endforelse
            </div>

            @if ($videos->hasPages())
                <div class="mt-8">
                    {{ $videos->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
