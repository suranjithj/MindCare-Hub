@extends('admin.dashboard')

@section('content')
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-bold mb-6">Manage Counselors</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.counselors.create') }}" class="px-4 py-2 text-white bg-blue-700 rounded hover:text-white hover:bg-blue-600 mb-4 inline-block">+ Add Counselor</a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 shadow-md rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 border">Name</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Specialization</th>
                    <th class="py-2 px-4 border">Location</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($counselors as $counselor)
                <tr>
                    <td class="py-2 px-4 border">{{ $counselor->name }}</td>
                    <td class="py-2 px-4 border">{{ $counselor->email }}</td>
                    <td class="py-2 px-4 border">{{ $counselor->specialization }}</td>
                    <td class="py-2 px-4 border">{{ $counselor->location }}</td>
                    <td class="py-2 px-4 border">
                        <a href="{{ route('admin.counselors.edit', $counselor->id) }}" class="text-white bg-blue-700 px-2 py-1 rounded hover:text-white hover:bg-blue-600">Edit</a>
                        <form action="{{ route('admin.counselors.destroy', $counselor->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Delete this counselor?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $counselors->links() }}
    </div>
</div>
@endsection
