<x-app-layout>
    @section('title', $factCheck->title)
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $factCheck->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <span class="px-4 py-2 text-sm rounded-full
                        @if($factCheck->verdict === 'hoax') bg-red-100 text-red-800
                        @elseif($factCheck->verdict === 'true') bg-green-100 text-green-800
                        @elseif($factCheck->verdict === 'misleading') bg-yellow-100 text-yellow-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($factCheck->verdict) }}
                    </span>
                    <span class="text-sm text-gray-500">Ditulis oleh {{ $factCheck->author->name ?? 'Admin' }}</span>
                </div>

                <div class="prose max-w-none mb-6">
                    {!! nl2br(e($factCheck->content)) !!}
                </div>

                @if($factCheck->source_link)
                <div class="border-t pt-4">
                    <p class="text-sm text-gray-500">Sumber:</p>
                    <a href="{{ $factCheck->source_link }}" target="_blank" class="text-indigo-600 hover:text-indigo-800">
                        {{ $factCheck->source_link }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>