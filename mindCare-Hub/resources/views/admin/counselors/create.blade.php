@extends('admin.dashboard')

@section('content')
<div class="max-w-2xl mx-auto py-10">
    <h2 class="text-xl font-bold mb-6">Add New Counselor</h2>

    <form action="{{ route('admin.counselors.store') }}" method="POST" class="space-y-4">
        @csrf
        @include('admin.counselors.form', ['submit' => 'Create'])
    </form>
</div>
@endsection
