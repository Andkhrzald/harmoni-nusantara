<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AladhanService
{
    private string $baseUrl = 'https://api.aladhan.com/v1';

    public function getPrayerTimesByCity(string $city = 'Jakarta', string $country = 'Indonesia'): array
    {
        $cacheKey = "prayer_times_{$city}_".date('Y-m-d');

        if ($cached = Cache::get($cacheKey)) {
            return $cached;
        }

        try {
            $response = Http::timeout(10)->get("{$this->baseUrl}/timingsByCity", [
                'city' => $city,
                'country' => $country,
                'method' => 11,
            ]);

            $data = $response->json('data.timings') ?? [];

            if ($data) {
                Cache::put($cacheKey, $data, now()->endOfDay());
            }

            return $data;
        } catch (\Exception $e) {
            Log::error('AladhanService::getPrayerTimesByCity failed', [
                'error' => $e->getMessage(),
                'city' => $city,
            ]);

            return [];
        }
    }

    public function getMonthlySchedule(int $month, int $year, string $city = 'Jakarta'): array
    {
        $cacheKey = "prayer_monthly_{$city}_{$month}_{$year}";

        if ($cached = Cache::get($cacheKey)) {
            return $cached;
        }

        try {
            $response = Http::timeout(10)->get("{$this->baseUrl}/calendarByCity", [
                'city' => $city,
                'country' => 'Indonesia',
                'method' => 11,
                'month' => $month,
                'year' => $year,
            ]);

            $data = $response->json('data') ?? [];

            if ($data) {
                Cache::put($cacheKey, $data, now()->addDays(30));
            }

            return $data;
        } catch (\Exception $e) {
            Log::error('AladhanService::getMonthlySchedule failed', [
                'error' => $e->getMessage(),
                'city' => $city,
                'month' => $month,
                'year' => $year,
            ]);

            return [];
        }
    }
}
