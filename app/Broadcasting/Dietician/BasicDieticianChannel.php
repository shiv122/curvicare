<?php

namespace App\Broadcasting\Dietician;

use App\Models\Dietician;

class BasicDieticianChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the Dietician's access to the channel.
     *
     * @param  \App\Models\Dietician  $dietician
     * @return array|bool
     */
    public function join(Dietician $dietician)
    {
        return $dietician->id === $dietician->id;
    }
}
