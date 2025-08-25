<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MarketingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $content;

    public function __construct($recipient, $content)
    {
        $this->recipient = $recipient;
        $this->content = $content;
    }

    public function build()
    {
        return $this->subject('MindCare Hub Update')
                    ->html("<h2 style='color:#4f46e5;'>MindCare Newsletter</h2>
                            <hr class='h-1 bg-gray-600 my-2'>
                            <p>Hi {$this->recipient->name},</p>
                            <p>We are excited to share the latest updates from MindCare Hub!</p>
                            <div>{$this->content}</div>
                            <p><a href='http://127.0.0.1:8000/' style='background:#4f46e5;color:white;padding:8px 15px;border-radius:5px;text-decoration:none;'>Visit MindCare Hub</a></p>
                            <hr>
                            <p style='font-size:12px;color:#888;'>&copy; 2025 MindCare Hub. All rights reserved.</p>");
    }
}


