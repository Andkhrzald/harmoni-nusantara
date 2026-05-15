<x-app-layout>
    @section('title', 'Cari Video Edukasi YouTube')
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl text-primary">play_circle</span>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cari Video Edukasi</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Search form --}}
            <div class="bg-red-50 shadow-sm rounded-2xl p-6 mb-6">
                <form action="{{ route('edukasi.video.cari') }}" method="GET" class="flex gap-3">
                    <div class="relative flex-1">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                        <input type="text" name="q" value="{{ $query }}"
                               class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300"
                               placeholder="Cari video tentang agama, budaya, atau kerukunan...">
                    </div>
                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors">
                        Cari
                    </button>
                </form>
            </div>

            <div class="mb-4">
                <a href="{{ route('edukasi.video.index') }}" class="text-sm text-gray-500 hover:text-gray-700 inline-flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Kembali ke Galeri Video
                </a>
            </div>

            @if ($query)
                <h3 class="text-base font-semibold text-gray-700 mb-4">
                    Hasil YouTube untuk: <span class="text-indigo-600">"{{ $query }}"</span>
                    <span class="text-gray-400 font-normal text-sm">({{ count($videos) }} video)</span>
                </h3>
            @endif

            @if (count($videos) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($videos as $video)
                        <a href="https://www.youtube.com/watch?v={{ $video['video_id'] }}"
                           target="_blank" rel="noopener noreferrer"
                           class="group bg-white shadow-sm rounded-xl overflow-hidden hover:shadow-md transition-shadow">
                            <div class="relative overflow-hidden">
                                @if ($video['thumbnail'])
                                    <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}"
                                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-red-50 to-red-100 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-5xl text-red-300">play_circle</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                                <span class="absolute bottom-3 right-3 bg-red-600/90 text-white text-xs px-2.5 py-1 rounded-full flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">play_arrow</span>
                                    YouTube
                                </span>
                            </div>
                            <div class="p-4">
                                <h4 class="font-semibold text-gray-800 group-hover:text-indigo-600 transition-colors leading-snug line-clamp-2">
                                    {{ $video['title'] }}
                                </h4>
                                <p class="text-xs text-gray-400 mt-1.5 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">person</span>
                                    {{ $video['channel'] }}
                                </p>
                                @if ($video['description'])
                                    <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $video['description'] }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            @elseif ($query)
                <div class="bg-white shadow-sm rounded-2xl p-12 text-center text-gray-400">
                    <span class="material-symbols-outlined text-5xl mb-3 block">videocam_off</span>
                    <p class="text-lg font-medium">Tidak ada video ditemukan</p>
                    <p class="text-sm mt-1">Coba kata kunci yang berbeda.</p>
                </div>
            @else
                <div class="bg-white shadow-sm rounded-2xl p-12 text-center text-gray-400">
                    <span class="material-symbols-outlined text-5xl mb-3 block">search</span>
                    <p class="text-lg font-medium">Cari video edukasi keagamaan</p>
                    <p class="text-sm mt-1">Masukkan kata kunci di atas untuk mencari video dari YouTube.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
