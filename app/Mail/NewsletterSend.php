<?php

namespace App\Mail;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsletterSend extends Mailable
{
    use Queueable, SerializesModels;


    protected $subscriber;

    protected $newsletter_subject;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Subscriber $subscriber,$newsletter_subject)
    {
        $this->subscriber = $subscriber;
        $this->newsletter_subject = $newsletter_subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@lettuce.com')
                    ->subject($this->newsletter_subject)
                    ->view('emails.newsletter.newsletter')
                    ->with([
                        'subscriber'=>$this->subscriber
                    ]);
    }
}
