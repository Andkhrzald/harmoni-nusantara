<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Progres Belajar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-6">Konten yang Telah AndaBaca</h3>

                    @if($progress->isEmpty())
                        <p class="text-gray-500">Anda belum memulai belajar apapun.</p>
                        <a href="{{ route('edukasi.index') }}" class="inline-block mt-4 text-indigo-600 hover:text-indigo-800">
                            Mulai Jelajahi Edukasi →
                        </a>
                    @else
                        <div class="space-y-4">
                            @foreach($progress as $item)
                                <div class="border-b pb-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium">{{ $item->educationContent->title ?? 'Konten Tidak Ditemukan' }}</h4>
                                            <p class="text-sm text-gray-500">
                                                Terakhir diakses: {{ $item->last_accessed ? $item->last_accessed->format('d M Y') : '-' }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-sm font-medium">{{ $item->progress_pct }}%</span>
                                            @if($item->completed)
                                                <span class="ml-2 text-green-600">✓ Selesai</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $item->progress_pct }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>