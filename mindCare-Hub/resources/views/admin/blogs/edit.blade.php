@extends('admin.dashboard')

@section('content')
<div class="p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Edit Blog</h2>

    <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label class="block mb-2">Title</label>
        <input name="title" class="w-full border p-2 mb-4" value="{{ $blog->title }}" required>

        <label class="block mb-2">Content</label>
        <textarea name="content" rows="6" class="w-full border p-2 mb-4" required>{{ $blog->content }}</textarea>

        @if ($blog->image)
            <img src="{{ asset('storage/' . $blog->image) }}" class="h-40 mb-4">
        @endif

        <label class="block mb-2">Change Image</label>
        <input type="file" name="image" class="mb-4">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update Blog</button>
    </form>
</div>
@endsection
