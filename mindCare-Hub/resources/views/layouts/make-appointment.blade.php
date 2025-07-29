@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md mb-16 mt-16">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Make Appointment with {{ $counselor->name }}</h2>

    {{-- Display Success Message --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded-md shadow-sm" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Display Error Message --}}
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-300 rounded-md shadow-sm" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Display Validation Errors --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-300 rounded-md shadow-sm" role="alert">
            <strong class="font-bold">Oops! Something went wrong with your input.</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.store', $counselor->id) }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 bg-gray-100 cursor-not-allowed" value="{{ auth()->user()->name ?? '' }}" readonly>
                <p class="mt-1 text-xs text-gray-500">Your name (You Can't Change this!).</p>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 bg-gray-100 cursor-not-allowed" value="{{ auth()->user()->email ?? '' }}" readonly>
                <p class="mt-1 text-xs text-gray-500">Your email (You Can't Change this!).</p>
            </div>
        </div>

        <div class="mb-6">
            <label for="mobile_no" class="block text-sm font-medium text-gray-700 mb-1">Mobile Number <span class="text-red-500">*</span></label>
            <input type="tel" name="mobile_no" id="mobile_no" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 @error('mobile_no') border-red-500 @enderror" value="{{ old('mobile_no') }}" placeholder="e.g., 07XXXXXXXX" required>
            @error('mobile_no')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Preferred Date <span class="text-red-500">*</span></label>
                <input type="date" name="appointment_date" id="date" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 @error('appointment_date') border-red-500 @enderror" value="{{ old('appointment_date') }}" min="{{ now()->toDateString() }}" required>
                @error('appointment_date')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="time" class="block text-sm font-medium text-gray-700 mb-1">Preferred Time <span class="text-red-500">*</span></label>
                <input type="time" name="appointment_time" id="time" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 @error('appointment_time') border-red-500 @enderror" value="{{ old('appointment_time') }}" required>
                @error('appointment_time')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="current_situation" class="block text-sm font-medium text-gray-700 mb-1">Current Situation / Mood</label>
            <textarea name="current_situation" id="current_situation" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 @error('current_situation') border-red-500 @enderror" placeholder="Briefly describe how you are feeling or your current situation (optional)">{{ old('current_situation') }}</textarea>
            @error('current_situation')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-8">
            <label for="reason" class="block text-sm font-medium text-gray-700 mb-1">Reason for Appointment</label>
            <textarea name="reason" id="reason" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 @error('reason') border-red-500 @enderror" placeholder="What would you like to discuss? (optional)">{{ old('reason') }}</textarea>
            @error('reason')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end">
            <button type="submit" class="bg-blue-600 text-white hover:bg-blue-700 hover:text-white font-semibold px-6 py-2.5 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                Confirm Appointment
            </button>
        </div>
    </form>
</div>

<script>
    // Set min date for date input to today
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        var dateInput = document.getElementById('date');
        if (dateInput) {
            dateInput.setAttribute('min', today);
        }
    });
</script>
@endsection
