<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleMapsService
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.google.maps_key');
    }

    public function findNearbyWorshipPlaces(float $lat, float $lng, int $radius = 2000): array
    {
        try {
            $response = Http::timeout(10)->withHeaders([
                'X-Goog-Api-Key' => $this->apiKey,
                'X-Goog-FieldMask' => 'places.displayName,places.location,places.formattedAddress,places.rating,places.photos',
                'Referer' => config('app.url'),
            ])->post('https://places.googleapis.com/v1/places:searchNearby', [
                'includedTypes' => ['mosque', 'church', 'hindu_temple', 'buddhist_temple'],
                'locationRestriction' => [
                    'circle' => [
                        'center' => ['latitude' => $lat, 'longitude' => $lng],
                        'radius' => $radius,
                    ],
                ],
            ]);

            return $response->json('places') ?? [];
        } catch (\Exception $e) {
            Log::error('GoogleMapsService::findNearbyWorshipPlaces failed', [
                'error' => $e->getMessage(),
                'lat' => $lat,
                'lng' => $lng,
            ]);

            return [];
        }
    }

    public function getPlaceDetails(string $placeId): array
    {
        try {
            $response = Http::timeout(10)->withHeaders([
                'X-Goog-Api-Key' => $this->apiKey,
                'X-Goog-FieldMask' => 'displayName,formattedAddress,rating,reviews,photos,openingHours',
                'Referer' => config('app.url'),
            ])->get("https://places.googleapis.com/v1/places/{$placeId}");

            return $response->json() ?? [];
        } catch (\Exception $e) {
            Log::error('GoogleMapsService::getPlaceDetails failed', [
                'error' => $e->getMessage(),
                'place_id' => $placeId,
            ]);

            return [];
        }
    }
}
