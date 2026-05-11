<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VolunteerController extends Controller
{
    public function index(): View
    {
        $volunteers = Volunteer::with('user')
            ->where('status', 'active')
            ->latest()
            ->paginate(12);

        return view('volunteers.index', compact('volunteers'));
    }

    public function create(): View
    {
        return view('volunteers.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'program_name' => ['required', 'string', 'max:255'],
            'religion_scope' => ['nullable', 'string', 'in:all,islam,kristen,katolik,hindu,buddha,konghucu'],
            'location' => ['nullable', 'string', 'max:255'],
            'motivation' => ['nullable', 'string', 'max:2000'],
        ]);

        $existing = Volunteer::where('user_id', auth()->id())
            ->where('program_name', $request->program_name)
            ->whereIn('status', ['pending', 'active'])
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah terdaftar di program ini.');
        }

        Volunteer::create([
            'user_id' => auth()->id(),
            'program_name' => $request->program_name,
            'religion_scope' => $request->religion_scope ?? 'all',
            'location' => $request->location,
            'motivation' => $request->motivation,
            'status' => 'pending',
        ]);

        return redirect()->route('aksi.volunteers.index')
            ->with('success', 'Pendaftaran relator berhasil! Kami akan menghubungi Anda segera.');
    }

    public function myVolunteers(): View
    {
        $volunteers = Volunteer::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('volunteers.my', compact('volunteers'));
    }
}
