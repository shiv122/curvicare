<?php

namespace App\Events\Dietician;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class BasicDieticianEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $dietician;
    public $from;
    public $data;
    public $event;


    public function __construct(
        $dietician,
        User $from,
        array $data,
        string $event,
    ) {
        $this->dietician = $dietician;
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
        return new PrivateChannel('dietician-channel.' . $this->dietician->id);
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

    public function broadcastWhen()
    {
        // return $this->dietician->id !== $this->from->id;

        return true;
    }

    // public function broadcastWithSockets()
    // {
    //     return [
    //         'forceNew' => true,
    //         'reconnection' => true,
    //         'reconnectionAttempts' => 10,
    //         'reconnectionDelay' => 3000,
    //         'timeout' => 10000,
    //     ];
    // }

    public function broadcastQueue()
    {
        return 'default';
    }

    // public function broadcastDelay()
    // {
    //     return 1;
    // }
}
