<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Notificacao implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $channel; 
    public $event;

    public function __construct($id, $channel, $event)
    {
        $this->id = $id;
        $this->channel = $channel;
        $this->event = $event;
    }
  
    public function broadcastOn()
    {
        return [$this->channel];
    }

    public function broadcastAs()
    {
        return $this->event;
    }
}
