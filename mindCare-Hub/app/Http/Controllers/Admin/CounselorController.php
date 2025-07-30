<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Counselor;
use Illuminate\Support\Facades\Hash;

class CounselorController extends Controller
{
    // List all counselors
    public function index()
    {
        $counselors = Counselor::paginate(10);
        return view('admin.counselors.index', compact('counselors'));
    }

    public function create()
    {
        return view('admin.counselors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:counselors,email',
            'password' => 'required|string|min:8|confirmed',
            'specialization' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'qualifications' => 'nullable|string|max:255',
            'consultation_fee' => 'nullable|numeric|min:0',
            'bio' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'languages' => 'nullable|string|max:255',
        ]);

        Counselor::create([
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

        return redirect()->route('admin.counselors.index')->with('success', 'Counselor created successfully.');
    }

    public function edit(Counselor $counselor)
    {
        return view('admin.counselors.edit', compact('counselor'));
    }

    public function update(Request $request, Counselor $counselor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:counselors,email,' . $counselor->id,
            'password' => 'nullable|string|min:8|confirmed',
            'specialization' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'qualifications' => 'nullable|string|max:255',
            'consultation_fee' => 'nullable|numeric|min:0',
            'bio' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'languages' => 'nullable|string|max:255',
        ]);

        $counselor->name = $validated['name'];
        $counselor->email = $validated['email'];

        if (!empty($validated['password'])) {
            $counselor->password = Hash::make($validated['password']);
        }

        $counselor->specialization = $validated['specialization'] ?? null;
        $counselor->experience = $validated['experience'] ?? null;
        $counselor->qualifications = $validated['qualifications'] ?? null;
        $counselor->consultation_fee = $validated['consultation_fee'] ?? null;
        $counselor->bio = $validated['bio'] ?? null;
        $counselor->location = $validated['location'] ?? null;
        $counselor->languages = $validated['languages'] ?? null;

        $counselor->save();

        return redirect()->route('admin.counselors.index')->with('success', 'Counselor updated successfully.');
    }

    public function destroy(Counselor $counselor)
    {
        $counselor->delete();

        return redirect()->route('admin.counselors.index')->with('success', 'Counselor deleted successfully.');
    }
}
