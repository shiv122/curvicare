<?php

namespace App\Http\Controllers\API\v1\Dietician;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DietResource;
use App\Models\UserDailyDiet;

/**
 * @group Dietician AssignDiet
 * 
 * APIs for Dietician to assign diet to user
 * 
 */


class DietController extends Controller
{

    /**
     * Assign Diet
     * 
     * This API is used to assign diet to user
     */

    public function assign(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'diet' => 'required|json',
        ]);

        $all_diets = json_decode($request->diet, true);

        clock($all_diets);

        $dietician = $request->user();
        $user = User::findOrFail($request->user_id);
        $data = [];
        foreach ($all_diets as $diet) {
            $date = $diet['date'];
            $data[] = [
                'user_id' => $user->id,
                'dietician_id' => $dietician->id,
                'diet' => json_encode($diet['diet_template']),
                'schedule_date' => $date,
                'created_at' => now(),
            ];
        }

        UserDailyDiet::insert($data);

        return response()->json([
            'message' => 'Diet assigned successfully',
        ]);
    }


    /**
     * Get Assigned Diet
     * 
     * This API is used to get assigned diet to user by date
     * 
     */


    public function assigned(Request $request)
    {

        $request->validate([
            'user_id' => 'integer|required',
            'date' => 'date|required',

        ]);

        $dietician = $request->user();

        $diets = $dietician->assigned_daily_diets()
            ->where('user_id', $request->user_id)
            ->whereDate('schedule_date', '>', $request->date)
            ->with(['user'])->get();

        return DietResource::collection($diets);
    }
}
