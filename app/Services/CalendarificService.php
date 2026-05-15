<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CalendarificService
{
    private string $baseUrl = 'https://calendarific.com/api/v2';

    public function getHolidays(int $month, int $year, string $country = 'ID'): array
    {
        $cacheKey = "holidays_{$country}_{$month}_{$year}";

        if ($cached = Cache::get($cacheKey)) {
            return $cached;
        }

        try {
            $response = Http::timeout(10)->get("{$this->baseUrl}/holidays", [
                'api_key' => config('services.calendarific.key'),
                'year' => $year,
                'month' => $month,
                'country' => $country,
            ]);

            $data = $response->json('response.holidays') ?? [];

            if ($data) {
                Cache::put($cacheKey, $data, now()->addDays(7));
            }

            return $data;
        } catch (\Exception $e) {
            Log::error('CalendarificService::getHolidays failed', [
                'error' => $e->getMessage(),
                'month' => $month,
                'year' => $year,
            ]);

            return [];
        }
    }

    public function getHolidaysForYear(int $year, string $country = 'ID'): array
    {
        $cacheKey = "holidays_{$country}_{$year}";

        if ($cached = Cache::get($cacheKey)) {
            return $cached;
        }

        try {
            $response = Http::timeout(10)->get("{$this->baseUrl}/holidays", [
                'api_key' => config('services.calendarific.key'),
                'year' => $year,
                'country' => $country,
            ]);

            $data = $response->json('response.holidays') ?? [];

            if ($data) {
                Cache::put($cacheKey, $data, now()->addDays(7));
            }

            return $data;
        } catch (\Exception $e) {
            Log::error('CalendarificService::getHolidaysForYear failed', [
                'error' => $e->getMessage(),
                'year' => $year,
            ]);

            return [];
        }
    }
}
