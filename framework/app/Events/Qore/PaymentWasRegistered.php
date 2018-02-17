<?php

namespace App\Events\Qore;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Qore\Pay;

class PaymentWasRegistered
{
    use InteractsWithSockets, SerializesModels;

    public $pay;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Pay $pay)
    {
        $this->pay = $pay;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
