<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function create(): View
    {
        return view('testimonials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string', 'min:10'],
        ]);

        Testimonial::create([
            'user_id' => auth()->id(),
            'name' => auth()->user()->name,
            'title' => $request->title,
            'content' => $request->content,
            'is_approved' => false,
        ]);

        return redirect()->route('home')->with('success', 'Terima kasih! Kisah Anda telah dikirim dan akan ditampilkan setelah diverifikasi.');
    }

    public function approve(int $id): RedirectResponse
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['is_approved' => true]);

        return redirect()->back()->with('success', 'Testimoni berhasil disetujui.');
    }

    public function reject(int $id): RedirectResponse
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->back()->with('success', 'Testimoni berhasil ditolak dan dihapus.');
    }
}
