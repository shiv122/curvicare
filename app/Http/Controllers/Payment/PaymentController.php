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

        return  $user->charge(
            100,
            'tok_visa',
            [
                'description' => 'Test Charge',
                'receipt_email' => $user->email,
                'metadata' => [
                    'product' => $product,
                    'price' => $price,
                ],
            ]
        );
        // return view('payment.pay', [
        //     'user' => $user,
        //     'intent' => $user->createSetupIntent(),
        //     'product' => $product,
        //     'price' => $price
        // ]);
    }


    public function processPayment(Request $request, String $product, $price)
    {
        $user = User::find(2);
        $paymentMethod = $request->input('payment_method');
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        try {
            $ch = $user->charge($price * 100, $paymentMethod);
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }

        return $ch;
    }
}
