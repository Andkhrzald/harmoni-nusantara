<x-app-layout>
    @section('title', 'Hasil Cek Fakta: ' . $query)
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Cek Fakta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Search form --}}
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <form action="{{ route('aksi.fakta.cek') }}" method="GET" class="flex gap-4">
                    <input type="text" name="q" value="{{ $query }}"
                           class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                           placeholder="Masukkan klaim atau berita yang ingin dicek...">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                        Cek Fakta
                    </button>
                </form>
            </div>

            {{-- Query heading --}}
            <div class="mb-4">
                <a href="{{ route('aksi.fakta.index') }}" class="text-sm text-gray-500 hover:text-gray-700 inline-flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Kembali
                </a>
            </div>

            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Hasil pencarian untuk: <span class="text-indigo-600">"{{ $query }}"</span>
            </h3>

            {{-- API Results --}}
            @if (count($apiResults) > 0)
                <div class="space-y-6">
                    @foreach ($apiResults as $claim)
                        @php
                            $review = $claim['claimReview'][0] ?? null;
                            $rating = $review['textualRating'] ?? null;
                            $ratingLower = strtolower($rating ?? '');
                            $isTrue = str_contains($ratingLower, 'true') || str_contains($ratingLower, 'benar');
                            $isFalse = str_contains($ratingLower, 'false') || str_contains($ratingLower, 'hoax') || str_contains($ratingLower, 'salah');
                            $isMisleading = str_contains($ratingLower, 'misleading') || str_contains($ratingLower, 'menyesatkan');
                        @endphp
                        <div class="bg-white shadow-sm rounded-lg p-6 border-l-4
                            {{ $isTrue ? 'border-green-400' : ($isFalse ? 'border-red-400' : ($isMisleading ? 'border-yellow-400' : 'border-gray-300')) }}">

                            {{-- Claim text --}}
                            <p class="text-gray-800 font-medium mb-3">{{ $claim['text'] ?? 'Klaim tidak tersedia' }}</p>

                            @if (!empty($claim['claimant']))
                                <p class="text-sm text-gray-500 mb-1">
                                    <span class="font-semibold">Diklaim oleh:</span> {{ $claim['claimant'] }}
                                    @if (!empty($claim['claimDate']))
                                        &bull; {{ \Carbon\Carbon::parse($claim['claimDate'])->translatedFormat('d F Y') }}
                                    @endif
                                </p>
                            @endif

                            @if ($review)
                                <div class="mt-3 pt-3 border-t border-gray-100">
                                    <div class="flex items-center justify-between flex-wrap gap-2">
                                        <div>
                                            @if ($rating)
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                                                    {{ $isTrue ? 'bg-green-100 text-green-800' : ($isFalse ? 'bg-red-100 text-red-800' : ($isMisleading ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-700')) }}">
                                                    <span class="material-symbols-outlined text-sm">
                                                        {{ $isTrue ? 'check_circle' : ($isFalse ? 'cancel' : 'help') }}
                                                    </span>
                                                    {{ $rating }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-500 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-sm">language</span>
                                            {{ $review['publisher']['name'] ?? '' }}
                                            @if (!empty($review['reviewDate']))
                                                &bull; {{ \Carbon\Carbon::parse($review['reviewDate'])->translatedFormat('d F Y') }}
                                            @endif
                                        </div>
                                    </div>

                                    @if (!empty($review['title']))
                                        <p class="text-sm text-gray-700 mt-2">{{ $review['title'] }}</p>
                                    @endif

                                    @if (!empty($review['url']))
                                        <a href="{{ $review['url'] }}" target="_blank" rel="noopener noreferrer"
                                           class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-800 text-sm mt-2 transition-colors">
                                            <span class="material-symbols-outlined text-sm">open_in_new</span>
                                            Lihat sumber lengkap
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white shadow-sm rounded-lg p-12 text-center text-gray-400">
                    <span class="material-symbols-outlined text-5xl mb-3 block">search_off</span>
                    <p class="text-lg font-medium">Tidak ada hasil ditemukan</p>
                    <p class="text-sm mt-1">Coba gunakan kata kunci yang berbeda atau lebih spesifik.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
