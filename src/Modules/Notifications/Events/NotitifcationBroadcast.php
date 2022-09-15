<?php

namespace Twedoo\Stone\Modules\Notifications\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotitifcationBroadcast implements ShouldBroadcast
{

    /**
    * Get the channels the event should broadcast on.
    *
    * @return \Illuminate\Broadcasting\PrivateChannel
    */
    public function broadcastOn()
    {
        return new PrivateChannel('invitation.accepted');
    }

    /**
    * The event's broadcast name.
    *
    * @return string
    */
    public function broadcastAs()
    {
        return 'notitifcation.broadcast';
    }
}
