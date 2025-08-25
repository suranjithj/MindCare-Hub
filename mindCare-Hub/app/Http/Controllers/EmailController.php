<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RegistrationMail;
use App\Mail\AppointmentMail;
use App\Mail\MarketingMail;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    // Send registration email
    public function sendRegistrationEmail($user, $role)
    {
        Mail::to($user->email)->send(new RegistrationMail($user, $role));
    }

    // Send appointment email
    public function sendAppointmentEmail($appointment, $status)
    {
        $user = $appointment->user;
        $counselor = $appointment->counselor;

        Mail::to($user->email)
            ->cc($counselor->email)
            ->send(new AppointmentMail($appointment, $status));
    }

    // Send marketing email
    public function sendMarketingEmail($recipients, $content)
    {
        foreach ($recipients as $recipient) {
            Mail::to($recipient->email)->send(new MarketingMail($recipient, $content));
        }
    }

    // For Admin: View and send emails to subscribers
    public function indexSubscribers()
    {
        $subscribers = \App\Models\Subscriber::all();
        return view('admin.emails.index', compact('subscribers'));
    }

    public function sendBatchEmails(Request $request)
    {
        $request->validate([
            'recipients' => 'required|array',
            'message' => 'required|string',
        ]);

        $subscribers = \App\Models\Subscriber::whereIn('id', $request->recipients)->get();

        $this->sendMarketingEmail($subscribers, $request->message);

        return redirect()->route('admin.emails.index')->with('success', 'Emails sent successfully!');
    }

}
