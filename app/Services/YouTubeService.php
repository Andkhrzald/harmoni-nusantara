<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class YouTubeService
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.google.youtube_key');
    }

    public function searchVideos(string $query, int $maxResults = 12): array
    {
        $response = Http::get('https://www.googleapis.com/youtube/v3/search', [
            'part' => 'snippet',
            'q' => $query.' indonesia',
            'type' => 'video',
            'maxResults' => $maxResults,
            'key' => $this->apiKey,
        ]);

        $items = $response->json('items') ?? [];

        return collect($items)->map(function ($item) {
            return [
                'video_id' => $item['id']['videoId'] ?? null,
                'title' => $item['snippet']['title'] ?? '',
                'thumbnail' => $item['snippet']['thumbnails']['medium']['url'] ?? $item['snippet']['thumbnails']['default']['url'] ?? '',
                'channel' => $item['snippet']['channelTitle'] ?? '',
                'published' => $item['snippet']['publishedAt'] ?? '',
                'description' => $item['snippet']['description'] ?? '',
            ];
        })->toArray();
    }

    public function getVideoDetails(string $videoId): array
    {
        $response = Http::get('https://www.googleapis.com/youtube/v3/videos', [
            'part' => 'snippet,statistics',
            'id' => $videoId,
            'key' => $this->apiKey,
        ]);

        $item = $response->json('items')[0] ?? null;

        if (! $item) {
            return [];
        }

        return [
            'video_id' => $videoId,
            'title' => $item['snippet']['title'] ?? '',
            'description' => $item['snippet']['description'] ?? '',
            'thumbnail' => $item['snippet']['thumbnails']['high']['url'] ?? '',
            'channel' => $item['snippet']['channelTitle'] ?? '',
            'view_count' => $item['statistics']['viewCount'] ?? 0,
            'like_count' => $item['statistics']['likeCount'] ?? 0,
        ];
    }
}
