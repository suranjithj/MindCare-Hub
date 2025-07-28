@php
    $editing = isset($counselor);
@endphp

<div>
    <label class="block px-5">Name</label>
    <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name', $counselor->name ?? '') }}" required>
</div>

<div>
    <label class="block px-5">Email</label>
    <input type="email" name="email" class="w-full border px-3 py-2 rounded" value="{{ old('email', $counselor->email ?? '') }}" required>
</div>

<div>
    <label class="block px-5">Password @if($editing)<span class="text-sm text-gray-500">(Leave blank to keep current)</span>@endif</label>
    <input type="password" name="password" class="w-full border px-3 py-2 rounded">
</div>

<div>
    <label class="block px-5">Confirm Password</label>
    <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded">
</div>

<div>
    <label class="block px-5">Specialization</label>
    <input type="text" name="specialization" class="w-full border px-3 py-2 rounded" value="{{ old('specialization', $counselor->specialization ?? '') }}">
</div>

<div>
    <label class="block px-5">Experience (years)</label>
    <input type="number" name="experience" class="w-full border px-3 py-2 rounded" value="{{ old('experience', $counselor->experience ?? '') }}">
</div>

<div>
    <label class="block px-5">Qualifications</label>
    <input type="text" name="qualifications" class="w-full border px-3 py-2 rounded" value="{{ old('qualifications', $counselor->qualifications ?? '') }}">
</div>

<div>
    <label class="block px-5">Consultation Fee</label>
    <input type="number" name="consultation_fee" class="w-full border px-3 py-2 rounded" step="0.01" value="{{ old('consultation_fee', $counselor->consultation_fee ?? '') }}">
</div>

<div>
    <label class="block px-5">Bio</label>
    <textarea name="bio" class="w-full border px-3 py-2 rounded">{{ old('bio', $counselor->bio ?? '') }}</textarea>
</div>

<div>
    <label class="block px-5">Location</label>
    <input type="text" name="location" class="w-full border px-3 py-2 rounded" value="{{ old('location', $counselor->location ?? '') }}">
</div>

<div>
    <label class="block px-5">Languages</label>
    <input type="text" name="languages" class="w-full border px-3 py-2 rounded" value="{{ old('languages', $counselor->languages ?? '') }}">
</div>

<div>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        {{ $submit }}
    </button>
</div>
