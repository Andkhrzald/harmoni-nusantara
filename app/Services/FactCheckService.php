<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FactCheckService
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.google.factcheck_key');
    }

    public function checkClaim(string $query): array
    {
        try {
            $response = Http::timeout(10)->withHeaders(['Referer' => config('app.url')])
                ->get('https://factchecktools.googleapis.com/v1alpha1/claims:search', [
                    'query' => $query,
                    'key' => $this->apiKey,
                ]);

            return $response->json('claims') ?? [];
        } catch (\Exception $e) {
            Log::error('FactCheckService::checkClaim failed', [
                'error' => $e->getMessage(),
                'query' => $query,
            ]);

            return [];
        }
    }

    public function checkClaimWithLanguage(string $query, string $languageCode = 'id'): array
    {
        try {
            $response = Http::timeout(10)->withHeaders(['Referer' => config('app.url')])
                ->get('https://factchecktools.googleapis.com/v1alpha1/claims:search', [
                    'query' => $query,
                    'languageCode' => $languageCode,
                    'key' => $this->apiKey,
                ]);

            return $response->json() ?? [];
        } catch (\Exception $e) {
            Log::error('FactCheckService::checkClaimWithLanguage failed', [
                'error' => $e->getMessage(),
                'query' => $query,
            ]);

            return [];
        }
    }
}
