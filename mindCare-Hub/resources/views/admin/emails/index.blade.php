@extends('admin.dashboard')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Newsletter Subscribers</h1>

    @if(session('success'))
        <div class="p-2 mb-4 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.emails.send') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold mb-1">Select Subscribers</label>
            <div class="mb-2">
                <input type="checkbox" id="selectAll" class="mr-2">
                <label for="selectAll" class="font-semibold">Select All</label>
            </div>
            <select name="recipients[]" multiple id="subscribersSelect" class="w-full border rounded p-2">
                @foreach($subscribers as $subscriber)
                    <option value="{{ $subscriber->id }}">{{ $subscriber->email }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Message</label>
            <textarea name="message" id="messageInput" class="w-full border rounded p-2" rows="5"></textarea>
        </div>
        <hr class="h-1 bg-gray-600 my-6">
        <div class="mb-4">
            <label class="block font-semibold mb-1">Preview</label>
            <div id="messagePreview" class="w-full border rounded p-4 bg-gray-50 text-gray-800"></div>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Send Emails
        </button>
    </form>
</div>

<script>
    // Select All
    const selectAllCheckbox = document.getElementById('selectAll');
    const subscribersSelect = document.getElementById('subscribersSelect');

    selectAllCheckbox.addEventListener('change', function() {
        const options = subscribersSelect.options;
        for (let i = 0; i < options.length; i++) {
            options[i].selected = this.checked;
        }
    });

    // Message preview
    const messageInput = document.getElementById('messageInput');
    const messagePreview = document.getElementById('messagePreview');

    messageInput.addEventListener('input', function() {
        messagePreview.textContent = this.value;
    });
</script>


@endsection
