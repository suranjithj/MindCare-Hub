<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CounselorAvailabilityController extends Controller
{
    public function index()
    {
        $counselor = auth()->user();

        $availability = $counselor->availability ?? [];
        $availability = json_decode($counselor->availability, true);

        return view('counselor.availability.index', compact('availability'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'availability' => 'required|array',
            'availability.*.day' => 'required|string',
            'availability.*.start_time' => 'required|date_format:H:i',
            'availability.*.end_time' => 'required|date_format:H:i|after:availability.*.start_time',
        ]);

        $counselor = Auth::user();

        $counselor->availability = json_encode($validated['availability']);
        $counselor->save();

        return redirect()->route('counselor.availability')->with('success', 'Availability updated successfully.');
    }
}
