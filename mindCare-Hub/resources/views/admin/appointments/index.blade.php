@extends('admin.dashboard')

@section('title', 'All Appointments')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-bold mb-6">All Appointments</h1>

    @if ($appointments->count())
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">User Name</th>
                        <th class="px-4 py-2 border">User Email</th>
                        <th class="px-4 py-2 border">Mobile No</th>
                        <th class="px-4 py-2 border">Counselor Name</th>
                        <th class="px-4 py-2 border">Date</th>
                        <th class="px-4 py-2 border">Time</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Reason</th>
                        <th class="px-4 py-2 border">Payment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td class="px-4 py-2 border">{{ $appointment->id }}</td>
                            <td class="px-4 py-2 border">{{ $appointment->user_name }}</td>
                            <td class="px-4 py-2 border">{{ $appointment->user_email }}</td>
                            <td class="px-4 py-2 border">{{ $appointment->mobile }}</td>
                            <td class="px-4 py-2 border">{{ $appointment->counselor->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $appointment->appointment_date->format('Y-m-d') }}</td>
                            <td class="px-4 py-2 border">{{ $appointment->appointment_time }}</td>
                            <td class="px-4 py-2 border capitalize">{{ $appointment->status }}</td>
                            <td class="px-4 py-2 border">{{ Str::limit($appointment->reason, 30) }}</td>
                            <td class="px-4 py-2 border">{{ $appointment->payment_status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $appointments->links() }}
        </div>
    @else
        <p class="text-gray-600">No appointments found.</p>
    @endif
</div>
@endsection
