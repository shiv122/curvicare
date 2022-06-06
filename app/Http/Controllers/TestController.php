<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function createLink(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $res = $api->paymentLink->create(array(
            'upi_link' => true, 'amount' => $request->amount * 100, 'currency' => 'INR', 'accept_partial' => false, 'description' => 'For XYZ purpose', 'customer' => array(
                'name' => $request->name,
                'email' => $request->email, 'contact' => '+91' . $request->phone,
            ),  'notify' => array('sms' => true, 'email' => true),
            'reminder_enable' => true, 'notes' => array('policy_name' => 'Test')
        ));

        return $res->id;
    }

    public function getValue(Request $request)
    {
        return [$request, url('/')];
    }
}
