<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Counselor;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function paymentPage($id)
    {
        $appointment = Appointment::with('counselor')->findOrFail($id);
        $counselor = $appointment->counselor;

        $appointmentData = [
            'appointment_date' => $appointment->appointment_date,
            'appointment_time' => $appointment->appointment_time,
        ];

        return view('payments.page', compact('appointment', 'counselor', 'appointmentData'));
    }

    public function create(Request $request)
    {
        $appointmentId = $request->query('appointment_id');

        if (!$appointmentId) {
            return redirect()->back()->with('error', 'Appointment not found for payment.');
        }

        $appointment = Appointment::with('counselor')->find($appointmentId);

        if (!$appointment) {
            return redirect()->back()->with('error', 'Invalid appointment for payment.');
        }

        return view('payments.create', compact('appointment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cardholder_name' => 'required|string|max:255',
            'card_number' => 'required|digits:16',
            'expiry_month' => 'required|digits:2|between:1,12',
            'expiry_year' => 'required|digits:2',
            'cvc' => 'required|digits_between:3,4',
            'payment_method' => ['required', Rule::in(['Card'])],
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();

            $appointmentId = $request->input('appointment_id');
            $appointment = Appointment::findOrFail($appointmentId);
            $counselor = $appointment->counselor;

            $existingPayment = Payment::where('appointment_id', $appointment->id)->first();
            if ($existingPayment) {
                return redirect()->back()->with('error', 'This appointment has already been paid.');
            }

            $paymentDetails = json_encode([
                'cardholder_name' => $request->input('cardholder_name'),
                'last4' => substr($request->input('card_number'), -4),
                'expiry' => $request->input('expiry_month') . '/' . $request->input('expiry_year'),
            ]);

            $payment = Payment::create([
                'user_id' => $user->id,
                'counselor_id' => $counselor->id,
                'appointment_id' => $appointment->id,
                'amount' => $counselor->consultation_fee,
                'payment_method' => $request->input('payment_method'),
                'payment_details' => $paymentDetails,
                'status' => 'completed',
            ]);

            $appointment->payment_status = 'paid';
            $appointment->save();

            DB::commit();

            return redirect()->back()->with('success', 'Payment completed and appointment confirmed.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Payment failed: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);

        return view('payments.page', compact('appointment'));
    }

}
