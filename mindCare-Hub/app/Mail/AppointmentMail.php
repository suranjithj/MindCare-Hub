<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $status;

    public function __construct($appointment, $status)
    {
        $this->appointment = $appointment;
        $this->status = $status;
    }

    public function build()
    {
        return $this->subject('Appointment Notification')
                    ->view('emails.appointment')
                    ->with([
                        'userName' => $this->appointment->user_name,
                        'appointmentDate' => $this->appointment->appointment_date,
                        'appointmentTime' => $this->appointment->appointment_time,
                        'counselorName' => $this->appointment->counselor->name,
                        'status' => $this->status,
                    ]);
    }
}
