<?php

namespace App;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DieticianController;
use App\Http\Controllers\Admin\MiscellaneousController;

Route::prefix('admin')->middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout-admin');
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'home'])->name('home');
    });
});



Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {


    Route::name('miscellaneous.')->prefix('miscellaneous')->controller(MiscellaneousController::class)->group(function () {
        Route::post('report-error', 'sendReport')->name('report-error');
    });



    Route::name('user.')->prefix('user')->controller(UserController::class)->group(function () {
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
    });
    Route::name('dietician.')->prefix('dietician')->controller(DieticianController::class)->group(function () {
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/view', 'view')->name('view');
        Route::put('/status', 'status')->name('status');
    });

    Route::name('package.')->prefix('package')->controller(PackageController::class)->group(function () {
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/view', 'view')->name('view');
        Route::put('/status', 'status')->name('status');
    });


    Route::name('metadata.')->prefix('metadata')->group(function () {
        Route::name('coupon.')->prefix('coupon')->controller(CouponController::class)->group(function () {
            Route::get('/add', 'add')->name('add');
            Route::post('/store', 'store')->name('store');
            Route::get('/view', 'view')->name('view');
            Route::put('/status', 'status')->name('status');
        });
    });
});
