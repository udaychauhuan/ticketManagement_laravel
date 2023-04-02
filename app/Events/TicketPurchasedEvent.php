<?php

namespace App\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketPurchasedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
     public $UserId ;
     public $TicketId;
    /**
     * Create a new event instance.
     */
    public function __construct($UserId ,$TicketId)
    {
        $this->UserId=$UserId;
        $this->TicketId=$TicketId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
