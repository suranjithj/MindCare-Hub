@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow mt-36 mb-16">
    <h2 class="text-2xl font-bold mb-6">Session Notes</h2>

    <a href="{{ route('session-notes.create') }}"
       class="mb-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:text-white hover:bg-green-500">
        + Add New Note
    </a>

    @foreach ($notes as $note)
        <div class="border-t pt-4 mt-4 border-gray-700 mb-16">
            <p><strong>Client:</strong> {{ $note->user->name }}</p>
            <p><strong>Date:</strong> {{ $note->session_date }}</p>
            <p><strong>Note:</strong> {{ $note->note }}</p>
            <div class="mt-2">
                <form action="{{ route('session-notes.destroy', $note->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline ml-4">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
