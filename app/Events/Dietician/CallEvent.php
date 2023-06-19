<?php

namespace App\Events\Dietician;

use App\Http\Resources\UserResource;
use App\Models\Dietician;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CallEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public User $user;
    public Dietician $dietician;
    public array $data;
    public string $event;
    public function __construct(
        User $user,
        Dietician $dietician,
        array $data,
        string $event,
    ) {
        $this->user = $user;
        $this->dietician = $dietician;
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
        return new PrivateChannel('dietician.' . $this->dietician->id . '.call');
    }

    public function broadcastAs()
    {
        return $this->event;
    }

    public function broadcastWith()
    {
        return [
            'from' => new UserResource($this->user),
            'data' => $this->data,
        ];
    }
}
