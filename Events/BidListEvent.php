<?php

namespace Modules\Iauctions\Events;


use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Modules\Iauctions\Entities\Bid;


class BidListEvent implements ShouldBroadcastNow
{
    use SerializesModels, InteractsWithSockets;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $newBid;

    public function __construct(Bid $newBid)
    {
        $this->newBid=$newBid;
    }
    public function broadcastWith()
    {
        return [
            $this->newBid
        ];
    }

    public function broadcastAs()
    {
        return 'newBid';
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return new Channel('bid-'.$this->newBid->auction->id);
    }
}