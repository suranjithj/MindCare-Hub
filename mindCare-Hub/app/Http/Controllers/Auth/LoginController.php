<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Counselor;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email = $request->email;
        $password = $request->password;

        // Try login as Admin or User
        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::guard('web')->login($user);

            // Check if admin
            if ($user->email === 'admin@mindcare.com') {
                return redirect()->intended('/admin/dashboard');
            }

            // user
            return redirect()->intended('/user/dashboard');
        }

        // Try login as Counselor
        $counselor = Counselor::where('email', $email)->first();

        if ($counselor && Hash::check($password, $counselor->password)) {
            Auth::guard('counselor')->login($counselor);
            return redirect()->intended('/counselor/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::guard('counselor')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
