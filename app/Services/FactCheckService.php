<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FactCheckService
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.google.factcheck_key');
    }

    public function checkClaim(string $query): array
    {
        $response = Http::get('https://factchecktools.googleapis.com/v1alpha1/claims:search', [
            'query' => $query,
            'languageCode' => 'id',
            'key' => $this->apiKey,
        ]);

        return $response->json('claims') ?? [];
    }

    public function checkClaimWithLanguage(string $query, string $languageCode = 'id'): array
    {
        $response = Http::get('https://factchecktools.googleapis.com/v1alpha1/claims:search', [
            'query' => $query,
            'languageCode' => $languageCode,
            'key' => $this->apiKey,
        ]);

        return $response->json() ?? [];
    }
}
