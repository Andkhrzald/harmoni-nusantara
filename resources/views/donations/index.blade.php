<x-app-layout>
    @section('title', 'Donasi Inklusif')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Donasi Inklusif') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($projects as $project)
                    <a href="{{ route('aksi.donasi.show', $project->id) }}" class="bg-white shadow-sm rounded-lg overflow-hidden hover:shadow-md">
                        @if($project->cover_image)
                            <img src="{{ $project->cover_image }}" alt="{{ $project->title }}" class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center">
                                <span class="text-4xl">💝</span>
                            </div>
                        @endif
                        <div class="p-4">
                            <h4 class="font-semibold">{{ $project->title }}</h4>
                            <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $project->description }}</p>
                            <div class="mt-3">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ min(100, ($project->current_amount / $project->target_amount) * 100) }}%"></div>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">
                                    Rp {{ number_format($project->current_amount, 0, ',', '.') }} / Rp {{ number_format($project->target_amount, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500 col-span-3">Belum ada campaign donasi.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $projects->links() }}
            </div>
        </div>
    </div>
</x-app-layout>