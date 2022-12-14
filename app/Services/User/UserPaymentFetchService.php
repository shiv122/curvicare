<?php

namespace App\Services\User;

use Razorpay\Api\Api;
use Illuminate\Support\Str;
use App\Models\RazorpayOrder;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\DB;
use App\Models\DieticianAssignment;
use App\Models\RazorpayTransaction;
use Illuminate\Support\Facades\Log;

class UserPaymentFetchService
{

    public $rzPay;

    public function __construct()
    {
        if (env('RAZORPAY_MODE') == 'TEST') {
            $this->rzPay = new Api(env('RAZORPAY_TEST_KEY'), env('RAZORPAY_TEST_SECRET'));
        } else {
            $this->rzPay = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        }
    }

    public function fetch(RazorpayOrder $order)
    {
        if ($order->status !== 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'Order is already ' . $order->status
            ], 400);
        }

        $rzOrder = $this->rzPay->order->fetch($order->order_id)->payments()->toArray();
        $all_status = [];
        foreach ($rzOrder['items'] as $item) {
            $all_status[] = $item['status'];
            if ($item['status'] == 'captured') {
                return $this->processPaidOrder($order, $item['id']);
            }
        }
        //TODO : Need to handle refund case

        Log::channel('failed_order')->info('========================= Below order failed =========================');
        Log::channel('failed_order')->info($order);

        if (!in_array('authorized', $all_status) && !in_array('created', $all_status)) {
            $order->update([
                'status' => 'failed',
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Order is failed'
            ], 200);
        }
    }


    public function processPaidOrder(RazorpayOrder $order, string $transaction_id)
    {
        $package_duration = json_decode($order->package, true)['duration'];
        if ($order->type === 'renew') {
            DB::beginTransaction();
            $assignment =   $order->user->assignments()->latest()->first();
            $order->update([
                'status' => 'paid',
            ]);
            $assignment->update([
                'expiry' => now()->addDays($package_duration),
            ]);
            $this->createSubscription($order, $transaction_id, $assignment);
            DB::commit();
        } else {
            DB::beginTransaction();
            $order->update([
                'status' => 'paid',
            ]);
            $assignment =  DieticianAssignment::create([
                'user_id' => $order->user_id,
                'uuid' => Str::uuid(),
                'status' => 'pending',
                'form_data' => $order->form_data,
                'expiry' => now()->addDays($package_duration),
            ]);
            $this->createSubscription($order, $transaction_id, $assignment);
            DB::commit();
        }

        Log::channel('payment')->info('========================= Below order paid =========================');
        Log::channel('payment')->info($order);
        return response()->json([
            'status' => 'success',
            'message' => 'Order is paid'
        ], 200);
    }



    public function createSubscription(RazorpayOrder $order, string $transaction_id, DieticianAssignment $assignment): void
    {
        $package_duration = json_decode($order->package, true)['duration'];
        $user_subscription = UserSubscription::create([
            'user_id' => $order->user_id,
            'subscription' => $order->package,
            'start_date' => now(),
            'end_date' => now()->addDays($package_duration),
            'dietician_assignment_id' => $assignment->id,
        ]);

        RazorpayTransaction::create([
            'transaction_id' => $transaction_id,
            'user_subscription_id' => $user_subscription->id,
            'order_id' => $order->id,
            'paid_amount' => $order->payable_amount,
            'currency' => $order->currency,
        ]);
    }
}
