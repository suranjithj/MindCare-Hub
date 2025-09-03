@extends('admin.dashboard')

@section('content')
<div class="container mx-auto py-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-6">Manage Blogs</h2>
        <a href="{{ route('admin.blogs.create') }}" class="px-4 py-2 text-white bg-blue-700 rounded hover:text-white hover:bg-blue-600">+ New Blog</a>
    </div>

    @if (session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach ($blogs as $blog)
            <div class="bg-white shadow rounded p-4">
                @if ($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" class="h-40 w-full object-cover rounded mb-2" alt="Blog Image">
                @endif
                <h3 class="text-lg font-bold mb-2">{{ $blog->title }}</h3>
                <p class="text-sm text-gray-600 mb-3">{{ Str::limit($blog->content, 100) }}</p>

                <div class="flex justify-between">
                    <a href="{{ route('admin.blogs.show', $blog) }}" class="text-white bg-blue-700 px-2 py-1 rounded hover:text-white hover:bg-blue-600">View</a>
                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="text-white bg-yellow-500 px-2 py-1 rounded hover:text-white hover:bg-yellow-400">Edit</a>
                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('Delete this blog?');">
                        @csrf @method('DELETE')
                        <button class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-500">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
