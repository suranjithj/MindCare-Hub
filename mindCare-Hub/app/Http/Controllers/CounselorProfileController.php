<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CounselorProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $counselor = Auth::guard('counselor')->user();

        return view('counselor.profile_edit', [
            'counselor' => $counselor,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $counselor = Auth::guard('counselor')->user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:counselors,email,' . $counselor->id,
            'specialization' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'qualifications' => 'nullable|string|max:255',
            'consultation_fee' => 'nullable|numeric|min:0',
            'bio' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'languages' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $counselor->fill($validatedData);

        if ($request->filled('password')) {
            $counselor->password = Hash::make($validatedData['password']);
        }

        if ($counselor->isDirty('email')) {
            $counselor->email_verified_at = null;
        }

        $counselor->save();

        return Redirect::route('counselor.profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required'],
        ]);

        $counselor = Auth::guard('counselor')->user();

        if (!Hash::check($request->password, $counselor->password)) {
            return Redirect::back()->withErrors(['password' => 'The provided password does not match our records.']);
        }

        Auth::guard('counselor')->logout();

        $counselor->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
