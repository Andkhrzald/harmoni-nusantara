<x-dashboard-layout>
    @section('title', 'Riwayat Konsultasi')

    <div class="bg-white rounded-2xl shadow-sm border border-gray-50">
        <div class="p-6 sm:p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary">forum</span>
                    Riwayat Konsultasi
                </h3>
                <a href="{{ route('aksi.konsultasi.create') }}"
                   class="inline-flex items-center gap-1.5 text-sm bg-primary text-white px-4 py-2 rounded-xl hover:bg-primary-700 transition-colors">
                    <span class="material-symbols-outlined text-sm">add</span>
                    Konsultasi Baru
                </a>
            </div>

            @if($consultations->isEmpty())
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-5xl text-gray-300">question_answer</span>
                    <p class="text-gray-500 mt-3">Anda belum memiliki konsultasi.</p>
                    <a href="{{ route('aksi.konsultasi.create') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-primary hover:text-primary-700 font-medium">
                        Mulai Konsultasi Baru
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($consultations as $consultation)
                        <a href="{{ route('aksi.konsultasi.show', $consultation->id) }}"
                           class="block border border-gray-100 rounded-xl p-4 hover:border-gray-200 hover:shadow-sm transition-all">
                            <div class="flex justify-between items-start">
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h4 class="font-medium text-gray-800 truncate">{{ $consultation->title }}</h4>
                                        <span @class([
                                            'px-2.5 py-0.5 rounded-full text-xs font-medium shrink-0',
                                            'bg-yellow-50 text-yellow-700' => $consultation->status === 'open',
                                            'bg-blue-50 text-blue-700' => $consultation->status === 'in_progress',
                                            'bg-gray-100 text-gray-600' => $consultation->status === 'closed',
                                        ])>
                                            @switch($consultation->status)
                                                @case('open') Terbuka @break
                                                @case('in_progress') Sedang Berjalan @break
                                                @case('closed') Selesai @break
                                                @default {{ ucfirst($consultation->status) }}
                                            @endswitch
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-500">
                                        Dibuat {{ $consultation->created_at->diffForHumans() }}
                                        @if($consultation->expert)
                                            · Penyuluh: {{ $consultation->expert->name }}
                                        @endif
                                    </p>
                                </div>
                                <span class="material-symbols-outlined text-gray-300 ml-4">chevron_right</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>
