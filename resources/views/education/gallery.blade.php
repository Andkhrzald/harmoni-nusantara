<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Galeri Video') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($videos as $video)
                    <a href="{{ route('edukasi.show', $video->slug) }}" class="bg-white shadow-sm rounded-lg overflow-hidden hover:shadow-md">
                        <div class="relative">
                            @if($video->thumbnail_url)
                                <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <span class="text-4xl">🎬</span>
                                </div>
                            @endif
                            <span class="absolute bottom-2 right-2 bg-black text-white text-xs px-2 py-1 rounded">
                                ▶ Video
                            </span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-semibold">{{ $video->title }}</h4>
                            <p class="text-sm text-gray-500 mt-1">{{ $video->channel }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500 col-span-3">Belum ada video tersedia.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $videos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>