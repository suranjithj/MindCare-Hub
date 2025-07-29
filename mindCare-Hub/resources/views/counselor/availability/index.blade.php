@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow mt-16 mb-16">
    <h1 class="text-2xl font-bold mb-6">Manage Availability</h1>

    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    @if(!empty($availability))
        <div class="mt-10 border-t pt-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Your Current Availability</h2>

            <div class="overflow-x-auto mb-8">
                <table class="w-full text-left border border-gray-300 rounded shadow-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 border">Day</th>
                            <th class="px-4 py-2 border">Start Time</th>
                            <th class="px-4 py-2 border">End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($availability as $slot)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $slot['day'] }}</td>
                                <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($slot['start_time'])->format('h:i A') }}</td>
                                <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($slot['end_time'])->format('h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif


    <form action="{{ route('counselor.availability.store') }}" method="POST">
        @csrf

        <div id="availability-container">
            @php
                $oldAvailability = old('availability', $availability ?? []);

                if (!is_array($oldAvailability)) {
                    $oldAvailability = [];
                }
            @endphp

            @foreach($oldAvailability as $index => $slot)
                <div class="mb-4 flex space-x-4 items-end">
                    <div>
                        <label for="availability[{{ $index }}][day]" class="block text-sm font-medium text-gray-700 mb-2">Day</label>
                        <select name="availability[{{ $index }}][day]" class="border rounded px-2 py-1 w-32">
                            @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                                <option value="{{ $day }}" @if($slot['day'] == $day) selected @endif>{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="availability[{{ $index }}][start_time]" class="block text-sm font-medium text-gray-700 mb-2">Start Time</label>
                        <input type="time" name="availability[{{ $index }}][start_time]" value="{{ $slot['start_time'] }}" class="border rounded px-2 py-1" required>
                    </div>
                    <div>
                        <label for="availability[{{ $index }}][end_time]" class="block text-sm font-medium text-gray-700 mb-2">End Time</label>
                        <input type="time" name="availability[{{ $index }}][end_time]" value="{{ $slot['end_time'] }}" class="border rounded px-2 py-1" required>
                    </div>
                    <button type="button" class="remove-slot bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                </div>
            @endforeach

            @if(empty($oldAvailability))
                <div class="mb-4 flex space-x-4 items-end">
                    <div>
                        <label for="availability[0][day]" class="block text-sm font-medium text-gray-700">Day</label>
                        <select name="availability[0][day]" class="border rounded px-2 py-1">
                            @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="availability[0][start_time]" class="block text-sm font-medium text-gray-700">Start Time</label>
                        <input type="time" name="availability[0][start_time]" class="border rounded px-2 py-1" required>
                    </div>
                    <div>
                        <label for="availability[0][end_time]" class="block text-sm font-medium text-gray-700">End Time</label>
                        <input type="time" name="availability[0][end_time]" class="border rounded px-2 py-1" required>
                    </div>
                    <button type="button" class="remove-slot bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                </div>
            @endif
        </div>

        <button type="button" id="add-slot" class="mb-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Time Slot</button>

        <br>

        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Save Availability</button>
    </form>
</div>

<script>
    document.getElementById('add-slot').addEventListener('click', function () {
        const container = document.getElementById('availability-container');
        const index = container.children.length;
        const days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

        const slotDiv = document.createElement('div');
        slotDiv.classList.add('mb-4', 'flex', 'space-x-4', 'items-end');
        slotDiv.innerHTML = `
            <div>
                <label class="block text-sm font-medium text-gray-700">Day</label>
                <select name="availability[${index}][day]" class="border rounded px-2 py-1">
                    ${days.map(day => `<option value="${day}">${day}</option>`).join('')}
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Start Time</label>
                <input type="time" name="availability[${index}][start_time]" class="border rounded px-2 py-1" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">End Time</label>
                <input type="time" name="availability[${index}][end_time]" class="border rounded px-2 py-1" required>
            </div>
            <button type="button" class="remove-slot bg-red-500 text-white px-2 py-1 rounded">Remove</button>
        `;

        container.appendChild(slotDiv);

        slotDiv.querySelector('.remove-slot').addEventListener('click', function () {
            slotDiv.remove();
        });
    });

    document.querySelectorAll('.remove-slot').forEach(btn => {
        btn.addEventListener('click', function () {
            btn.parentElement.remove();
        });
    });
</script>
@endsection
