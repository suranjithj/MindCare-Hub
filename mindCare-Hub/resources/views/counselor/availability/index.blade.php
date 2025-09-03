@extends('layouts.app')

@section('content')
<div class="max-w-3xl p-6 mx-auto mb-16 bg-white rounded shadow mt-36">
    <h1 class="mb-6 text-2xl font-bold">Manage Availability</h1>

    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    @if(!empty($availability))
        <div class="pt-6 mt-10 border-t">
            <h2 class="mb-4 text-xl font-semibold text-gray-800">Your Current Availability</h2>

            <div class="mb-8 overflow-x-auto">
                <table class="w-full text-left border border-gray-300 rounded shadow-sm">
                    <thead class="text-gray-700 bg-gray-100">
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
                <div class="flex items-end mb-4 space-x-4">
                    <div>
                        <label for="availability[{{ $index }}][day]" class="block mb-2 text-sm font-medium text-gray-700">Day</label>
                        <select name="availability[{{ $index }}][day]" class="w-32 px-2 py-1 border rounded">
                            @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                                <option value="{{ $day }}" @if($slot['day'] == $day) selected @endif>{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="availability[{{ $index }}][start_time]" class="block mb-2 text-sm font-medium text-gray-700">Start Time</label>
                        <input type="time" name="availability[{{ $index }}][start_time]" value="{{ $slot['start_time'] }}" class="px-2 py-1 border rounded" required>
                    </div>
                    <div>
                        <label for="availability[{{ $index }}][end_time]" class="block mb-2 text-sm font-medium text-gray-700">End Time</label>
                        <input type="time" name="availability[{{ $index }}][end_time]" value="{{ $slot['end_time'] }}" class="px-2 py-1 border rounded" required>
                    </div>
                    <button type="button" class="px-2 py-1 text-white bg-red-500 rounded remove-slot">Remove</button>
                </div>
            @endforeach

            @if(empty($oldAvailability))
                <div class="flex items-end mb-4 space-x-4">
                    <div>
                        <label for="availability[0][day]" class="block text-sm font-medium text-gray-700">Day</label>
                        <select name="availability[0][day]" class="px-2 py-1 border rounded">
                            @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="availability[0][start_time]" class="block text-sm font-medium text-gray-700">Start Time</label>
                        <input type="time" name="availability[0][start_time]" class="px-2 py-1 border rounded" required>
                    </div>
                    <div>
                        <label for="availability[0][end_time]" class="block text-sm font-medium text-gray-700">End Time</label>
                        <input type="time" name="availability[0][end_time]" class="px-2 py-1 border rounded" required>
                    </div>
                    <button type="button" class="px-2 py-1 text-white bg-red-500 rounded remove-slot">Remove</button>
                </div>
            @endif
        </div>

        <button type="button" id="add-slot" class="px-4 py-2 mb-4 text-white bg-blue-600 rounded hover:bg-blue-700">Add Time Slot</button>

        <br>

        <button type="submit" class="px-6 py-2 text-white bg-green-600 rounded hover:bg-green-700">Save Availability</button>
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
                <select name="availability[${index}][day]" class="px-2 py-1 border rounded">
                    ${days.map(day => `<option value="${day}">${day}</option>`).join('')}
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Start Time</label>
                <input type="time" name="availability[${index}][start_time]" class="px-2 py-1 border rounded" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">End Time</label>
                <input type="time" name="availability[${index}][end_time]" class="px-2 py-1 border rounded" required>
            </div>
            <button type="button" class="px-2 py-1 text-white bg-red-500 rounded remove-slot">Remove</button>
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
