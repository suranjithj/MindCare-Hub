<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Counselor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($counselorId)
    {

        $counselor = Counselor::find($counselorId);

        if (!$counselor) {

            return redirect()->route('dashboard')->with('error', 'Counselor not found.');

        }

        return view('layouts.make-appointment', compact('counselor'));
    }

    public function store(Request $request, $counselorId)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'mobile_no' => 'required|string|regex:/^07\d{8}$/',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'current_situation' => 'nullable|string|max:1000',
            'reason' => 'nullable|string|max:1000',
        ]);

        $counselor = Counselor::findOrFail($counselorId);

        $exists = Appointment::where('counselor_id', $counselorId)
            ->where('appointment_date', $validatedData['appointment_date'])
            ->where('appointment_time', $validatedData['appointment_time'])
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This time slot is already booked. Please choose another Date and Time.');
        }

        try {
            $appointment = new Appointment();
            $appointment->user_id = $user->id;
            $appointment->counselor_id = $counselor->id;
            $appointment->user_name = $user->name;
            $appointment->user_email = $user->email;
            $appointment->mobile = $validatedData['mobile_no'];
            $appointment->appointment_date = $validatedData['appointment_date'];
            $appointment->appointment_time = $validatedData['appointment_time'];
            $appointment->current_situation = $validatedData['current_situation'] ?? null;
            $appointment->reason = $validatedData['reason'] ?? null;
            $appointment->status = 'pending';
            $appointment->payment_status = 'pending';

            \Log::info('Redirecting to payment with appointment ID: ' . $appointment->id);


            if ($appointment->save()) {
                return redirect()->route('payments.page', $appointment->id)
                                 ->with('success', 'Appointment requested successfully! Proceed to payment.');
            } else {
                return redirect()->back()->with('error', 'Failed to save appointment. Please try again.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred. Please try again later.');
        }
    }

    public function counselorIndex() {
        $appointments = Appointment::with('user')
            ->where('counselor_id', Auth::guard('counselor')->id())
            ->latest()
            ->get();

        return view('counselor.appointments.index', compact('appointments'));
    }

    public function updateStatus(Request $request, $id) {
        $request->validate([
            'status' => 'required|in:confirmed,cancelled,completed',
        ]);

        $appointment = Appointment::where('id', $id)
            ->where('counselor_id', Auth::guard('counselor')->id())
            ->firstOrFail();

        $appointment->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Appointment status updated successfully.');
    }

    public function index()
    {
        $user = Auth::user();
        $appointments = Appointment::where('user_id', $user->id)

                                ->orderBy('appointment_date', 'desc')
                                ->orderBy('appointment_time', 'desc')
                                ->paginate(10);

        // return view
        return view('user.appointments.index', compact('appointments'));
    }

    public function viewClients()
    {
        $counselorId = Auth::guard('counselor')->id();

        $clients = User::whereHas('appointments', function ($query) use ($counselorId) {
            $query->where('counselor_id', $counselorId);
        })
        ->withCount(['appointments' => function ($query) use ($counselorId) {
            $query->where('counselor_id', $counselorId);
        }])
        ->with(['appointments' => function ($query) use ($counselorId) {
            $query->where('counselor_id', $counselorId)->latest()->take(1);
        }])
        ->get()
        ->map(function ($client) {
            $client->latestAppointment = $client->appointments->first();
            return $client;
        });

        return view('counselor.clients.index', compact('clients'));
    }

    public function userCancel($id)
    {
        $user = Auth::user();
        $appointment = Appointment::where('id', $id)
                        ->where('user_id', $user->id)
                        ->whereIn('status', ['pending', 'confirmed'])
                        ->firstOrFail();

        $appointment->status = 'cancelled';
        $appointment->save();

        return redirect()->route('user.appointments.index')->with('success', 'Appointment cancelled successfully.');
    }

    public function adminIndex()
    {
        $appointments = Appointment::with(['user', 'counselor'])
                        ->orderBy('appointment_date', 'desc')
                        ->orderBy('appointment_time', 'desc')
                        ->paginate(15);

        return view('admin.appointments.index', compact('appointments'));
    }

}
