@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow mb-16 mt-36">
    <h1 class="text-4xl font-extrabold mb-6 leading-tight text-gray-900" id="blog-title">{{ $blog->title }}</h1>

    @if($blog->image)
        <figure class="mb-8">
            <img
                src="{{ asset('storage/' . $blog->image) }}"
                alt="Image for {{ $blog->title }}"
                class="w-full h-64 object-cover rounded"
                loading="lazy"
            >
        </figure>
    @endif

    <article class="prose max-w-none text-gray-800 leading-relaxed" aria-labelledby="blog-title">
        {!! nl2br(e($blog->content)) !!}
    </article>

    <p class="text-sm text-gray-500 mt-8">
        Posted on <time datetime="{{ $blog->created_at->toDateString() }}">{{ $blog->created_at->format('F j, Y') }}</time>
    </p>
</div>
@endsection
