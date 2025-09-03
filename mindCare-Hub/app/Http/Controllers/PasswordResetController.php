<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function showResetForm()
    {
        return view('reset-password');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ]);

        // Check if email belongs to a User
        $user = User::where('email', $request->email)->first();

        // Check if email belongs to a Counselor
        $counselor = Counselor::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
        } elseif ($counselor) {
            $counselor->password = Hash::make($request->password);
            $counselor->save();
        } else {
            return back()->withErrors(['email' => 'Email not found']);
        }

        return redirect()->route('login')->with('status', 'Password reset successfully.');
    }
}
