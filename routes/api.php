<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\UserController;



Route::prefix('v1')->group(function () {



    Route::prefix('users')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::post('generate-otp', 'genOtp');
            Route::post('login', 'login');
        });


        Route::middleware(['auth:api'])->group(function () {
            Route::controller(UserController::class)->group(function () {
                Route::get('/', 'index');
                Route::get('/update', 'update');
            });
        });
    });
});
