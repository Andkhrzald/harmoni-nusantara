<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AladhanService
{
    private string $baseUrl = 'https://api.aladhan.com/v1';

    public function getPrayerTimesByCity(string $city = 'Jakarta', string $country = 'Indonesia'): array
    {
        $cacheKey = "prayer_times_{$city}_".date('Y-m-d');

        return Cache::remember($cacheKey, now()->endOfDay(), function () use ($city, $country) {
            $response = Http::get("{$this->baseUrl}/timingsByCity", [
                'city' => $city,
                'country' => $country,
                'method' => 11,
            ]);

            return $response->json('data.timings') ?? [];
        });
    }

    public function getMonthlySchedule(int $month, int $year, string $city = 'Jakarta'): array
    {
        $cacheKey = "prayer_monthly_{$city}_{$month}_{$year}";

        return Cache::remember($cacheKey, now()->addDays(30), function () use ($month, $year, $city) {
            $response = Http::get("{$this->baseUrl}/calendarByCity", [
                'city' => $city,
                'country' => 'Indonesia',
                'method' => 11,
                'month' => $month,
                'year' => $year,
            ]);

            return $response->json('data') ?? [];
        });
    }
}
