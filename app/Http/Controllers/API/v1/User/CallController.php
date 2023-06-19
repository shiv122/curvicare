<?php

namespace App\Http\Controllers\API\v1\User;

use App\Models\Call;
use App\Models\Dietician;
use Illuminate\Http\Request;
use App\Events\Dietician\CallEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\CallResource;


/**
 * @group User Call
 * 
 * @authenticated
 * 
 * APIs for User Call
 */

class CallController extends Controller
{


    /**
     * Call list
     */

    public function index(Request $request)
    {
        $user = $request->user();

        $calls = $user->calls()
            ->with(['dietician'])
            ->orderBy('id', 'desc')->simplePaginate();

        return CallResource::collection($calls);
    }

    /**
     * Start Call
     */

    public function start(Request $request)
    {
        $request->validate([
            'dietician_id' => 'required|numeric',
            'agora_channel_id' => 'required|string',
        ]);

        $user = $request->user();

        $dietician = Dietician::findOrFail($request->dietician_id);

        Call::create([
            'user_id' => $user->id,
            'dietician_id' => $dietician->id,
            'by' => 'user',
        ]);

        broadcast(new CallEvent(
            user: $user,
            dietician: $dietician,
            data: ['channel_id' => $request->agora_channel_id],
            event: 'incoming'
        ));

        return response([
            'status' => 'success',
            'message' => 'Calling...'
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


        /** @var User */
        $user = $request->user();

        /** @var Call */
        $call = $user->calls()->findOrFail($request->call_id);

        if ($call->end_time) {
            return response([
                'status' => 'error',
                'message' => 'call already ended ' . $call->end_time->diffForHumans(),
            ], 422);
        }

        $call->update([
            'end_time' => now(),
            'ended_by' => 'user',
        ]);


        return response([
            'status' => 'success',
            'message' => 'call ended successfully',
        ]);
    }
}
