<?php

namespace App;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\RecipeController;
use App\Http\Controllers\Admin\BlogTagController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DieticianController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\Admin\Metadata\ExpertiseController;
use App\Http\Controllers\Admin\Metadata\TagController;
use App\Http\Controllers\Admin\Metadata\MoodController;
use App\Http\Controllers\Admin\MiscellaneousController;
use App\Http\Controllers\Admin\Metadata\QuoteController;

Route::prefix('admin')->middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout-admin');
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'home'])->name('home');
        Route::get('/test', [DashboardController::class, 'test'])->name('test');
        Route::post('/send', [DashboardController::class, 'send'])->name('send');
    });

    Route::get('/work-in-progress', [MiscellaneousController::class, 'workInProgress'])->name('work-in-progress');
});



Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {


    Route::name('miscellaneous.')->prefix('miscellaneous')->controller(MiscellaneousController::class)->group(function () {
        Route::post('report-error', 'sendReport')->name('report-error');
    });



    Route::name('user.')->prefix('user')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('view/{id}', 'viewUser')->name('view');
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
    });


    Route::name('dietician.')->prefix('dietician')->controller(DieticianController::class)->group(function () {
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/view', 'viewDietician')->name('view');
        Route::put('/status', 'status')->name('status');
    });



    Route::name('recipe.')->prefix('recipe')->controller(RecipeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::put('/status', 'status')->name('status');
        Route::put('/paid-status', 'paidStatus')->name('paid-status');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/edit/{id}', 'edit')->name('edit');
    });

    Route::name('food.')->prefix('food')->controller(FoodController::class)->group(function () {
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/view', 'viewFood')->name('view');
        Route::put('/status', 'status')->name('status');
    });

    Route::name('ingredient.')->prefix('ingredient')->controller(IngredientController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::put('/status', 'status')->name('status');
    });


    Route::name('blog.')->prefix('blog')->controller(BlogController::class)->group(function () {
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/view', 'viewBlog')->name('view');
        Route::put('/status', 'status')->name('status');


        Route::name('tag.')->prefix('tag')->controller(BlogTagController::class)->group(function () {
            Route::get('/add', 'add')->name('add');
            Route::post('/store', 'store')->name('store');
            Route::get('/view', 'viewTag')->name('view');
            Route::put('/status', 'status')->name('status');
        });
    });


    Route::name('package.')->prefix('package')->controller(PackageController::class)->group(function () {
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/view', 'viewPackage')->name('view');
        Route::get('/show/{id}', 'show')->name('show');
        Route::put('/status', 'status')->name('status');
    });


    Route::name('metadata.')->prefix('metadata')->group(function () {
        Route::name('coupon.')->prefix('coupon')->controller(CouponController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::delete('destroy/{id}', 'destroy')->name('destroy');
            Route::put('status', 'status')->name('status');
        });

        Route::name('tag.')->prefix('tag')->controller(TagController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::delete('destroy/{id}', 'destroy')->name('destroy');
            Route::put('status', 'status')->name('status');
        });

        Route::name('mood.')->prefix('mood')->controller(MoodController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::delete('destroy/{id}', 'destroy')->name('destroy');
            Route::put('status', 'status')->name('status');
        });

        Route::name('quote.')->prefix('quote')->controller(QuoteController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::delete('destroy/{id}', 'destroy')->name('destroy');
            Route::put('status', 'status')->name('status');
        });
        Route::name('expertise.')->prefix('expertise')->controller(ExpertiseController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
            Route::delete('destroy/{id}', 'destroy')->name('destroy');
            Route::put('status', 'status')->name('status');
        });
    });


    Route::name('faq.')->prefix('faq')->controller(FaqController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::put('status', 'status')->name('status');
        Route::put('status/paid', 'statusIsPaid')->name('status.is_paid');
        Route::put('status/featured', 'statusIsFeatured')->name('status.is_featured');


        Route::get('/categories', 'faqCategories')->name('categories');
        Route::post('/categories', 'faqCategoriesStore')->name('categories.store');
        Route::get('/categories/edit/{id}', 'faqCategoriesEdit')->name('categories.edit');
        Route::post('/categories/update', 'faqCategoriesUpdate')->name('categories.update');
        Route::put('/categories/status', 'faqCategoriesStatus')->name('categories.status');
    });


    Route::name('product.')->prefix('product')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('add', 'add')->name('add');
        Route::post('store', 'store')->name('store');
        Route::put('status', 'status')->name('status');
    });


    Route::name('setting.')->prefix('setting')->controller(SettingController::class)->group(function () {
        Route::get('/version-control', 'versionControl')->name('version-control');
        Route::post('/version-control', 'storeVersionControl');
    });
});




// Route::name('payment.')->prefix('payment-gateway')
//     ->controller(PaymentController::class)
//     ->group(function () {
//         Route::get('/{id}', 'paymentPage')->name('pay');
//         Route::post('/', 'storePayment')->name('store');

//         //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//         Route::get('/payment/{string}/{price}', 'charge')->name('goToPayment');
//         Route::post('/payment/process-payment/{string}/{price}', 'processPayment')->name('processPayment');
//     });
