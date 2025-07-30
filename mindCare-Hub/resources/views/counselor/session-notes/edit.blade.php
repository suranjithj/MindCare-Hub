@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow mt-8">
    <h2 class="text-xl font-bold mb-4">Edit Session Note</h2>

    <form action="{{ route('session-notes.update', $note->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="user_id" class="block font-medium">Client</label>
            <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $note->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="session_date" class="block font-medium">Session Date</label>
            <input type="date" name="session_date" id="session_date"
                   value="{{ old('session_date', $note->session_date) }}"
                   class="w-full border rounded px-3 py-2">
            @error('session_date')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="note" class="block font-medium">Note</label>
            <textarea name="note" id="note" rows="5"
                      class="w-full border rounded px-3 py-2">{{ old('note', $note->note) }}</textarea>
            @error('note')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                Update Note
            </button>
            <a href="{{ route('counselor.session-notes') }}" class="text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
