<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $message;
    public $user_id;
    public function __construct(
        $message,
        $user_id
    ) {
        $this->message = $message;
        $this->user_id = $user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {


        $channel = new PrivateChannel('private.chat.' . $this->user_id);
        Log::info($channel);
        return $channel;
    }

    public function broadcastAs()
    {
        return 'message';
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'user' => auth()->user()->name,
            'user_id' => auth()->user()->id,
        ];
    }
}
