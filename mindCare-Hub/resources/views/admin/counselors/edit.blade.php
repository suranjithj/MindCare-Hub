@extends('admin.dashboard')

@section('content')
<div class="max-w-2xl mx-auto py-10">
    <h2 class="text-xl font-bold mb-6">Edit Counselor</h2>

    <form action="{{ route('admin.counselors.update', $counselor->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        @include('admin.counselors.form', ['submit' => 'Update'])
    </form>
</div>
@endsection
