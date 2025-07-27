@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="min-h-screen flex bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md">
        <div class="p-6 bg-blue-600 text-white text-xl font-bold">
            MindCare Hub
        </div>
        <nav class="p-4">
            <ul class="space-y-3">
                <li>
                    <a href="#profile" class="block px-4 py-2 rounded hover:bg-blue-100">Profile</a>
                </li>
                <li>
                    <a href="#mood-tracker" class="block px-4 py-2 rounded hover:bg-blue-100">Mood Tracker</a>
                </li>
                <li>
                    <a href="#appointments" class="block px-4 py-2 rounded hover:bg-blue-100">Manage Appointments</a>
                </li>
                <li>
                    <a href="#packages" class="block px-4 py-2 rounded hover:bg-blue-100">Package Details</a>
                </li>
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
            <a href="{{ route('user.profile.edit') }}"
               class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white hover:text-white px-4 py-2 rounded">
                Edit Profile
            </a>
        </section>

        <!-- Mood Tracker -->
        <section id="mood-tracker" class="mb-10 bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Mood Tracker and Mood History</h2>
            <p>Record your current mood or view today's mood summary.</p>
            <a href="{{ route('user.mood.index') }}"
               class="mt-4 inline-block bg-green-600 hover:bg-green-700 text-white hover:text-white px-4 py-2 rounded">
                Track Mood
            </a>
        </section>

        <!-- Appointments -->
        <section id="appointments" class="mb-10 bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Manage Appointments</h2>
            <p>View, book, or cancel appointments with counselors.</p>
            <a href="{{ route('user.appointments.index') }}"
               class="mt-4 inline-block bg-yellow-600 hover:bg-yellow-700 text-white hover:text-white px-4 py-2 rounded">
                Manage Appointments
            </a>
        </section>

        <!-- Package Details -->
        <section id="packages" class="mb-10 bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Your Package</h2>
            <p>You are currently subscribed to the <strong>{{ auth()->user()->package ?? 'Free' }}</strong> package.</p>
            <a href="{{ route('user.packages') }}"
               class="mt-4 inline-block bg-purple-600 hover:bg-purple-700 text-white hover:text-white px-4 py-2 rounded">
                View/Upgrade Packages
            </a>
        </section>
    </main>
</div>
@endsection
