@extends('layouts.app')

@section('title', 'Counselor Dashboard')

@section('content')
<div class="min-h-screen mt-20 flex bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md">
        <div class="p-6 bg-green-700 text-white text-xl font-bold">
            MindCare Hub - Counselor
        </div>
        <nav class="p-4">
            <ul class="space-y-3">
                <li>
                    <a href="#profile" class="block px-4 py-2 rounded hover:bg-green-100">Profile</a>
                </li>
                <li>
                    <a href="#availability" class="block px-4 py-2 rounded hover:bg-green-100">Schedule Availability</a>
                </li>
                <li>
                    <a href="#appointments" class="block px-4 py-2 rounded hover:bg-green-100">Manage Appointments</a>
                </li>
                <li>
                    <a href="#clients" class="block px-4 py-2 rounded hover:bg-green-100">View Clients</a>
                </li>
                <li>
                    <a href="#session-notes" class="block px-4 py-2 rounded hover:bg-green-100">Session Notes</a>
                </li>

                {{-- <li>
                    <a href="#packages" class="block px-4 py-2 rounded hover:bg-green-100">Package Details</a>
                </li> --}}
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="block px-4 py-2 text-red-600 hover:bg-red-100 rounded">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <h1 class="text-3xl font-semibold mb-6">Welcome, {{ auth()->user()->name }}</h1>

        <!-- Profile Section -->
        <section id="profile" class="mb-10 bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Profile Details</h2>
            <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <a href="{{ route('counselor.profile.edit') }}"
               class="mt-4 inline-block bg-green-700 hover:bg-green-800 text-white hover:text-white px-4 py-2 rounded">
                Edit Profile
            </a>
        </section>

        <!-- Schedule Availability -->
        <section id="availability" class="mb-10 bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Schedule Availability</h2>
            <p>Set or update your available times for bookings.</p>
            <a href="{{ route('counselor.availability.index') }}"
                class="mt-4 inline-block bg-purple-600 hover:bg-purple-700 text-white hover:text-white px-4 py-2 rounded">
                Manage Availability
            </a>
        </section>

        <!-- Manage Appointments -->
        <section id="appointments" class="mb-10 bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Manage Appointments</h2>
            <p>View and manage your client appointments.</p>
            <a href="{{ route('counselor.appointments.index') }}"
               class="mt-4 inline-block bg-yellow-600 hover:bg-yellow-700 text-white hover:text-white px-4 py-2 rounded">
                View Appointments
            </a>
        </section>

        <!-- View Clients -->
        <section id="clients" class="mb-10 bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Your Clients</h2>
            <p>List of clients assigned to you.</p>
            <a href="{{ route('counselor.clients.index') }}"
               class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white hover:text-white px-4 py-2 rounded">
                View Clients
            </a>
        </section>

        <!-- Session Notes -->
        <section id="session-notes" class="mb-10 bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Session Notes</h2>
            <p>Write and review session notes for your clients.</p>
            <a href="{{ route('counselor.session-notes') }}"
               class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white hover:text-white px-4 py-2 rounded">
                Manage Session Notes
            </a>
        </section>

    </main>
</div>
@endsection
