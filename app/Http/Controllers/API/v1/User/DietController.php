<?php

namespace App\Http\Controllers\API\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\DietResource;
use Illuminate\Http\Request;


/**
 * @group User Diet
 * 
 * APIs for User to get diet
 * 
 */

class DietController extends Controller
{

    /**
     * Get Diet
     * 
     * This API is used to get diet for user
     * if days is not provided then it will return diet for next 7 days
     */

    public function index(Request $request)
    {

        $request->validate([
            'days' => 'integer|nullable',
            'date' => 'date|nullable',
        ]);
        $user = $request->user();
        $diet = $user->daily_diet()->forUpcomingDays($request->days ?? 7, $request->date)
            ->with('dietician')
            ->get();

        return DietResource::collection($diet);
    }
}
