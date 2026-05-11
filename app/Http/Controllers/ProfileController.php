<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('dashboard.profile', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$request->user()->id],
            'religion_preference' => ['nullable', 'string', 'max:50', 'in:islam,kristen,katolik,hindu,buddha,konghucu'],
        ]);

        $request->user()->fill([
            'name' => $request->name,
            'email' => $request->email,
            'religion_preference' => $request->religion_preference,
        ]);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('dashboard.profile.edit')->with('status', 'profile-updated');
    }
}
