@extends('admin.dashboard')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-bold mb-6">Manage Users</h1>

    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <table class="w-full table-auto border bg-white border-gray-300">
        <thead class="bg-gray-100">
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Package</th>
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="border-t">
                    <td class="px-4 py-2 border">{{ $user->id }}</td>
                    <td class="px-4 py-2 border">{{ $user->name }}</td>
                    <td class="px-4 py-2 border">{{ $user->email }}</td>
                    <td class="px-4 py-2 border">{{ $user->package->name ?? 'No Package' }}</td>
                    <td class="px-4 py-2 border">
                        {{ $user->is_banned ? 'Banned' : 'Active' }}
                    </td>
                    <td class="px-4 py-2 space-x-2">
                        @if ($user->is_banned)
                            <form action="{{ route('users.unban', $user) }}" method="POST" class="inline">
                                @csrf
                                <button class="bg-green-500 text-white px-2 py-1 rounded">Unban</button>
                            </form>
                        @else
                            <form action="{{ route('users.ban', $user) }}" method="POST" class="inline">
                                @csrf
                                <button class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-400">Ban</button>
                            </form>
                        @endif

                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
