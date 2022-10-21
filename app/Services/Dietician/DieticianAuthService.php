<?php

namespace App\Services\Dietician;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class DieticianAuthService
{

    public function authenticate(Request $request): JsonResource
    {

        $auth = app('firebase.auth');

        try {
            $verifiedIdToken = $auth->verifyIdToken($request->token);
        } catch (FailedToVerifyToken $e) {
            return response()->json([
                'message' => 'The token is invalid: ' . $e->getMessage(),
            ], 401);
        }
        $uid = $verifiedIdToken->claims()->get('sub');
        $firebase_user = $auth->getUser($uid);
        if ($firebase_user->phoneNumber !== null) {
            return  $this->loginUsingPhone($request, $firebase_user);
        } elseif ($firebase_user->email !== null) {
            return  $this->loginUsingGmail($request, $firebase_user);
        } else {
            return response()->json([
                'message' => 'The user has no email or phone number',
            ], 401);
        }
    }






    public function loginUsingPhone()
    {
    }
}
