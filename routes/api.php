<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\User\LikeController;
use App\Http\Controllers\API\v1\User\BasicController;
use App\Http\Controllers\API\v1\User\TrackerController;
use App\Http\Controllers\API\v1\Auth\UserAuthController;
use App\Http\Controllers\API\v1\User\ChatController;
use App\Http\Controllers\API\v1\User\DietController;
use App\Http\Controllers\API\v1\User\SubscriptionController;
use App\Http\Controllers\API\v1\User\SupportController;

Route::prefix('v1/user')->group(function () {
    Route::post('login', [UserAuthController::class, 'login']);
    Route::get('metadata', [BasicController::class, 'metadata']);



    Route::middleware(['auth:api'])
        ->group(function () {

            Route::controller(BasicController::class)
                ->group(function () {
                    Route::get('/', 'profile');
                    Route::post('/', 'updateProfile');
                    Route::get('quotes', 'quotes');
                    Route::get('recipes', 'recipes');
                    Route::get('blogs', 'blogs');
                    Route::get('faqs', 'faqs');
                    Route::get('faq-categories', 'faqCategories');
                    Route::get('testimonials', 'testimonials');
                    Route::get('packages', 'packages');
                });

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

            Route::controller(SubscriptionController::class)
                ->prefix('subscription')
                ->group(function () {
                    Route::get('/', 'index');
                    Route::post('/create-order', 'createOrder');
                    Route::post('/fetch-order', 'fetchOrder');
                });



            Route::controller(LikeController::class)
                ->prefix('like')
                ->group(function () {
                    Route::post('toggle/blog', 'toggleBlog');
                    Route::post('toggle/recipe', 'toggleRecipe');
                });

            Route::controller(ChatController::class)
                ->prefix('chat')
                ->group(function () {
                    Route::get('active', 'activeChat');
                    Route::post('send-message', 'sendMessage');
                    Route::post('mark-read', 'markRead');
                });

            Route::controller(DietController::class)
                ->prefix('diet')
                ->group(function () {
                    Route::get('/', 'index');
                });

            Route::controller(SupportController::class)
                ->prefix('support')
                ->group(function () {
                    Route::get('get-questions', 'getQuestions');
                    Route::get('get-tickets', 'getTickets');
                    Route::post('raise-ticket', 'raiseTicket');
                    Route::get('chat', 'getChat');
                    Route::post('send-message', 'sendMessage');
                });
        });
});


Broadcast::routes(['middleware' => ['auth:sanctum']]);
