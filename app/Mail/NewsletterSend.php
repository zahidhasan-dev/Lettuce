<?php

namespace App\Mail;

use App\Models\Newsletter;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsletterSend extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    protected $subscriber;

    protected $newsletter;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Subscriber $subscriber, Newsletter $newsletter)
    {
        $this->subscriber = $subscriber;
        $this->newsletter = $newsletter;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@lettuce.com')
                    ->subject($this->newsletter->newsletter_subject)
                    ->view('emails.newsletter.newsletter')
                    ->with([
                        'newsletter'=>$this->newsletter->newsletter_code,
                        'subscriber'=>$this->subscriber
                    ]);
    }
}
