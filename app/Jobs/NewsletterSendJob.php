<?php

namespace App\Jobs;

use App\Models\Newsletter;
use App\Models\Subscriber;
use App\Mail\NewsletterSend;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NewsletterSendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $subscriber;

    private $newsletter;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Subscriber $subscriber, Newsletter $newsletter)
    {
        $this->subscriber = $subscriber;
        $this->newsletter = $newsletter;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        Mail::to($this->subscriber->subscriber_email)->send(new NewsletterSend($this->subscriber,$this->newsletter));
       
    }




}
