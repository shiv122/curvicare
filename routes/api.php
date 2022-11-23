<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\User\BasicController;
use App\Http\Controllers\API\v1\User\TrackerController;
use App\Http\Controllers\API\v1\Auth\UserAuthController;



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

            Route::controller(TrackerController::class)
                ->prefix('tracker')
                ->group(function () {
                    Route::get('/', 'index');
                    Route::get('moods', 'moods');
                    Route::get('mood', 'userMood');
                    Route::post('mood', 'storeUserMood');
                    Route::get('water', 'userWater');
                    Route::post('water', 'storeUserWater');
                    Route::get('step', 'userStep');
                    Route::post('step', 'storeUserStep');
                });
        });
});
