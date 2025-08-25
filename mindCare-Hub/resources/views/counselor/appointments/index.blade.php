@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-36 mb-36 px-4">
    <h2 class="text-3xl font-extrabold mb-8 text-gray-800">Manage Appointments</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($appointments as $appointment)
        <div class="bg-white border rounded-lg shadow p-6">
            <div class="mb-3">
                <h3 class="text-lg font-bold text-gray-800 mb-1">Patient Name: {{ $appointment->user->name }}</h3>
                <hr class="h-2">
                <p class="text-sm text-gray-500">Patient Email: {{ $appointment->user->email }}  |  Patient Mobile: {{ $appointment->mobile }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm text-gray-700 mb-4">
                <div><strong>Date:</strong> {{ $appointment->appointment_date }}</div>
                <div><strong>Time:</strong> {{ $appointment->appointment_time }}</div>
                <div><strong>Situation:</strong> {{ $appointment->current_situation }}</div>
                <div><strong>Reason:</strong> {{ $appointment->reason }}</div>
                <div><strong>Status:</strong>
                    <span class="inline-block px-3 py-1 rounded-full text-white text-xs font-semibold
                        {{ $appointment->status == 'confirmed' ? 'bg-green-500' : '' }}
                        {{ $appointment->status == 'cancelled' ? 'bg-red-500' : '' }}
                        {{ $appointment->status == 'completed' ? 'bg-blue-500' : '' }}
                        {{ !in_array($appointment->status, ['confirmed', 'cancelled', 'completed']) ? 'bg-gray-400' : '' }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </div>
                <div><strong>Payment:</strong> {{ $appointment->payment_status }}</div>
            </div>

            <form action="{{ route('counselor.appointments.update', $appointment->id) }}" method="POST">
                @csrf
                <label for="status-{{ $appointment->id }}" class="block mb-1 font-medium text-sm text-gray-700">Update Status:</label>
                <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                    <select name="status" id="status-{{ $appointment->id }}" required class="border p-2 rounded w-full sm:w-auto">
                        <option value="confirmed">Approve</option>
                        <option value="cancelled">Reject</option>
                        <option value="completed">Completed</option>
                    </select>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                        Update
                    </button>
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection
