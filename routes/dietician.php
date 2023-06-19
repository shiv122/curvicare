<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Dietician\ChatController;
use App\Http\Controllers\API\v1\Dietician\BasicController;
use App\Http\Controllers\API\v1\Auth\DieticianAuthController;
use App\Http\Controllers\API\v1\Dietician\CallController;
use App\Http\Controllers\API\v1\Dietician\DietController;

Route::prefix('v1/dietician')->group(function () {
    Route::post('login', [DieticianAuthController::class, 'login']);
});

Route::prefix('v1/dietician')
    ->middleware(['dietician', 'auth:sanctum'])
    ->group(function () {
        Route::controller(BasicController::class)
            ->group(function () {
                Route::get('/', 'profile');
                Route::post('update', 'update');
                Route::get('templates/{id?}', 'templates');
                Route::get('recipes', 'recipes');
                Route::get('blogs', 'blogs');
            });

        Route::prefix('chat')->controller(ChatController::class)->group(function () {
            Route::get('active-list', 'activeChats');
            Route::get('{id}/messages', 'messages');
            Route::post('send-message', 'sendMessage');
            Route::get('weekly-report/{user}', 'weeklyReport');
        });
        Route::prefix('diet')->controller(DietController::class)->group(function () {
            Route::post('assign', 'assign');
            Route::post('assigned', 'assigned');
        });
        Route::prefix('call')->controller(CallController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('start', 'start');
            Route::post('end', 'end');
        });
    });
