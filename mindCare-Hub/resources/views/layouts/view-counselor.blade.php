@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-16 mb-16 bg-white p-8 rounded-2xl shadow-lg border border-gray-200 transition duration-300 hover:shadow-2xl ">
    <h2 class="text-4xl font-extrabold text-blue-600 mb-6 border-b pb-2">{{ $counselor->name }}</h2>

    <div class="space-y-4 text-gray-700 text-lg">
        <p><span class="font-semibold text-gray-900">Specialization:</span> {{ $counselor->specialization }}</p>
        <p><span class="font-semibold text-gray-900">Experience:</span> {{ $counselor->experience }} years</p>
        <p><span class="font-semibold text-gray-900">Qualifications:</span> {{ $counselor->qualifications }}</p>
        <p><span class="font-semibold text-gray-900">Fee:</span> <span class="text-green-600 font-bold">Rs. {{ $counselor->consultation_fee }}</span></p>
        <p><span class="font-semibold text-gray-900">Languages:</span> {{ $counselor->languages }}</p>
        <div>
            <p class="font-semibold text-gray-900">Bio:</p>
            <p class="mt-1 text-justify leading-relaxed">{{ $counselor->bio }}</p>
        </div>
    </div>

    <div class="mt-6 text-right">
        <a href="{{ route('appointments.create', $counselor->id) }}"
           class="inline-block bg-blue-600 text-white hover:bg-blue-700 hover:text-white px-6 py-3 rounded-xl transition">
            Book Appointment
        </a>
    </div>
</div>
@endsection
