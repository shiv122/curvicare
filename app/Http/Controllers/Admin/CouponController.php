<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CouponDataTable;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(CouponDataTable $table)
    {
        $pageConfigs = ['has_table' => true];
        return $table->render('content.tables.metadata.coupons', compact('pageConfigs'));
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
            'table' => 'coupon-table',
        ]);
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return response($coupon);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:coupons,title,' . $request->id,
            'code' => 'required|unique:coupons,code,' . $request->id,
            'is_amount' => 'required|in:on,off',
            'is_rupees' => 'required|in:on,off',
            'amount' => 'required_if:is_amount,on|numeric',
            'percent' => 'required_if:is_amount,off|numeric',
            'id' => 'required|exists:coupons,id',
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

        Coupon::where('id', $request->id)->update([
            'title' => $request->title,
            'code' => $request->code,
            'discount_type' => $discount_type,
            'discount_value' => $request->amount ?? $request->percent,
            'currency' => $currency,
            'expiry_date' => $expiry,
            'start_date' => $start_date,
        ]);

        return response([
            'header' => 'Updated',
            'message' => 'Coupon updated successfully',
            'table' => 'coupon-table',
        ]);
    }




    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:coupons,id',
            'status' => 'required|in:active,blocked',
        ]);
        Coupon::where('id', $request->id)
            ->update(['status' => $request->status]);

        return response([
            'header' => 'Updated',
            'message' => 'Coupon status updated successfully',
            'table' => 'coupon-table',
        ]);
    }
}
