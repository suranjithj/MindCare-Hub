<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $role;

    public function __construct($user, $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function build()
    {
        return $this->subject('Welcome to MindCare Hub')
                    ->view('emails.registration')
                    ->with([
                        'userName' => $this->user->name,
                        'role'     => $this->role,
                    ]);
    }
}
