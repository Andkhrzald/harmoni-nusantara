<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index');
    }

    public function donations(): View
    {
        $donations = auth()->user()->donations()->with('project')->latest()->get();

        return view('dashboard.donations', compact('donations'));
    }

    public function learning(): View
    {
        $progress = auth()->user()->learningProgress()
            ->with('educationContent')
            ->latest()
            ->get();

        return view('dashboard.learning', compact('progress'));
    }

    public function consultations(): View
    {
        $consultations = auth()->user()->consultations()
            ->with('expert')
            ->latest()
            ->get();

        return view('dashboard.consultations', compact('consultations'));
    }
}
