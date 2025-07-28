@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 mt-24 mb-16">
    <h2 class="text-3xl font-bold mb-8">Our Blog</h2>

    @if($blogs->isEmpty())
        <p class="text-center text-gray-500">No blog posts available at the moment. Please check back later.</p>
    @else
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($blogs as $blog)
                <article
                    class="bg-white rounded shadow hover:shadow-lg transition-shadow duration-300 p-5 flex flex-col"
                    aria-labelledby="blog-title-{{ $blog->id }}"
                >
                    @if($blog->image)
                        <img
                            src="{{ asset('storage/' . $blog->image) }}"
                            alt="Image for {{ $blog->title }}"
                            class="mb-4 w-full h-48 object-cover rounded"
                            loading="lazy"
                        >
                    @endif

                    <h3 id="blog-title-{{ $blog->id }}" class="text-xl font-semibold mb-2">
                        {{ $blog->title }}
                    </h3>

                    <p class="text-gray-700 flex-grow text-justify leading-relaxed">
                        {!! nl2br(e(Str::limit($blog->content, 140))) !!}
                    </p>

                    <p class="text-sm text-gray-400 mt-3">
                        Posted on <time datetime="{{ $blog->created_at->toDateString() }}">{{ $blog->created_at->format('F j, Y') }}</time>
                    </p>

                    <div class="mt-4 text-right">
                        <a
                            href="{{ route('blogs.show', $blog) }}"
                            class="inline-block bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
                            aria-label="Read full article: {{ $blog->title }}"
                        >
                            Read Full Article
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</div>
@endsection
