@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow mt-36 mb-16">

    <h2 class="text-2xl font-semibold mb-6">Edit Profile</h2>

    @if(session('status') === 'profile-updated')
        <div class="mb-4 text-green-600">Profile updated successfully.</div>
    @endif

    <form method="POST" action="{{ route('counselor.profile.update') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block font-medium mb-1">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $counselor->name) }}" required
                   class="w-full border px-3 py-2 rounded">
            @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block font-medium mb-1">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $counselor->email) }}" required
                   class="w-full border px-3 py-2 rounded">
            @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Specialization -->
        <div class="mb-4">
            <label for="specialization" class="block font-medium mb-1">Specialization</label>
            <input id="specialization" name="specialization" type="text" value="{{ old('specialization', $counselor->specialization) }}"
                   class="w-full border px-3 py-2 rounded">
            @error('specialization')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Experience -->
        <div class="mb-4">
            <label for="experience" class="block font-medium mb-1">Experience (years)</label>
            <input id="experience" name="experience" type="number" min="0" value="{{ old('experience', $counselor->experience) }}"
                   class="w-full border px-3 py-2 rounded">
            @error('experience')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Qualifications -->
        <div class="mb-4">
            <label for="qualifications" class="block font-medium mb-1">Qualifications</label>
            <input id="qualifications" name="qualifications" type="text" value="{{ old('qualifications', $counselor->qualifications) }}"
                   class="w-full border px-3 py-2 rounded">
            @error('qualifications')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Consultation Fee -->
        <div class="mb-4">
            <label for="consultation_fee" class="block font-medium mb-1">Consultation Fee</label>
            <input id="consultation_fee" name="consultation_fee" type="number" step="0.01" min="0"
                   value="{{ old('consultation_fee', $counselor->consultation_fee) }}" class="w-full border px-3 py-2 rounded">
            @error('consultation_fee')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Bio -->
        <div class="mb-4">
            <label for="bio" class="block font-medium mb-1">Bio</label>
            <textarea id="bio" name="bio" rows="3" class="w-full border px-3 py-2 rounded">{{ old('bio', $counselor->bio) }}</textarea>
            @error('bio')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Location -->
        <div class="mb-4">
            <label for="location" class="block font-medium mb-1">Location</label>
            <input id="location" name="location" type="text" value="{{ old('location', $counselor->location) }}"
                   class="w-full border px-3 py-2 rounded">
            @error('location')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Languages -->
        <div class="mb-4">
            <label for="languages" class="block font-medium mb-1">Languages</label>
            <input id="languages" name="languages" type="text" value="{{ old('languages', $counselor->languages) }}"
                   class="w-full border px-3 py-2 rounded">
            @error('languages')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Password -->
        <div class="mb-6">
            <label for="password" class="block font-medium mb-1">New Password (leave blank if unchanged)</label>
            <input id="password" name="password" type="password" class="w-full border px-3 py-2 rounded">
            @error('password')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block font-medium mb-1">Confirm New Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="w-full border px-3 py-2 rounded">
        </div>

        <button type="submit" class="bg-green-700 hover:bg-green-600 text-white px-6 py-2 rounded">
            Update Profile
        </button>
    </form>

    <hr class="mt-8 mb-4">

    <!-- Delete Account -->
    <form method="POST" action="{{ route('counselor.profile.destroy') }}">
        @csrf

        <h3 class="text-xl font-semibold mb-4 text-red-700">Delete Account</h3>
        <p class="mb-4 text-sm text-gray-700">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you want to delete your account.</p>

        <label for="password_delete" class="block font-medium mb-1">Password</label>
        <input id="password_delete" name="password" type="password" required
               class="w-full border px-3 py-2 rounded mb-2">

        @error('password')
            <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
        @enderror

        <button type="submit" class="bg-red-600 hover:bg-red-500 text-white px-6 py-2 rounded">
            Delete Account
        </button>
    </form>

</div>
@endsection
