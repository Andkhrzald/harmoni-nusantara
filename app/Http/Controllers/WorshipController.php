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
        $lat = request('lat', -6.2);
        $lng = request('lng', 106.8);

        $mapsService = new GoogleMapsService;
        $places = $mapsService->findNearbyWorshipPlaces($lat, $lng, 5000);

        return view('worship.map', compact('places', 'lat', 'lng'));
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
