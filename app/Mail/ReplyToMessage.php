<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyToMessage extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    protected $reply_message;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reply_message)
    {
        $this->reply_message = $reply_message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@lettuce.com')
                    ->subject('Lettuce Support')
                    ->view('emails.message.message')
                    ->with([
                        'reply_message'=>$this->reply_message,
                    ]);
    }
}
