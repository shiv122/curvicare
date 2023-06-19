<?php

use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\User\UserCallChannel;
use App\Broadcasting\User\BasicUserChannel;
use App\Broadcasting\Dietician\DieticianCallChannel;
use App\Broadcasting\Dietician\BasicDieticianChannel;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/



Broadcast::channel('user-channel.{id}', BasicUserChannel::class);

Broadcast::channel('user.{id}.call', UserCallChannel::class);

Broadcast::channel('DChannel.{id}', BasicDieticianChannel::class);

Broadcast::channel('doctor.{id}.call', DieticianCallChannel::class);
