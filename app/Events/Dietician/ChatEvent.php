<?php

namespace App\Events\Dietician;

use App\Models\Dietician;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $dietician;
    public $message;
    public $from;
    public $event;

    public function __construct(
        Dietician $dietician,
        array $message,
        User $from,
        string $event,
    ) {
        $this->dietician = $dietician;
        $this->message = $message;
        $this->from = $from;
        $this->event = $event;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('dietician-chat-channel.' . $this->dietician->id);
    }

    public function broadcastAs()
    {
        return $this->event;
    }

    public function broadcastWith()
    {
        return [
            'from' => $this->from,
            'message' => $this->message,
        ];
    }
}
