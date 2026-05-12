<?php

namespace App\Http\Controllers;

use App\Models\EducationContent;
use App\Models\ReligionCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EducationController extends Controller
{
    public function index(): View
    {
        $religions = ReligionCategory::all();
        $featuredContents = EducationContent::where('status', 'approved')
            ->with('religion')
            ->latest()
            ->take(6)
            ->get();

        return view('education.index', compact('religions', 'featuredContents'));
    }

    public function show(string $slug): View
    {
        $content = EducationContent::where('slug', $slug)
            ->with('religion', 'author')
            ->firstOrFail();

        $content->increment('views_count');

        if (auth()->check()) {
            $progress = auth()->user()->learningProgress()
                ->where('content_id', $content->id)
                ->first();

            if (! $progress) {
                auth()->user()->learningProgress()->create([
                    'content_id' => $content->id,
                    'completed' => false,
                    'progress_pct' => 0,
                ]);
            }
        }

        return view('education.show', compact('content'));
    }

    public function gallery(): View
    {
        $videos = EducationContent::where('status', 'approved')
            ->where('content_type', 'video')
            ->with('religion')
            ->latest()
            ->paginate(12);

        return view('education.gallery', compact('videos'));
    }

    public function virtualTour(): View
    {
        $virtualTours = EducationContent::where('status', 'approved')
            ->where('content_type', 'virtual_tour')
            ->with('religion')
            ->get();

        return view('education.virtual-tour', compact('virtualTours'));
    }

    public function byReligion(string $slug, Request $request): View
    {
        $religion = ReligionCategory::where('slug', $slug)->firstOrFail();

        $query = EducationContent::where('religion_id', $religion->id)
            ->where('status', 'approved')
            ->with('author');

        if ($request->filled('filter') && in_array($request->filter, ['article', 'video'])) {
            $query->where('content_type', $request->filter);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $contents = $query->latest()->paginate(12);

        return view('education.religion', compact('religion', 'contents'));
    }
}
