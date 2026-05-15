<x-app-layout>
    @section('title', 'Cek Fakta Keagamaan')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cek Fakta Keagamaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <form action="{{ route('aksi.fakta.cek') }}" method="GET" class="flex gap-4">
                    <input type="text" name="q" class="flex-1 border rounded-lg px-4 py-2" placeholder="Masukkan klaim atau berita yang ingin dicek...">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                        Cek Fakta
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($factChecks as $factCheck)
                    <a href="{{ route('aksi.fakta.show', $factCheck->id) }}" class="bg-white shadow-sm rounded-lg p-6 hover:shadow-md">
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-3 py-1 text-xs rounded-full
                                @if($factCheck->verdict === 'hoax') bg-red-100 text-red-800
                                @elseif($factCheck->verdict === 'true') bg-green-100 text-green-800
                                @elseif($factCheck->verdict === 'misleading') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($factCheck->verdict) }}
                            </span>
                            <span class="text-sm text-gray-500">{{ $factCheck->published_at?->format('d M Y') }}</span>
                        </div>
                        <h4 class="font-semibold mb-2">{{ $factCheck->title }}</h4>
                        <p class="text-sm text-gray-600 line-clamp-3">{{ $factCheck->content }}</p>
                    </a>
                @empty
                    <p class="text-gray-500 col-span-3">Belum ada hasil cek fakta.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $factChecks->links() }}
            </div>
        </div>
    </div>
</x-app-layout>