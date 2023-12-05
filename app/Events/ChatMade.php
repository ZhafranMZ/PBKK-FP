<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMade implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $user;
    /**
     * Create a new event instance.
     */
    public function __construct($message, $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

   
    public function broadcastOn()
    {
        return new PrivateChannel('chat');
    }

    // public function broadcastAs(): string
    // {
    //     return 'ChatMade';
    // }
}
