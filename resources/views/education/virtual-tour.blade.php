<x-app-layout>
    @section('title', 'Wisata Religi Virtual - Edukasi')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wisata Religi Virtual') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($virtualTours as $tour)
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                        @if($tour->thumbnail_url)
                            <img src="{{ $tour->thumbnail_url }}" alt="{{ $tour->title }}" class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                <span class="text-6xl">🌍</span>
                            </div>
                        @endif
                        <div class="p-4">
                            <h4 class="font-semibold">{{ $tour->title }}</h4>
                            <p class="text-sm text-gray-500 mt-1">{{ $tour->religion->name ?? '' }}</p>
                            <a href="{{ route('edukasi.show', $tour->slug) }}" class="inline-block mt-3 text-indigo-600 hover:text-indigo-800">
                                Mulai Tur →
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-2">Belum ada wisata virtual tersedia.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>