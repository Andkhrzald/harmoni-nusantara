<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Konsultasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-6">Riwayat Konsultasi dengan Penyuluh</h3>

                    @if($consultations->isEmpty())
                        <p class="text-gray-500">Anda belum memiliki konsultasi.</p>
                        <a href="{{ route('aksi.consultations.create') }}" class="inline-block mt-4 text-indigo-600 hover:text-indigo-800">
                            Mulai Konsultasi Baru →
                        </a>
                    @else
                        <div class="space-y-4">
                            @foreach($consultations as $consultation)
                                <div class="border-b pb-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium">{{ $consultation->title }}</h4>
                                            <p class="text-sm text-gray-500">
                                                Dibuat: {{ $consultation->created_at->format('d M Y') }}
                                                @if($consultation->expert)
                                                    | Penyuluh: {{ $consultation->expert->name }}
                                                @endif
                                            </p>
                                        </div>
                                        <span class="px-3 py-1 text-sm rounded-full
                                            @if($consultation->status === 'open') bg-yellow-100 text-yellow-800
                                            @elseif($consultation->status === 'in_progress') bg-blue-100 text-blue-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $consultation->status)) }}
                                        </span>
                                    </div>
                                    <a href="{{ route('aksi.consultations.show', $consultation->id) }}"
                                       class="inline-block mt-2 text-sm text-indigo-600 hover:text-indigo-800">
                                        Lihat Detail →
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>