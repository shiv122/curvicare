<?php

namespace App\Http\Controllers\API\v1\Dietician;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
