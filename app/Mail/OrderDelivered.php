<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderDelivered extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@lettuce.com')
                    ->subject('Order Delivered')
                    ->view('emails.order.order_delivered')
                    ->with([
                        'order'=>$this->order
                    ]);
    }
}
