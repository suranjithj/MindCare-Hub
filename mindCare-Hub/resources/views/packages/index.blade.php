@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-36 mb-16">
    <h1 class="text-3xl font-bold mb-6 text-center">Choose Your Package</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($packages as $package)
        <div class="bg-white rounded-xl shadow-md p-6 text-center border hover:shadow-xl transition">
            <h2 class="text-xl font-bold text-indigo-700 mb-2">{{ $package->name }}</h2>
            <p class="text-gray-600 mb-4">{{ $package->description }}</p>
            <p class="text-2xl font-semibold mb-4">
                @if($package->price == 0)
                    Free
                @else
                    {{ number_format($package->price, 2) }} LKR/ Mo
                @endif
            </p>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                {{ $package->price == 0 ? 'Your Current Plan' : 'Upgrade' }}
            </button>
        </div>
        @endforeach
    </div>
</div>
@endsection
