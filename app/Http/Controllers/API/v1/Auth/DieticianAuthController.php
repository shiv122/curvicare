<?php

namespace App\Http\Controllers\API\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


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

    public function login()
    {
    }
}
