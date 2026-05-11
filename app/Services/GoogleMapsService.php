<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleMapsService
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.google.maps_key');
    }

    public function findNearbyWorshipPlaces(float $lat, float $lng, int $radius = 2000): array
    {
        $response = Http::withHeaders([
            'X-Goog-Api-Key' => $this->apiKey,
            'X-Goog-FieldMask' => 'places.displayName,places.location,places.formattedAddress,places.rating,places.photos',
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
    }

    public function getPlaceDetails(string $placeId): array
    {
        $response = Http::withHeaders([
            'X-Goog-Api-Key' => $this->apiKey,
            'X-Goog-FieldMask' => 'displayName,formattedAddress,rating,reviews,photos,openingHours',
        ])->get("https://places.googleapis.com/v1/places/{$placeId}");

        return $response->json() ?? [];
    }
}
