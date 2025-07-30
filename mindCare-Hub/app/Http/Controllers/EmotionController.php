<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmotionController extends Controller
{
    public function predictEmotion(Request $request)
    {
        $text = $request->input('text');

        $response = Http::post('http://127.0.0.1:5000/predict', [
            'text' => $text
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (!isset($data['genre']) || !isset($data['songs'])) {
                return back()->with('error', 'Incomplete data received from ML model.');
            }

            return view('emotion_predict', [
                'text' => $text,
                'emotion' => $data['emotion'] ?? 'Unknown',
                'genre' => $data['genre'] ?? 'Unknown',
                'songs' => $data['songs'] ?? []
            ]);
        }

        return back()->with('error', 'Failed to get prediction from ML model.');
    }
}
