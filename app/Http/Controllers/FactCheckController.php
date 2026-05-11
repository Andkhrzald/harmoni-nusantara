<?php

namespace App\Http\Controllers;

use App\Models\FactCheck;
use App\Services\FactCheckService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FactCheckController extends Controller
{
    public function index(): View
    {
        $factChecks = FactCheck::whereNotNull('published_at')
            ->with('author')
            ->latest()
            ->paginate(12);

        return view('fact-check.index', compact('factChecks'));
    }

    public function show(int $id): View
    {
        $factCheck = FactCheck::with('author')->findOrFail($id);

        return view('fact-check.show', compact('factCheck'));
    }

    public function create(): View
    {
        return view('fact-check.create');
    }

    public function check(Request $request): View
    {
        $query = $request->get('q');

        if (! $query) {
            return view('fact-check.index', ['factChecks' => collect()]);
        }

        $factCheckService = new FactCheckService;
        $apiResults = $factCheckService->checkClaim($query);

        return view('fact-check.check', compact('query', 'apiResults'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'verdict' => ['required', 'string', 'in:hoax,true,misleading,unverified'],
            'source_link' => ['nullable', 'url', 'max:1000'],
        ]);

        FactCheck::create([
            'author_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'verdict' => $request->verdict,
            'source_link' => $request->source_link,
            'published_at' => now(),
        ]);

        return redirect()->route('aksi.cek-fakta.index')
            ->with('success', 'Hasil cek fakta berhasil dipublish!');
    }

    public function pending(): View
    {
        $factChecks = FactCheck::whereNull('published_at')
            ->with('author')
            ->latest()
            ->get();

        return view('fact-check.pending', compact('factChecks'));
    }

    public function publish(int $id): RedirectResponse
    {
        $factCheck = FactCheck::findOrFail($id);
        $factCheck->update(['published_at' => now()]);

        return back()->with('success', 'Cek fakta berhasil dipublish!');
    }
}
