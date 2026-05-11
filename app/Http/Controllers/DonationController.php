<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonationProject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DonationController extends Controller
{
    public function index(): View
    {
        $projects = DonationProject::where('status', 'active')
            ->with('creator')
            ->latest()
            ->paginate(12);

        return view('donations.index', compact('projects'));
    }

    public function show(int $id): View
    {
        $project = DonationProject::with('creator', 'donations.user')
            ->findOrFail($id);

        $stats = [
            'total_raised' => $project->donations()->where('payment_status', 'success')->sum('amount'),
            'donor_count' => $project->donations()->where('payment_status', 'success')->distinct('user_id')->count(),
            'days_left' => $project->deadline ? now()->diffInDays($project->deadline, false) : null,
            'percentage' => $project->target_amount > 0
                ? min(100, round(($project->donations()->where('payment_status', 'success')->sum('amount') / $project->target_amount) * 100))
                : 0,
        ];

        return view('donations.show', compact('project', 'stats'));
    }

    public function store(Request $request, int $id): RedirectResponse
    {
        $project = DonationProject::findOrFail($id);

        $request->validate([
            'amount' => ['required', 'numeric', 'min:1000'],
            'anonymous' => ['boolean'],
        ]);

        $donation = Donation::create([
            'user_id' => auth()->id(),
            'project_id' => $project->id,
            'amount' => $request->amount,
            'anonymous_flag' => $request->boolean('anonymous'),
            'payment_status' => 'success',
            'payment_method' => 'manual',
        ]);

        $project->current_amount += $request->amount;
        $project->save();

        return redirect()->route('aksi.donasi.show', $project->id)
            ->with('success', 'Donasi berhasil! Terima kasih atas ketulusan hati Anda.');
    }

    public function create(): View
    {
        return view('donations.create');
    }

    public function storeProject(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'target_amount' => ['required', 'numeric', 'min:100000'],
            'religion_scope' => ['nullable', 'string', 'in:all,islam,kristen,katolik,hindu,buddha,konghucu'],
            'deadline' => ['nullable', 'date', 'after:today'],
        ]);

        $project = DonationProject::create([
            ...$request->only(['title', 'description', 'target_amount', 'religion_scope', 'deadline']),
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('aksi.donasi.show', $project->id)
            ->with('success', 'Campaign donasi berhasil dibuat!');
    }
}
