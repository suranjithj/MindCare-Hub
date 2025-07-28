@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-24 sm:mt-36 mb-8 sm:mb-16 p-4 sm:p-8 bg-white rounded-2xl shadow-lg border border-gray-200">
    <h2 class="text-3xl font-extrabold text-blue-700 mb-8 sm:mb-12 text-center">Available Counselors</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        @forelse ($counselors as $counselor)
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition duration-300">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $counselor->name }}</h3>
                <p class="text-gray-700"><span class="font-medium text-gray-900">Specialization:</span> {{ $counselor->specialization }}</p>
                <p class="text-gray-700"><span class="font-medium text-gray-900">Experience:</span> {{ $counselor->experience }} years</p>
                <p class="text-gray-700"><span class="font-medium text-gray-900">Fee:</span> <span class="text-green-600 font-semibold">Rs. {{ $counselor->consultation_fee }}</span></p>

                @auth
                    <div class="mt-4 flex flex-col sm:flex-row sm:gap-4 gap-2">
                        <a href="{{ route('counselor.view', $counselor->id) }}"
                           class="w-full sm:w-auto text-center text-sm bg-blue-600 hover:bg-blue-700 hover:text-white text-white px-4 py-2 rounded transition">
                            View Profile
                        </a>
                        <a href="{{ route('appointment.create', $counselor->id) }}"
                           class="w-full sm:w-auto text-center text-sm bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 hover:text-white transition">
                            Book Appointment
                        </a>
                    </div>
                @else
                    <p class="text-sm text-red-500 mt-4">Please <a href="{{ route('login') }}" class="underline hover:text-red-700">login</a> to view profile or book an appointment.</p>
                @endauth
            </div>
        @empty
            <p class="text-gray-600 col-span-full">No counselors found.</p>
        @endforelse
    </div>
</div>
@endsection
