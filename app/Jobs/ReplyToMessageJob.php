<?php

namespace App\Jobs;

use App\Mail\ReplyToMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ReplyToMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $reply_to_email;
    
    private $reply_message;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($reply_to_email, $reply_message)
    {
        $this->reply_to_email = $reply_to_email;
        $this->reply_message = $reply_message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->reply_to_email)->send(new ReplyToMessage($this->reply_message));
    }
    
    
}
