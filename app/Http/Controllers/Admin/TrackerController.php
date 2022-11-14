<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mood;
use Illuminate\Http\Request;

class TrackerController extends Controller
{
    public function index()
    {
        return 'Work in progress';
    }


    public function moods()
    {
        $moods = Mood::active()->get();

        return response()->json($moods);
    }

    public function userMood(Request $request)
    {
        $user  = $request->user();

        $moods = $user->moods()->with(['mood'])->get();

        return $moods;
    }


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



    public function userWater(Request $request)
    {
        $user  = $request->user();

        $water = $user->water()->get();

        return $water;
    }


    public function storeUserWater(Request $request)
    {

        $request->validate([
            'water_amount' => 'required|numeric',
        ]);

        $user = $request->user();

        $user->water()->create([
            'water_amount' => $request->water_amount,
        ]);

        return response()->json([
            'message' => 'Water stored successfully',
        ]);
    }



    public function userStep(Request $request)
    {
        $user  = $request->user();

        $steps = $user->steps()->get();

        return $steps;
    }


    public function storeUserStep(Request $request)
    {

        $request->validate([
            'step' => 'required|integer',
        ]);

        $user = $request->user();

        $user->steps()->create([
            'step_count' => $request->step,
        ]);

        return response()->json([
            'message' => 'Step stored successfully',
        ]);
    }
}
