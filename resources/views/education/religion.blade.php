<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konten ') . $religion->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('edukasi.index') }}" class="text-indigo-600 hover:text-indigo-800">← Kembali ke Edukasi</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($contents as $content)
                    <a href="{{ route('edukasi.show', $content->slug) }}" class="bg-white shadow-sm rounded-lg overflow-hidden hover:shadow-md">
                        @if($content->thumbnail_url)
                            <img src="{{ $content->thumbnail_url }}" alt="{{ $content->title }}" class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gray-200 flex items-center justify-center">
                                <span class="text-4xl">📖</span>
                            </div>
                        @endif
                        <div class="p-4">
                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $content->content_type }}</span>
                            <h4 class="font-semibold mt-2">{{ $content->title }}</h4>
                            <p class="text-sm text-gray-500 mt-1">{{ $content->views_count }}x dilihat</p>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500 col-span-3">Belum ada konten untuk agama ini.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $contents->links() }}
            </div>
        </div>
    </div>
</x-app-layout>