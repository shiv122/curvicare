<?php

namespace App\Http\Controllers\API\v1\User;

use App\Http\Controllers\Controller;
use App\Models\RazorpayOrder;
use App\Services\User\UserPaymentFetchService;
use App\Services\User\UserSubscriptionOrderService;
use Illuminate\Http\Request;


/**
 * @group User Payment
 * 
 * APIs for User Payment
 */


class SubscriptionController extends Controller
{


    /**
     * User Subscription
     * 
     * @authenticated
     * 
     * This endpoint is used to get user subscription
     * 
     */

    public function index(Request $request)
    {
        $subscriptions = $request->user()->subscriptions()->with(['transaction'])->get();

        return $subscriptions;
    }


    /**
     * Create Order
     * 
     * @authenticated
     * 
     * This endpoint is used to create razorpay order
     * 
     */

    public function createOrder(Request $request, UserSubscriptionOrderService $service)
    {

        $request->validate([
            'package_id' => 'required|integer|exists:packages,id',
            'type' => 'nullable|string|in:new,renew',
            'currency' => 'required|string|in:INR,USD',
            'coupon_code' => 'nullable|string|exists:coupons,code|size:255',
            'form_data' => 'required|array',
        ]);

        return $service->generateOrder($request);
    }


    /**
     * Fetch Order
     * 
     * @authenticated
     * 
     * This endpoint is used to fetch razorpay order and update order status and process payment
     * 
     */

    public function fetchOrder(Request $request, UserPaymentFetchService $service)
    {
        $request->validate([
            'id' => 'required|string|max:255',
        ]);
        $order = RazorpayOrder::where('order_id', $request->id)->firstOrFail();
        return $service->fetch($order);
    }
}
