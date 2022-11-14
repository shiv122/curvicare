<?php

use App\Http\Controllers\API\v1\Auth\UserAuthController;
use App\Http\Controllers\API\v1\User\BasicController;
use Illuminate\Support\Facades\Route;



Route::prefix('v1/user')->group(function () {
    Route::post('login', [UserAuthController::class, 'login']);
    Route::get('metadata', [BasicController::class, 'metadata']);



    Route::controller(BasicController::class)
        ->middleware(['auth:api'])
        ->group(function () {
            Route::get('/', 'profile');
            Route::post('/', 'updateProfile');
            Route::get('quotes', 'quotes');
            Route::get('recipes', 'recipes');
            Route::get('blogs', 'blogs');
            Route::get('testimonials', 'testimonials');
        });
});
