<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    //public $cooperativa_id;
    public $message;
    public $channel; 
    public $event;
    //public $data;


    public function __construct($message, $channel, $event)
    {
        //$this->cooperativa_id = $cooperativa_id;
        $this->message = $message;
        $this->channel = $channel;
        $this->event = $event;
        //$this->data = $data;
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
