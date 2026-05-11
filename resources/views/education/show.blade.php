<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $content->title }}
            </h2>
            <x-tts-button target="#content-body" label="Baca" />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p class="text-sm text-gray-500 mb-4">
                    {{ $content->religionCategory->name ?? '' }} | {{ $content->views_count }}x dilihat
                </p>

                @if($content->type === 'video' && $content->source_url)
                    <div class="mb-6">
                        <iframe loading="lazy" src="{{ $content->source_url }}"
                                class="w-full h-96 rounded-lg" frameborder="0" allowfullscreen></iframe>
                    </div>
                @endif

                <div id="content-body" class="prose max-w-none">
                    {!! nl2br(e($content->content)) !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>