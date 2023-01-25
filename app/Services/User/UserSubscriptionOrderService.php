<?php

namespace App\Services\User;

use Log;
use App\Models\User;
use Razorpay\Api\Api;
use App\Models\Coupon;
use App\Models\Package;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RazorpayOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\DieticianAssignment;
use App\Jobs\User\RazorpayOrderInspectorJob;
use App\Models\PackagePrice;
use Illuminate\Validation\ValidationException;

class UserSubscriptionOrderService

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


    /**
     * @param Request $request
     * @return JsonResponse
     * 
     * This function is entry point for creating a new order or renewing an existing order 
     * for a user.
     * 
     */



    public function generateOrder(Request $request)
    {
        $request->validate([
            'package_id' => 'required|integer',
            'type' => 'nullable|string|in:new,renew',
            'currency' => 'required|string|in:INR,USD',
            'coupon_code' => 'nullable|string|exists:coupons,code|size:255'
        ]);


        $user = $request->user();


        $package = Package::findOrFail($request->package_id);

        $coupon = $this->checkIfCouponIsApplicable($package, $request->coupon_code);

        if ($coupon) {
            $isValidCoupon = !$this->isValidCoupon($coupon, $request->currency);
            if (!$isValidCoupon) {
                return $isValidCoupon;
            }
        }



        if (is_null($request->type)) {
            $already_assigned = $this->checkIfUserAlreadyAssigned($user);
            if ($already_assigned) {
                return response()->json([
                    'message' => 'You had a previous subscription. Do you want to renew it?',
                    'data' => $already_assigned
                ], 200);
            }
        }

        $order =   $this->createSubscriptionOrder($user, $package, $request->currency, $request->type, $coupon, $request->form_data);
        dispatch(new RazorpayOrderInspectorJob($order))->delay(now()->addMinutes(5));
        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order
        ], 200);
    }





    /**
     * @param Package $package
     * @param User $user
     * @param string $currency INR or USD
     * @param Coupon|bool $coupon
     * @return RazorpayOrder
     * 
     * This function creates a new order for the user and returns the order object
     * 
     */



    public function createSubscriptionOrder(User $user, Package $package, string $currency, ?string $type, Coupon|bool $coupon = false, array $form_data): RazorpayOrder
    {

        ['price' => $price, 'discount' => $discount, 'final' => $final] = $this->calculatePrice($package, $coupon, $currency);
        $rp_order = $this->rzPay->order->create([
            'receipt' => 'curvicare_order_' . uniqid(),
            'amount' =>  $final * 100,
            'currency' => $currency,
            'notes' => [
                'package_name' => $package->name,
                'package_id' => $package->id,
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'price' => $price,
                'discount' => $discount,
                'coupon_code' => $coupon ? $coupon->code : null,
                'tax' => 0,
                'payable_amount' => $final,
                'type' => $type,
            ]
        ]);


        $order = RazorpayOrder::create([
            'order_id' => $rp_order->id,
            'user_id' => $user->id,
            'package' => json_encode($package),
            'currency' => $currency,
            'type' => $type ? $type : 'new',
            'amount' => $price,
            'discount' => $discount,
            'coupon_code' => $coupon ? $coupon->code : null,
            'tax' => 0,
            'payable_amount' => $final,
            'form_data' => json_encode($form_data),
            'status' => 'pending',
        ]);

        return $order;
    }




    /**
     * @param Package $package
     * @param string $coupon_code
     * @param string $currency INR or USD Default INR
     * @return Coupon|bool
     * 
     * This function checks if the coupon is applicable for the package
     * and returns the coupon object if it is applicable else returns false
     */


    public function calculatePrice(Package $package, Coupon|bool $coupon = false, string $currency = 'INR'): array
    {
        if (!$coupon || $coupon->currency != $currency) {
            $package_price = PackagePrice::where('package_id', $package->id)
                ->where('currency', $currency)
                ->firstOr(
                    function () {
                        throw new ValidationException('No price found for given currency');
                    }
                )->price;
            return [
                'price' =>  $package_price,
                'discount' => 0,
                'final' =>  $package_price
            ];
        }

        if ($coupon->discount_type == 'percentage') {
            $package_price = PackagePrice::where('package_id', $package->id)
                ->where('currency', $currency)
                ->firstOr(function () {
                    throw new ValidationException('No price found for given currency');
                })->price;
            return [
                'price' => $package_price,
                'discount' => $package_price * ($coupon->value / 100),
                'final' => $package_price - ($package_price * ($coupon->value / 100))
            ];
        } else {
            $package_price = PackagePrice::where('package_id', $package->id)
                ->where('currency', $currency)
                ->firstOr(function () {
                    throw new ValidationException('No price found for given currency');
                })->price;
            return [
                'price' => $package_price,
                'discount' => $coupon->discount_value,
                'final' => $package_price - $coupon->discount_value
            ];
        }
    }



    /*
    |--------------------------------------------------------------------------
    | Helper Functions
    |--------------------------------------------------------------------------
    |
    |The following functions are helper functions for the class
    |
    */




    /**
     * 
     * @param User $user
     * @return bool|DieticianAssignment
     * 
     * This function checks if the user has been assigned a dietician in the last 5 days
     * If yes, it returns the assignment details
     * If no, it returns false
     * 
     */

    public function checkIfUserAlreadyAssigned(User $user): bool|DieticianAssignment
    {
        $assignment = $user->assignments()->where('expiry', '>=', now()->subDays(5))
            ->where('status', '!=', 'cancelled')
            ->latest()->first();

        if ($assignment) {
            return $assignment;
        } else {
            return false;
        }
    }



    /**
     * @param Package $package
     * @param string $coupon_code
     * @return bool|Coupon
     * 
     * This function checks if the coupon is applicable for the package
     * and returns the coupon object if it is applicable else returns false
     */

    public function checkIfCouponIsApplicable(Package $package, string $coupon_code = null): bool|Coupon
    {
        if (is_null($coupon_code)) {
            return false;
        }
        $coupon = $package->coupons()->where('code', $coupon_code)->first();
        if ($coupon) {
            return $coupon;
        } else {
            return false;
        }
    }



    public function isValidCoupon(Coupon $coupon, string $currency): bool|JsonResponse
    {
        if ($coupon->start_date > now() || $coupon->end_date < now()) {
            return response()->json([
                'message' => 'Coupon is not valid'
            ], 422);
        }
        if ($coupon->currency != $currency) {
            return response()->json([
                'message' => 'Coupon is not valid for ' . $currency . ' currency'
            ], 422);
        }

        return true;
    }
}
