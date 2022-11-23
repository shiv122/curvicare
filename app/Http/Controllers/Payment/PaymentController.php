<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function paymentPage($id)
    {
        return view('payment.payment', compact('id'));
    }

    public function storePayment(Request $request)
    {
        return $request->all();
    }


    public function charge(String $product, $price)
    {
        $user = User::find(2);
        return view('payment.pay', [
            'user' => $user,
            'intent' => $user->createSetupIntent(),
            'product' => $product,
            'price' => $price
        ]);
    }
}
