<?php

namespace App;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')->middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout-admin');
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'home'])->name('home');
    });
});


Route::prefix('admin')->name('admin.')->middleware(['web'])->group(function () {


    Route::name('user.')->prefix('user')->controller(UserController::class)->group(function () {
        Route::get('/add', 'addUser')->name('add');
        Route::post('/store', 'storeUser')->name('store');
    });
});
