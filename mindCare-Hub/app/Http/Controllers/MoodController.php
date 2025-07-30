<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Mood;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    public function index()
    {
        $moods = Mood::where('user_id', Auth::id())->latest()->get();
        return view('user.mood.index', compact('moods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        try {
            // Send text to Flask API
            $response = Http::post('http://127.0.0.1:5000/predict', [
                'text' => $request->description,
            ]);

            if ($response->successful()) {
                $mood = $response->json()['emotion'] ?? 'unknown';
            } else {
                $mood = 'unknown';
            }
        } catch (\Exception $e) {
            $mood = 'unknown';
        }

        Mood::create([
            'user_id' => Auth::id(),
            'mood' => $mood,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Mood analyzed and saved successfully!');
    }
}
