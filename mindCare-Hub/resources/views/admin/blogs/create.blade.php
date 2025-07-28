@extends('admin.dashboard')

@section('content')
<div class="p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Create New Blog</h2>

    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label class="block mb-2">Title</label>
        <input name="title" class="w-full border p-2 mb-4" value="{{ old('title') }}" required>

        <label class="block mb-2">Content</label>
        <textarea name="content" rows="6" class="w-full border p-2 mb-4" required>{{ old('content') }}</textarea>

        <label class="block mb-2">Image (optional)</label>
        <input type="file" name="image" class="mb-4">

        <button class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600">Create Blog</button>
    </form>
</div>
@endsection
