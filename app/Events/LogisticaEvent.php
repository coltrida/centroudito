<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogisticaEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $richiesta;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($richiesta)
    {
        $this->richiesta = $richiesta;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('logisticaChannel');
    }

    public function broadcastAs(){
        return 'task-created';
    }
}
