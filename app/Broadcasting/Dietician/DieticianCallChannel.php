<?php

namespace App\Broadcasting\Dietician;

use App\Models\Dietician;

class DieticianCallChannel
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
     * @param  \App\Models\Dietician  $Dietician
     * @return array|bool
     */
    public function join(Dietician $dietician)
    {
        return $dietician->id === $dietician->id;
    }
}
