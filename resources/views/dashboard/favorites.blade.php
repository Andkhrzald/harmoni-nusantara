<x-dashboard-layout>
    @section('title', 'Favorit')

    <div class="bg-white rounded-2xl shadow-sm border border-gray-50">
        <div class="p-6 sm:p-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-red-500">favorite</span>
                Konten Favorit Anda
            </h3>

            @if($favorites->isEmpty())
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-5xl text-gray-300">favorite_border</span>
                    <p class="text-gray-500 mt-3">Anda belum memiliki konten favorit.</p>
                    <a href="{{ route('edukasi.index') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-primary hover:text-primary-700 font-medium">
                        Jelajahi Konten Edukasi
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($favorites as $favorite)
                        @if($favorite->content)
                        <div class="group border border-gray-100 rounded-xl overflow-hidden hover:shadow-md transition-shadow">
                            <a href="{{ route('edukasi.video.show', $favorite->content->slug) }}">
                                @if($favorite->content->thumbnail_url)
                                    <img src="{{ $favorite->content->thumbnail_url }}" alt="{{ $favorite->content->title }}"
                                         class="w-full h-36 object-cover group-hover:scale-105 transition-transform duration-300"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-36 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-4xl text-gray-300">auto_stories</span>
                                    </div>
                                @endif
                            </a>
                            <div class="p-4">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs {{ $favorite->content->content_type === 'video' ? 'bg-red-50 text-red-600' : 'bg-blue-50 text-blue-600' }} px-2 py-0.5 rounded-full font-medium">
                                        {{ $favorite->content->content_type === 'video' ? 'Video' : 'Artikel' }}
                                    </span>
                                    @if ($favorite->content->religion)
                                        <span class="text-xs text-gray-400">{{ $favorite->content->religion->name }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('edukasi.video.show', $favorite->content->slug) }}">
                                    <h4 class="font-semibold text-gray-800 group-hover:text-primary transition-colors leading-snug line-clamp-2">{{ $favorite->content->title }}</h4>
                                </a>
                                <div class="flex items-center justify-between mt-3">
                                    <p class="text-xs text-gray-400">{{ $favorite->created_at->format('d M Y') }}</p>
                                    <form action="{{ route('edukasi.favorite', $favorite->content->slug) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-xs text-red-500 hover:text-red-600 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>