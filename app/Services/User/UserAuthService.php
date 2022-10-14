<?php

namespace App\Services\User;

use App\Enums\AuthTypeEnum;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Auth\UserRecord;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class UserAuthService
{



    /**
     * ********************************************************************************************
     * Authenticate user
     * ********************************************************************************************
     * 
     * This method will authenticate user by token ,
     * if user is not found in database it will create new user and return it with token
     * if user is found in database it will return old user with new token
     * 
     * @param Request $request
     * @return JsonResponse
     * @throws FailedToVerifyToken
     * 
     */


    public function authenticate(Request $request): JsonResponse
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
            return  $this->loginOrSignupUsingPhone($request, $firebase_user);
        } elseif ($firebase_user->email !== null) {
            return  $this->loginUsingGmail($request, $firebase_user);
        } else {
            return response()->json([
                'message' => 'The user has no email or phone number',
            ], 401);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Login or Signup using phone number
    |--------------------------------------------------------------------------
    |
    | This method will check if the user exists in the database, if not it will
    | create a new user and return the token.
    |
    */

    private function loginOrSignupUsingPhone(Request $request, UserRecord $firebase_user): JsonResponse
    {
        $phone = $firebase_user->phoneNumber;
        $user = User::where('phone', $phone)->first();
        $type = AuthTypeEnum::OLD->value;
        if (!empty($user)) {
            $user->update([
                'device_id' => $request->device_id,
            ]);
        } else {
            $user =  User::create([
                'phone' => $phone,
                'device_id' => $request->device_id,
                'firebase_uid' => $firebase_user->uid,
            ]);

            $type = AuthTypeEnum::NEW->value;
        }
        $user->tokens()->delete();
        return response()->json([
            'type' => $type,
            'token' => $user->createToken('user')->plainTextToken,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Login using Gmail
    |--------------------------------------------------------------------------
    |
    |This method used to login using Gmail account
    |
    */



    private function loginUsingGmail(Request $request, UserRecord $firebase_user): JsonResponse
    {

        if (!empty($firebase_user->email)) {
            $user = User::where('email', $firebase_user->email)->first();
        } elseif (!empty($firebase_user->phone_number)) {
            $phone = $firebase_user->phone_number;
            $user = User::where('phone', $phone)->first();
        } else {
            return response()->json([
                'message' => 'The user has no email or phone number',
            ], 401);
        }

        if (!empty($user)) {
            $user->update([
                'device_id' => $request->device_id,
            ]);
            $user->tokens()->delete();
            return response()->json([
                'type' => AuthTypeEnum::OLD->value,
                'token' => $user->createToken('user')->plainTextToken,
            ]);
        }
        return response()->json([
            'type' => AuthTypeEnum::NOT_FOUND->value,
            'message' => 'User not found',
        ], 401);
    }
}
