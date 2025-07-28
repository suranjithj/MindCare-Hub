@extends('admin.dashboard')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-2">{{ $blog->title }}</h2>

    @if ($blog->image)
        <img src="{{ asset('storage/' . $blog->image) }}" class="w-full max-h-96 object-cover mb-4 rounded">
    @endif

    <p class="text-gray-700 leading-relaxed">{{ $blog->content }}</p>
</div>
@endsection
