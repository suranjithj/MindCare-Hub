@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow mt-36 mb-16">
    <h2 class="text-xl font-bold mb-4">{{ isset($note) ? 'Edit' : 'New' }} Session Note</h2>

    <form action="{{ isset($note) ? route('session-notes.update', $note->id) : route('session-notes.store') }}" method="POST">
        @csrf
        @if(isset($note))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label for="user_id" class="block font-medium">Client</label>
            <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ (isset($note) && $note->user_id == $user->id) ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="session_date" class="block font-medium">Session Date</label>
            <input type="date" name="session_date" id="session_date"
                   value="{{ old('session_date', $note->session_date ?? '') }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="note" class="block font-medium">Note</label>
            <textarea name="note" id="note" rows="5"
                      class="w-full border rounded px-3 py-2">{{ old('note', $note->note ?? '') }}</textarea>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            {{ isset($note) ? 'Update' : 'Save' }}
        </button>
    </form>
</div>
@endsection
