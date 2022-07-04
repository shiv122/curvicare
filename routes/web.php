<?php

namespace App;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\FoodController;

use App\Http\Controllers\Admin\MoodController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\RecipeController;
use App\Http\Controllers\Admin\BlogTagController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DieticianController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\Admin\MiscellaneousController;

Route::prefix('admin')->middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout-admin');
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'home'])->name('home');
    });

    Route::get('/work-in-progress', [MiscellaneousController::class, 'workInProgress'])->name('work-in-progress');
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



    Route::name('recipe.')->prefix('recipe')->controller(RecipeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::put('/status', 'status')->name('status');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/edit/{id}', 'edit')->name('edit');
    });

    Route::name('food.')->prefix('food')->controller(FoodController::class)->group(function () {
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/view', 'view')->name('view');
        Route::put('/status', 'status')->name('status');
    });

    Route::name('ingredient.')->prefix('ingredient')->controller(IngredientController::class)->group(function () {
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/view', 'view')->name('view');
        Route::put('/status', 'status')->name('status');
    });


    Route::name('blog.')->prefix('blog')->controller(BlogController::class)->group(function () {
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/view', 'view')->name('view');
        Route::put('/status', 'status')->name('status');


        Route::name('tag.')->prefix('tag')->controller(BlogTagController::class)->group(function () {
            Route::get('/add', 'add')->name('add');
            Route::post('/store', 'store')->name('store');
            Route::get('/view', 'view')->name('view');
            Route::put('/status', 'status')->name('status');
        });
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

        Route::name('tag.')->prefix('tag')->controller(TagController::class)->group(function () {
            Route::post('/store', 'store')->name('store');
            Route::get('/view', 'view')->name('view');
            Route::put('/status', 'status')->name('status');
        });

        Route::name('mood.')->prefix('mood')->controller(MoodController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::put('/status', 'status')->name('status');
        });

        Route::name('quote.')->prefix('quote')->controller(QuoteController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::put('/status', 'status')->name('status');
        });
    });




    Route::name('product.')->prefix('product')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('add', 'add')->name('add');
        Route::post('store', 'store')->name('store');
        Route::put('status', 'status')->name('status');
    });
});
