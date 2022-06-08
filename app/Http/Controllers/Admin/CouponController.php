<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function add()
    {
        return view('content.forms.add-coupon');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'code' => 'required|unique:coupons',
            'is_amount' => 'required|in:on,off',
            'is_rupees' => 'required|in:on,off',
            'amount' => 'required_if:is_amount,on|numeric',
            'percent' => 'required_if:is_amount,off|numeric',
        ]);

        $discount_type = 'percentage';
        if ($request->is_amount == 'on') {
            $discount_type = 'amount';
        }
        $currency = 'USD';
        if ($request->is_rupees == 'on') {
            $currency = 'INR';
        }
        $expiry = $request->expiry;
        if (empty($expiry)) {
            $expiry = now()->addDays(365);
        }
        $start_date = $request->start_date;
        if (empty($start_date)) {
            $start_date = now();
        }


        Coupon::create([
            'title' => $request->title,
            'code' => $request->code,
            'discount_type' => $discount_type,
            'discount_value' => $request->amount ?? $request->percent,
            'currency' => $currency,
            'expiry_date' => $expiry,
            'start_date' => $start_date,
        ]);

        return response([
            'header' => 'Created',
            'message' => 'Coupon added successfully',
            'status' => 'success',
        ]);
    }

    public function view()
    {
    }

    public function status(Request $request)
    {
    }
}
