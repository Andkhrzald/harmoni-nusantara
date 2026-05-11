<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edukasi & Literasi Keagamaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Pilih Agama</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach($religions as $religion)
                        <a href="{{ route('edukasi.religion', $religion->slug) }}"
                           class="p-4 border rounded-lg hover:bg-gray-50 text-center">
                            <span class="text-2xl">🕉️</span>
                            <p class="mt-2 font-medium">{{ $religion->name }}</p>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Konten Terbaru</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($featuredContents as $content)
                        <a href="{{ route('edukasi.show', $content->slug) }}" class="border rounded-lg overflow-hidden hover:shadow-md">
                            @if($content->thumbnail_url)
                                <img src="{{ $content->thumbnail_url }}" alt="{{ $content->title }}" class="w-full h-40 object-cover" loading="lazy">
                            @else
                                <div class="w-full h-40 bg-gray-200 flex items-center justify-center">
                                    <span class="text-4xl">📚</span>
                                </div>
                            @endif
                            <div class="p-4">
                                <p class="text-sm text-gray-500">{{ $content->religion->name ?? '' }}</p>
                                <h4 class="font-semibold mt-1">{{ $content->title }}</h4>
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-500 col-span-3">Belum ada konten tersedia.</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('edukasi.gallery') }}" class="bg-indigo-100 p-6 rounded-lg hover:bg-indigo-200 text-center">
                    <span class="text-3xl">🎥</span>
                    <h4 class="font-semibold mt-2">Galeri Video</h4>
                    <p class="text-sm text-gray-600">Tonton video edukatif dari YouTube</p>
                </a>
                <a href="{{ route('edukasi.virtual-tour') }}" class="bg-green-100 p-6 rounded-lg hover:bg-green-200 text-center">
                    <span class="text-3xl">🌍</span>
                    <h4 class="font-semibold mt-2">Wisata Virtual</h4>
                    <p class="text-sm text-gray-600">Jelajahi rumah ibadah secara virtual</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>