@extends('layouts.app')

@section('content')
<section id="clients" class="max-w-6xl mx-auto mt-36 mb-20 px-4">
    <h1 class="text-3xl font-extrabold mb-6 text-gray-800 pb-2">Your Clients</h1>
    <p class="text-gray-700 mb-4">List of clients assigned to you with appointment statistics.</p>

    @if($clients->count())
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr class="bg-gray-100 text-left text-sm text-gray-700">
                        <th class="px-6 py-3 text-left text-sm font-medium border text-gray-700">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium border text-gray-700">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-medium border text-gray-700">No of Appointments</th>
                        <th class="px-6 py-3 text-left text-sm font-medium border text-gray-700">Last Appointment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr class="border-t hover:bg-gray-50 text-sm">
                            <td class="px-6 py-4 text-sm border text-gray-800">{{ $client->name }}</td>
                            <td class="px-6 py-4 text-sm border text-gray-800">{{ $client->email }}</td>
                            <td class="px-6 py-4 text-sm border text-gray-800">{{ $client->appointments_count }}</td>
                            <td class="px-6 py-4 text-sm border text-gray-800">
                                {{ optional($client->latestAppointment)->created_at->format('d M Y') ?? 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500">You currently have no assigned clients.</p>
    @endif
</section>
@endsection
