<x-dashboard-layout>
    @section('title', 'Progres Belajar')

    <div class="bg-white rounded-2xl shadow-sm border border-gray-50">
        <div class="p-6 sm:p-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-blue-600">menu_book</span>
                Konten yang Telah Anda Baca
            </h3>

            @if($progress->isEmpty())
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-5xl text-gray-300">auto_stories</span>
                    <p class="text-gray-500 mt-3">Anda belum memulai belajar apapun.</p>
                    <a href="{{ route('edukasi.index') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-primary hover:text-primary-700 font-medium">
                        Mulai Jelajahi Edukasi
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($progress as $item)
                        <div class="border border-gray-100 rounded-xl p-4 hover:border-gray-200 transition-colors">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="font-medium text-gray-800">{{ $item->educationContent->title ?? 'Konten Tidak Ditemukan' }}</h4>
                                    <p class="text-sm text-gray-500 mt-0.5">
                                        Terakhir diakses: {{ $item->last_accessed ? $item->last_accessed->format('d M Y H:i') : '-' }}
                                    </p>
                                </div>
                                <div class="text-right shrink-0 ml-4">
                                    <span class="text-sm font-semibold text-gray-800">{{ $item->progress_pct }}%</span>
                                    @if($item->completed)
                                        <span class="ml-2 text-xs text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Selesai</span>
                                    @endif
                                </div>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-primary h-2 rounded-full transition-all" style="width: {{ $item->progress_pct }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>
