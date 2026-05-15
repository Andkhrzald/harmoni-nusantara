<?php

namespace App\Http\Controllers;

use App\Services\AladhanService;
use App\Services\CalendarificService;
use App\Services\GoogleMapsService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class WorshipController extends Controller
{
    public function index(): View
    {
        return view('worship.index');
    }

    public function schedule(): View
    {
        $city = request('city', 'Jakarta');

        $aladhan = new AladhanService;
        $todayTimes = $aladhan->getPrayerTimesByCity($city);

        $month = now()->month;
        $year = now()->year;
        $monthlySchedule = $aladhan->getMonthlySchedule($month, $year, $city);

        $calendarific = new CalendarificService;
        $holidays = $calendarific->getHolidays($month, $year);

        return view('worship.schedule', compact('todayTimes', 'monthlySchedule', 'holidays', 'city'));
    }

    public function map(): View
    {
        $lat = request('lat');
        $lng = request('lng');
        $mapsKey = config('services.google.maps_key');

        return view('worship.map', compact('lat', 'lng', 'mapsKey'));
    }

    public function findNearbyPlaces(): JsonResponse
    {
        $lat = request('lat');
        $lng = request('lng');

        if (! $lat || ! $lng) {
            return response()->json(['error' => 'Location required'], 400);
        }

        $mapsService = new GoogleMapsService;
        $places = $mapsService->findNearbyWorshipPlaces((float) $lat, (float) $lng, 5000);

        return response()->json(['places' => $places]);
    }

    public function guide(?string $religion = null): View
    {
        return view('worship.guide', compact('religion'));
    }

    public function etiquette(?string $religion = null): View
    {
        return view('worship.etiquette', compact('religion'));
    }
}
