<?php

use App\Http\Controllers\API\v1\Auth\UserAuthController;
use Illuminate\Support\Facades\Route;



Route::prefix('v1/user')->group(function () {
    Route::post('login', [UserAuthController::class, 'login']);
});
