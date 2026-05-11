<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CalendarificService
{
    private string $baseUrl = 'https://calendarific.com/api/v2';

    public function getHolidays(int $month, int $year, string $country = 'ID'): array
    {
        $cacheKey = "holidays_{$country}_{$month}_{$year}";

        return Cache::remember($cacheKey, now()->addDays(7), function () use ($month, $year, $country) {
            $apiKey = config('services.calendarific.key');

            $response = Http::get("{$this->baseUrl}/holidays", [
                'api_key' => $apiKey,
                'year' => $year,
                'month' => $month,
                'country' => $country,
            ]);

            return $response->json('response.holidays') ?? [];
        });
    }

    public function getHolidaysForYear(int $year, string $country = 'ID'): array
    {
        $cacheKey = "holidays_{$country}_{$year}";

        return Cache::remember($cacheKey, now()->addDays(7), function () use ($year, $country) {
            $apiKey = config('services.calendarific.key');

            $response = Http::get("{$this->baseUrl}/holidays", [
                'api_key' => $apiKey,
                'year' => $year,
                'country' => $country,
            ]);

            return $response->json('response.holidays') ?? [];
        });
    }
}
