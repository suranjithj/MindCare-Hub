@extends('layouts.app')

@section('title', 'Mood Tracker')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-md rounded mb-16">
    <h2 class="text-2xl font-semibold mb-4">Mood Tracker</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('user.mood.store') }}" method="POST" class="mb-6">
        @csrf
        <div class="mb-4">
            <label class="block font-medium mb-1">How do you feel?</label>
            <textarea name="description" required
                      class="w-full px-4 py-2 border rounded focus:outline-none focus:ring"></textarea>
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Analyze & Save Mood
        </button>
    </form>

    <h3 class="text-xl font-semibold mb-2">Mood History</h3>
    <ul class="space-y-3">
        @forelse($moods as $mood)
            <li class="border rounded p-4 bg-gray-50">
                <strong>{{ ucfirst($mood->mood) }}</strong>
                <span class="text-gray-600 text-sm">({{ $mood->created_at->format('d M Y, h:i A') }})</span><br>
                @if($mood->description)
                    <span class="text-gray-700">{{ $mood->description }}</span>
                @endif
            </li>
        @empty
            <p class="text-gray-600">No moods recorded yet.</p>
        @endforelse
    </ul>
</div>
@endsection
