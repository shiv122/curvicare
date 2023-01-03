<?php

use App\Broadcasting\Dietician\BasicDieticianChannel;
use App\Broadcasting\User\BasicUserChannel;
use Illuminate\Support\Facades\Broadcast;

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
Broadcast::channel('DChannel.{id}', BasicDieticianChannel::class);
