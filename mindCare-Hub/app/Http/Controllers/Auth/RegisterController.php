<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Counselor;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationMail;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Add 'role' to the base rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|unique:counselors,email',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|in:user,counselor', // Add this rule
        ];

        // The input() method is safe to use here
        $role = $request->input('role');

        if ($role === 'counselor') {
            $rules = array_merge($rules, [
                'specialization' => 'nullable|string|max:255',
                'experience' => 'nullable|integer|min:0',
                'qualifications' => 'nullable|string|max:255',
                'consultation_fee' => 'nullable|numeric|min:0',
                'bio' => 'nullable|string',
                'location' => 'nullable|string|max:255',
                'languages' => 'nullable|string|max:255',
            ]);
        }

        // Now validate all fields, including 'role'
        $validated = $request->validate($rules);

        if ($validated['role'] === 'counselor') {
            $counselor = Counselor::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'specialization' => $validated['specialization'] ?? null,
                'experience' => $validated['experience'] ?? null,
                'qualifications' => $validated['qualifications'] ?? null,
                'consultation_fee' => $validated['consultation_fee'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'location' => $validated['location'] ?? null,
                'languages' => $validated['languages'] ?? null,
            ]);

            $this->sendRegistrationEmail($counselor, 'counselor');

        } else {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'package_id' => 1,
            ]);

            $this->sendRegistrationEmail($user, 'user');
        }

        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }

    protected function sendRegistrationEmail($user, $role)
    {
        Mail::to($user->email)->send(new RegistrationMail($user, $role));
    }
}
