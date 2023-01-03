<?php

namespace App\Events\Dietician;

use App\Models\User;
use App\Models\Dietician;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BasicEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $dietician_id;
    public $from = null;
    public $data;
    public $event;


    public function __construct(
        int $dietician_id,
        Dietician|User|null|array $from = null,
        array $data,
        string $event,
    ) {
        $this->dietician_id = $dietician_id;
        $this->from = $from;
        $this->data = $data;
        $this->event = $event;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        return new PrivateChannel('DChannel.' . $this->dietician_id);
    }

    public function broadcastAs()
    {
        return $this->event;
    }

    public function broadcastWith()
    {
        return [
            'from' => $this->from,
            'data' => $this->data,
        ];
    }
}
