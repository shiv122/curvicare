<?php

namespace App\Http\Controllers\API\v1\User;


use App\Models\Mood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MoodResource;
use App\Http\Resources\Tracker\UserMoodResource;
use App\Http\Resources\Tracker\UserStepResource;
use App\Http\Resources\Tracker\UserWaterResource;

/**
 * @group User Tracker
 * 
 * APIs for user tracker eg. mood, steps, water
 */

class TrackerController extends Controller
{
    public function index()
    {
        return 'Work in progress';
    }



    /**
     * Moods
     * 
     * @authenticated
     * 
     * This endpoint is used to get all moods
     * 
     */


    public function moods()
    {
        $moods = Mood::active()->get();

        return MoodResource::collection($moods);
    }

    /**
     * User Mood
     * 
     * @authenticated
     * 
     * This endpoint is used to get user mood
     * 
     */

    public function userMood(Request $request)
    {
        $user  = $request->user();

        $moods = $user->moods()->with(['mood'])->get();

        return UserMoodResource::collection($moods);
    }

    /**
     * Store User Mood
     * 
     * @authenticated
     * 
     * This endpoint is used to store user mood
     * 
     */

    public function storeUserMood(Request $request)
    {

        $request->validate([
            'mood' => 'required|integer|exists:moods,id',
        ]);
        $user = $request->user();
        $user->moods()->create([
            'mood_id' => $request->mood,
        ]);
        return response()->json([
            'message' => 'Mood stored successfully',
        ]);
    }

    /**
     * User Steps
     * 
     * @authenticated
     * 
     * This endpoint is used to get user steps
     * 
     */


    public function userWater(Request $request)
    {
        $user  = $request->user();

        $water = $user->water()->get();

        return UserWaterResource::collection($water);
    }

    /**
     * Store User Water
     * 
     * @authenticated
     * 
     * This endpoint is used to store user water
     * 
     */

    public function storeUserWater(Request $request)
    {

        $request->validate([
            'water_amount' => 'required|numeric',
        ]);

        $user = $request->user();

        $water =  $user->water()->whereDate('created_at', now())->first();


        if ($water) {
            $water->update([
                'water_amount' => $water->water_amount + $request->water_amount,
            ]);
        } else {
            $user->water()->create([
                'water_amount' => $request->water_amount,
            ]);
        }


        return response()->json([
            'message' => 'Water stored successfully',
        ]);
    }


    /**
     * User Steps
     * 
     * @authenticated
     * 
     * This endpoint is used to get user steps
     * 
     */

    public function userStep(Request $request)
    {
        $user  = $request->user();

        $steps = $user->steps()->get();

        return UserStepResource::collection($steps);
    }

    /**
     * Store User Steps
     * 
     * @authenticated
     * 
     * This endpoint is used to store user steps
     * 
     */

    public function storeUserStep(Request $request)
    {

        $request->validate([
            'step' => 'required|integer',
        ]);

        $user = $request->user();

        $steps = $user->steps()->whereDate('created_at', now())->first();

        if ($steps) {
            $steps->update([
                'step_count' => $request->step,
            ]);
        } else {
            $user->steps()->create([
                'step_count' => $request->step,
            ]);
        }

        return response()->json([
            'message' => 'Step stored successfully',
        ]);
    }
}
