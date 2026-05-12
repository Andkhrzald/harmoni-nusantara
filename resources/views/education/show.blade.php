<x-app-layout>
    @php
        $isVideo = $content->content_type === 'video';
        $isArticle = $content->content_type === 'article';
        $religionName = $content->religion->name ?? '';
        $authorName = $content->author->name ?? 'Admin';
        $createdDate = $content->created_at ? $content->created_at->format('d M Y') : '';
    @endphp

    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-2">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $content->title }}
                </h2>
                <p class="text-sm text-gray-500 mt-0.5">
                    <span class="inline-flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">folder</span>
                        {{ $religionName }}
                    </span>
                    <span class="mx-2">·</span>
                    <span class="inline-flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">visibility</span>
                        {{ $content->views_count }}x dilihat
                    </span>
                    @if ($createdDate)
                        <span class="mx-2">·</span>
                        <span class="inline-flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">calendar_today</span>
                            {{ $createdDate }}
                        </span>
                    @endif
                </p>
            </div>
            <x-tts-button target="#content-body" label="Dengarkan" />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ url()->previous() }}" class="text-sm text-gray-500 hover:text-gray-700 inline-flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Kembali
                </a>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">

                {{-- Video embed --}}
                @if ($isVideo && $content->youtube_video_id)
                    <div class="relative w-full" style="padding-bottom: 56.25%;">
                        <iframe
                            src="https://www.youtube.com/embed/{{ $content->youtube_video_id }}"
                            class="absolute inset-0 w-full h-full"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                @elseif ($content->thumbnail_url)
                    <img src="{{ $content->thumbnail_url }}"
                         alt="{{ $content->title }}"
                         class="w-full h-64 object-cover">
                @endif

                {{-- Meta badges --}}
                <div class="px-6 pt-6 pb-2 flex flex-wrap items-center gap-2">
                    @if ($isVideo)
                        <span class="inline-flex items-center gap-1 text-xs bg-red-100 text-red-700 px-2.5 py-1 rounded-full font-medium">
                            <span class="material-symbols-outlined text-sm">play_circle</span>
                            Video
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-xs bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full font-medium">
                            <span class="material-symbols-outlined text-sm">article</span>
                            Artikel
                        </span>
                    @endif
                    @if ($content->age_group)
                        <span class="inline-flex items-center gap-1 text-xs bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full">
                            <span class="material-symbols-outlined text-sm">group</span>
                            {{ $content->age_group }}
                        </span>
                    @endif
                    <span class="inline-flex items-center gap-1 text-xs bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full">
                        <span class="material-symbols-outlined text-sm">person</span>
                        {{ $authorName }}
                    </span>
                </div>

                {{-- Content body --}}
                <div class="px-6 pb-6 pt-2">
                    <div id="content-body" class="prose prose-gray max-w-none leading-relaxed">
                        {!! nl2br(e($content->content)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>