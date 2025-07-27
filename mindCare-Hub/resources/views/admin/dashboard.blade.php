<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard - MindCare Admin</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow flex flex-col">
        <div class="p-6 border-b">
            <h1 class="text-2xl font-bold text-gray-800">MindCare Admin</h1>
        </div>
        <nav class="flex-grow px-4 py-6 space-y-4">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-blue-100 hover:text-blue-700 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700' }}">
                Dashboard
            </a>
            <a href="{{ route('users.index') }}" class="block px-4 py-2 rounded hover:bg-blue-100 hover:text-blue-700 {{ request()->routeIs('users.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700' }}">
                Users
            </a>
            <a href="{{ route('counselors.index') }}" class="block px-4 py-2 rounded hover:bg-blue-100 hover:text-blue-700 {{ request()->routeIs('counselors.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700' }}">
                Counselors
            </a>
            <a href="{{ route('admin.appointments.index') }}" class="block px-4 py-2 rounded hover:bg-blue-100 hover:text-blue-700 {{ request()->routeIs('admin.appointments.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700' }}">
                Appointments
            </a>
            <a href="{{ route('admin.blogs.index') }}" class="block px-4 py-2 rounded hover:bg-blue-100 hover:text-blue-700 {{ request()->routeIs('admin.blogs.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700' }}">
                Blogs
            </a>

            <form method="POST" action="{{ route('admin.logout') }}" class="mt-auto px-4">
                @csrf
                <button type="submit" class="w-full text-left text-red-600 hover:text-red-800 font-semibold">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main content area -->
    <main class="flex-grow p-6 overflow-auto">
        {{-- Dashboard view --}}
        @if(request()->routeIs('admin.dashboard'))
            <div class="p-6 bg-white rounded shadow">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Statistics</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Total Users -->
                    <div class="p-6 bg-blue-100 rounded-lg shadow hover:shadow-lg transition">
                        <h2 class="text-xl font-semibold text-blue-800 mb-2">Users</h2>
                        <p class="text-4xl font-bold text-blue-900">{{ $userCount }}</p>
                    </div>

                    <!-- Total Counselors -->
                    <div class="p-6 bg-green-100 rounded-lg shadow hover:shadow-lg transition">
                        <h2 class="text-xl font-semibold text-green-800 mb-2">Counselors</h2>
                        <p class="text-4xl font-bold text-green-900">{{ $counselorCount }}</p>
                    </div>

                    <!-- Total Appointments -->
                    <div class="p-6 bg-yellow-100 rounded-lg shadow hover:shadow-lg transition">
                        <h2 class="text-xl font-semibold text-yellow-800 mb-2">Appointments</h2>
                        <p class="text-4xl font-bold text-yellow-900">{{ $appointmentCount }}</p>
                    </div>

                    <!-- Total Blogs -->
                    <div class="p-6 bg-purple-100 rounded-lg shadow hover:shadow-lg transition">
                        <h2 class="text-xl font-semibold text-purple-800 mb-2">Blogs</h2>
                        <p class="text-4xl font-bold text-purple-900">{{ $blogCount }}</p>
                    </div>
                </div>
            </div>

            {{-- Chart Section --}}
            <div class="mt-10 bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Appointments Overview</h2>
                <canvas id="appointmentsChart" class="w-full h-64"></canvas>
            </div>

            <div class="mt-10 bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Sales Overview</h2>
                <canvas id="salesChart" height="100"></canvas>
            </div>
        @else
            @yield('content')
        @endif
    </main>

    <script>
        const ctx = document.getElementById('appointmentsChart').getContext('2d');

        // Setup chart with empty initial data
        const appointmentsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Appointments',
                    data: [],
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                            return Number.isInteger(value) ? value : '';
                            }
                        }
                    }
                }
            }
        });

        // Fetch updated dashboard data
        async function fetchDashboardData() {
            try {
                const response = await fetch('{{ route('admin.dashboard-data') }}');
                if (!response.ok) throw new Error('Network response was not ok');

                const data = await response.json();

                // Update chart
                appointmentsChart.data.labels = data.labels;
                appointmentsChart.data.datasets[0].data = data.appointments;
                appointmentsChart.update();

                document.getElementById('userCount').textContent = data.userCount;
                document.getElementById('counselorCount').textContent = data.counselorCount;
                document.getElementById('appointmentCount').textContent = data.appointmentCount;
                document.getElementById('blogCount').textContent = data.blogCount;
            } catch (error) {
                console.error('Error fetching dashboard data:', error);
            }
        }

        fetchDashboardData();

        setInterval(fetchDashboardData, 15000);
    </script>

    <script>
        fetch('/admin/dashboard/sales-data')
            .then(res => res.json())
            .then(data => {
                const ctx = document.getElementById('salesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Monthly Sales (Rs)',
                            data: data.sales,
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Revenue (Rs)'
                                }
                            }
                        }
                    }
                });
            });
    </script>

</body>
</html>
