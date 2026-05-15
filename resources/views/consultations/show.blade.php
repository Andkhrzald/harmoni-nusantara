<x-app-layout>
    @section('title', $consultation->title)
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $consultation->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <span class="px-3 py-1 text-sm rounded-full
                        @if($consultation->status === 'open') bg-yellow-100 text-yellow-800
                        @elseif($consultation->status === 'in_progress') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst(str_replace('_', ' ', $consultation->status)) }}
                    </span>
                    @if($consultation->expert)
                    <span class="text-sm text-gray-500">Penyuluh: {{ $consultation->expert->name }}</span>
                    @endif
                </div>

                <div class="space-y-4 mb-6">
                    @forelse($messages as $message)
                    <div class="p-4 rounded-lg {{ $message->sender_id === auth()->id() ? 'bg-indigo-50 ml-12' : 'bg-gray-50 mr-12' }}">
                        <p class="text-sm font-medium text-gray-700 mb-1">
                            {{ $message->sender->name }}
                            @if($message->sender_id === auth()->id())
                            <span class="text-gray-400">(Anda)</span>
                            @endif
                        </p>
                        <p class="text-gray-800">{{ $message->message }}</p>
                        <p class="text-xs text-gray-500 mt-2">{{ $message->created_at->format('d M Y H:i') }}</p>
                    </div>
                    @empty
                    <p class="text-gray-500 text-center py-8">Belum ada pesan. Mulai percakapan!</p>
                    @endforelse
                </div>

                <form action="{{ route('aksi.konsultasi.message', $consultation->id) }}" method="POST">
                    @csrf
                    <div class="flex gap-4">
                        <input type="text" name="message" class="flex-1 border rounded-lg px-4 py-2" placeholder="Tulis pesan..." required>
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>