@extends('layouts.app')

@section('content')
<div class="max-w-2xl p-6 mx-auto mb-16 bg-white rounded-lg shadow-md mt-36">
    <h2 class="mb-2 text-2xl font-semibold text-gray-800">Complete Your Payment</h2>
    <p class="mb-6 text-gray-600">You are booking an appointment with <strong>{{ $counselor->name }}</strong>.</p>

    @if (session('success'))
        <div class="p-4 mb-4 text-green-800 bg-green-100 border border-green-300 rounded-md shadow-sm" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Display Error Message --}}
    @if (session('error'))
        <div class="p-4 mb-4 text-red-700 bg-red-100 border border-red-300 rounded-md shadow-sm" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Display Validation Errors --}}
    @if ($errors->any())
        <div class="p-4 mb-4 text-red-700 bg-red-100 border border-red-300 rounded-md shadow-sm" role="alert">
            <strong class="font-bold">Oops! Please correct the errors below.</strong>
            <ul class="mt-2 text-sm list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

    <div class="p-4 mb-6 border border-blue-200 rounded-lg bg-blue-50">
        <h3 class="text-lg font-semibold text-blue-800">Appointment Summary</h3>
        <div class="mt-2 text-gray-700">
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointmentData['appointment_date'])->format('F j, Y') }}</p>
            <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointmentData['appointment_time'])->format('g:i A') }}</p>
            <p class="mt-2 text-2xl font-bold"><strong>Total Amount:</strong> {{ number_format($counselor->consultation_fee, 2) }} LKR</p>
        </div>
    </div>

    <form action="{{ route('payments.store') }}" method="POST" id="payment-form" class="mt-6">
        @csrf
        <input type="hidden" name="payment_method" value="Card">
        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

        <div class="mb-6">
            <label for="cardholder_name" class="block mb-1 text-sm font-medium text-gray-700">Cardholder Name <span class="text-red-500">*</span></label>
            <input type="text" name="cardholder_name" id="cardholder_name" class="w-full p-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('cardholder_name') }}" placeholder="Full Name as it appears on the card" required>
        </div>

        <div class="mb-6">
            <label for="card_number" class="block mb-1 text-sm font-medium text-gray-700">Card Number <span class="text-red-500">*</span></label>
            <input type="text" name="card_number" id="card_number" class="w-full p-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="•••• •••• •••• ••••" required pattern="\d{16}" maxlength="16" title="Enter a 16-digit card number without spaces or dashes.">
        </div>

        <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
            <div>
                <label for="expiry_date" class="block mb-1 text-sm font-medium text-gray-700">Expiry Date <span class="text-red-500">*</span></label>
                <div class="flex space-x-2">
                    <input type="text" name="expiry_month" id="expiry_month" class="w-1/2 p-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="MM" required pattern="(0[1-9]|1[0-2])" maxlength="2" title="Enter a 2-digit month (e.g., 01 for January).">
                    <input type="text" name="expiry_year" id="expiry_year" class="w-1/2 p-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="YY" required pattern="\d{2}" maxlength="2" title="Enter the last 2 digits of the year (e.g., 25 for 2025).">
                </div>
            </div>
            <div>
                <label for="cvc" class="block mb-1 text-sm font-medium text-gray-700">CVC / CVV <span class="text-red-500">*</span></label>
                <input type="text" name="cvc" id="cvc" class="w-full p-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="•••" required pattern="\d{3,4}" maxlength="4" title="Enter the 3 or 4-digit security code.">
            </div>
        </div>

        <div class="p-4 mb-8 border-l-4 border-yellow-400 bg-yellow-50">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 3.001-1.742 3.001H4.42c-1.53 0-2.493-1.667-1.743-3.001l5.58-9.92zM10 13a1 1 0 110-2 1 1 0 010 2zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        For demonstration purposes only. Do not enter real credit card information. This form does not securely process payments.
                    </p>
                </div>
            </div>
        </div>


        <div class="flex items-center justify-end">
            <button type="submit" class="bg-green-600 text-white hover:bg-green-700 font-semibold px-6 py-2.5 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150">
                Pay & Confirm Appointment
            </button>
        </div>
    </form>
</div>
@endsection
