<?php

use App\Http\Controllers\API\v1\Auth\DieticianAuthController;
use Illuminate\Support\Facades\Route;



Route::prefix('v1/dietician')->group(function () {
    Route::post('login', [DieticianAuthController::class, 'login']);
});
