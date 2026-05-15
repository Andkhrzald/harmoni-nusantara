<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class YouTubeService
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.google.youtube_key');
    }

    public function searchVideos(string $query, int $maxResults = 12): array
    {
        try {
            $response = Http::timeout(10)->withHeaders(['Referer' => config('app.url')])
                ->get('https://www.googleapis.com/youtube/v3/search', [
                    'part' => 'snippet',
                    'q' => "{$query} edukasi",
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
        } catch (\Exception $e) {
            Log::error('YouTubeService::searchVideos failed', [
                'error' => $e->getMessage(),
                'query' => $query,
            ]);

            return [];
        }
    }

    public function getVideoDetails(string $videoId): array
    {
        try {
            $response = Http::timeout(10)->withHeaders(['Referer' => config('app.url')])
                ->get('https://www.googleapis.com/youtube/v3/videos', [
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
        } catch (\Exception $e) {
            Log::error('YouTubeService::getVideoDetails failed', [
                'error' => $e->getMessage(),
                'video_id' => $videoId,
            ]);

            return [];
        }
    }
}
