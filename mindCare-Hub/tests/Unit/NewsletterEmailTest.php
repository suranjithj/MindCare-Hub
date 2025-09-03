<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use App\Mail\MarketingMail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsletterEmailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function subscribed_users_receive_newsletter_email()
    {
        // Fake mail sending
        Mail::fake();

        // Fake subscribers
        $subscribers = Subscriber::factory()->count(3)->create();

        // Content
        $content = "This is a automation test newsletter message.";

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new MarketingMail($subscriber, $content));
        }

        foreach ($subscribers as $subscriber) {
            Mail::assertSent(MarketingMail::class, function ($mail) use ($subscriber, $content) {
                return $mail->hasTo($subscriber->email)
                    && $mail->content === $content;
            });
        }

        Mail::assertSent(MarketingMail::class, 3);
    }
}
