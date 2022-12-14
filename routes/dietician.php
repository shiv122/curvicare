<?php

use App\Http\Controllers\API\v1\Auth\DieticianAuthController;
use App\Http\Controllers\API\v1\Dietician\BasicController;
use Illuminate\Support\Facades\Route;



Route::prefix('v1/dietician')->group(function () {
    Route::post('login', [DieticianAuthController::class, 'login']);
});

Route::prefix('v1/dietician')
    ->middleware(['dietician'])
    ->group(function () {
        Route::controller(BasicController::class)
            ->group(function () {
                Route::get('/', 'profile');
                Route::post('update', 'update');
            });
    });
