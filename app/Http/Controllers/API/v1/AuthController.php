<?php

namespace App\Http\Controllers\API\v1;

use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function genOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|size:10'
        ]);

        $otp = str_pad(rand(1, 999999), 6, "0");
        Otp::where('phone', $request->phone)->delete();
        return  Otp::create([
            'otp' => $otp,
            'phone' => $request->phone,
            'expire_at' => Carbon::now()->addMinutes(5),
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|size:10',
            'otp' => 'required|size:6',
            'device_id' => 'required|string|size:36'
        ]);
        $otp = Otp::where([
            'phone' => $request->phone,
            'otp' => $request->otp,
        ])->first();


        if (empty($otp)) {
            throw ValidationException::withMessages([
                'otp' => ['The provided otp are incorrect.'],
            ]);
        } elseif ($otp->attempt >= 5) {
            $otp->delete();
            throw ValidationException::withMessages([
                'attempt' => ['Maximum attempt of 5 exceeded.'],
            ]);
        } elseif (now() > $otp->expire_at) {
            $otp->delete();
            throw ValidationException::withMessages([
                'expired' => ['Otp expired ' . now()->diffInMinutes($otp->expire_at) . ' minutes ago'],
            ]);
        } elseif ($otp->used == '1') {
            $otp->delete();
            throw ValidationException::withMessages([
                'used' => ['Otp already used.'],
            ]);
        }

        $user = User::where('phone', $request->phone)->first();

        if (empty($user)) {
            $response =  DB::transaction(function () use ($request, $otp) {
                $user =   User::create([
                    'phone' => $request->phone,
                    'device_id' => $request->device_id,
                ]);
                $otp->used = '1';
                $otp->save();
                return response(['msg' => 'success', 'user' => $user, 'token' => $user->createToken($request->device_id)->plainTextToken]);
            });
        } else {
            $response =  DB::transaction(function () use ($request, $otp) {
                $otp->used = '1';
                $otp->save();
                $user = User::where('phone', $request->phone)->first();
                $user->tokens()->delete();
                $user->device_id = $request->device_id;
                $user->save();
                return response(['msg' => 'success', 'user' => $user, 'token' => $user->createToken($request->device_id)->plainTextToken]);
            });
        }

        return $response;
    }
}
