<?php

namespace App\Http\Controllers\API\v1\User;

use App\Http\Controllers\Controller;
use App\Models\RazorpayOrder;
use App\Services\User\UserPaymentFetchService;
use App\Services\User\UserSubscriptionOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $subscriptions = $request->user()->subscriptions()->get();

        return $subscriptions;
    }

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

    public function fetchOrder(Request $request, UserPaymentFetchService $service)
    {
        $request->validate([
            'id' => 'required|string|max:255',
        ]);
        $order = RazorpayOrder::where('order_id', $request->id)->firstOrFail();
        return $service->fetch($order);
    }
}
