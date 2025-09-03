<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Counselor;

class NewPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('auth.reset-password');
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
