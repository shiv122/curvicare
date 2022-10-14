<?php

namespace App\Http\Controllers\API\v1\Auth;

use App\Http\Controllers\Controller;
use App\Services\User\UserAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



/**
 * 
 * @group User Auth
 * 
 * APIs for user authentication/registration
 * All auth related APIs are here 
 * 
 */


class UserAuthController extends Controller
{


    /**
     * Login
     * 
     * This endpoint is used to authenticate user by token or register new user
     * if user is not found in database it will create new user and return it with token
     * if user is found in database it will return old user with new token
     * 
     * @bodyParam token string required The token of the user. Example: <<json web token>>
     * @bodyParam device_id string required The device id of the user. Example: 1e6c1d3c2f5b4f6d8c3e5a7b9c6d8f5e
     * 
     */


    public function login(Request $request, UserAuthService $authService): JsonResponse
    {
        $request->validate([
            'token' => 'required|string',
            'device_id' => 'required|string|size:36',
        ]);

        return $authService->authenticate($request);
    }
}
