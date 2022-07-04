<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return $request->user();
    }


    public function initialUpdate(Request $request)
    {
        $request->validate([
            'age' => 'required|numeric|min:10|max:100',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'activity' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'name' => 'required|string|max:255'
        ]);

        $user = $request->user();
        DB::transaction(function () use ($request, $user) {
            UserData::where('user_id', $user->id)->update([
                'age' => $request->age,
                'height' => $request->height,
                'weight' => $request->weight,
                'activity' => $request->activity,
                'gender' => $request->gender,
            ]);
            $user->name = $request->name;
            $user->save();
        });
    }
}
