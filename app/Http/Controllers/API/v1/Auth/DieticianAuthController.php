<?php

namespace App\Http\Controllers\API\v1\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dietician\DieticianAuthService;

/**
 * 
 * @group Dietician Auth
 * 
 * APIs for user authentication/registration
 * All auth related APIs are here 
 * 
 */

class DieticianAuthController extends Controller
{


    /**
     * 
     * Login
     * 
     * This endpoint is used to authenticate dietician by token .
     * if dietician is not found in database it will return error
     * 
     */

    public function login(Request $request, DieticianAuthService $authService)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        return $authService->authenticate($request);
    }
}
