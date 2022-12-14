<?php

namespace App\Services\Dietician;

use App\Models\Dietician;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DieticianAuthService
{

    public function authenticate(Request $request): JsonResponse
    {


        $user = Dietician::where('email', $request->email)->first();
        if (!$user || !\Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email or password is incorrect'
            ], 401);
        }


        $user->tokens()->delete();
        $token = $user->createToken('dietician')->plainTextToken;
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 200);
    }
}
