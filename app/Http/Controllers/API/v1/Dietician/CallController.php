<?php

namespace App\Http\Controllers\API\v1\Dietician;

use App\Models\Call;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\User\CallEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\CallResource;
use App\Jobs\Notification\NotificationJob;

/**
 * @group Dietician Call
 * 
 * @authenticated
 * 
 * APIs for Dietician Call
 */
class CallController extends Controller
{

    /**
     * Call list
     */
    public function index(Request $request)
    {
        $dietician = $request->user();

        $calls = $dietician->calls()->with(['user'])->orderBy('id', 'desc')->simplePaginate();

        return CallResource::collection($calls);
    }


    /**
     * Start Call
     */
    public function start(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'agora_channel_id' => 'required|string',
        ]);

        $dietician = $request->user();

        $user = User::findOrFail($request->user_id);

        $call =  Call::create([
            'user_id' => $user->id,
            'dietician_id' => $dietician->id,
            'by' => 'dietician',
        ]);

        broadcast(new CallEvent(
            user: $user,
            dietician: $dietician,
            data: ['channel_id' => $request->agora_channel_id, 'call_id' => $call->id],
            event: 'incoming'
        ));

        dispatch(
            new NotificationJob(
                title: 'Incoming Call',
                message: 'Hiii ' . $user->name . ', ' . $dietician->name . ' is calling you.',
                device_ids: [$user->device_id],
                data: [
                    'call_id' => $call->id,
                    'channel_id' => $request->agora_channel_id
                ]
            )
        );

        return response([
            'status' => 'success',
            'message' => 'Calling...'
        ]);
    }

    /**
     * Pick Call
     */
    public function pick(Request $request)
    {
        $request->validate([
            'call_id' => 'required|string'
        ]);

        $dietician = $request->user();

        $dietician->calls()->find($request->call_id)->update([
            'start_time' => now(),
        ]);

        return response([
            'status' => 'success',
            'message' => 'Call picked successfully'
        ]);
    }

    /**
     * End Call
     */
    public function end(Request $request)
    {
        $request->validate([
            'call_id' => 'required|numeric',
        ]);
        /** @var Dietician */
        $dietician = $request->user();

        /** @var Call */
        $call = $dietician->calls()->findOrFail($request->call_id);

        if ($call->end_time) {
            return response([
                'status' => 'error',
                'message' => 'call already ended ' . $call->end_time->diffForHumans(),
            ], 422);
        }

        $call->update([
            'end_time' => now(),
            'ended_by' => 'dietician',
        ]);


        return response([
            'status' => 'success',
            'message' => 'call ended successfully',
        ]);
    }
}
