<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Dietician\ChatController;
use App\Http\Controllers\API\v1\Dietician\BasicController;
use App\Http\Controllers\API\v1\Auth\DieticianAuthController;



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
                Route::get('templates', 'templates');
            });

        Route::prefix('chat')->controller(ChatController::class)->group(function () {
            Route::get('active-list', 'activeChats');
            Route::get('{id}/messages', 'messages');
            Route::post('send-message', 'sendMessage');
        });
    });
