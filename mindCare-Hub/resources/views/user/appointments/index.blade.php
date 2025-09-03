@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-36 mb-20 px-4">
    <h2 class="text-3xl font-extrabold mb-6 text-gray-800 pb-2">Manage Appointments</h2>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium border text-gray-700">Counselor Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium border text-gray-700">Date</th>
                    <th class="px-6 py-3 text-left text-sm font-medium border text-gray-700">Time</th>
                    <th class="px-6 py-3 text-left text-sm font-medium border text-gray-700">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium border text-gray-700">Payments</th>
                    <th class="px-6 py-3 text-left text-sm font-medium border text-gray-700">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($appointments as $appointment)
                <tr>
                    <td class="px-6 py-4 text-sm border text-gray-800">{{ optional($appointment->counselor)->name ?? 'Counselor Removed' }}</td>
                    <td class="px-6 py-4 text-sm border text-gray-800">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-sm border text-gray-800">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                    <td class="px-6 py-4 text-sm border">
                        <span class="inline-block px-3 py-1 rounded-full text-white text-xs font-semibold
                            {{ $appointment->status == 'confirmed' ? 'bg-green-600' : '' }}
                            {{ $appointment->status == 'cancelled' ? 'bg-red-600' : '' }}
                            {{ $appointment->status == 'completed' ? 'bg-blue-600' : '' }}
                            {{ !in_array($appointment->status, ['confirmed','cancelled','completed']) ? 'bg-gray-400' : '' }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-sm border text-gray-800">
                        @if($appointment->payment_status === 'pending')
                        <div class="flex flex-col space-y-2">
                            <span>{{ $appointment->payment_status }}</span>
                            <a href="{{ route('payments.page', $appointment->id) }}" class="px-4 py-2 w-3/4 bg-blue-600 hover:bg-blue-700 text-white hover:text-white rounded">Pay Now</a>

                        </div>
                        @else
                            {{ ucfirst($appointment->payment_status) }}
                        @endif
                    </td>

                    <td class="px-6 py-4 text-sm border">
                        @if(in_array($appointment->status, ['pending', 'confirmed']))
                        <form action="{{ route('appointments.userCancel', $appointment->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                            @csrf
                            <button type="submit"
                                    class="bg-red-700 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded shadow">
                                Cancel
                            </button>
                        </form>
                        @else
                            <span class="text-gray-500 italic">No actions</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
