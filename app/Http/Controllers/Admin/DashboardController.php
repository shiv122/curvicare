<?php

namespace App\Http\Controllers\Admin;

use App\Events\User\BasicUserEvent;
use App\Http\Controllers\Controller;
use App\Models\Dietician;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function home()
    {
        $pageConfigs = ['pageHeader' => false, 'has_chart' => true];

        $total_users = User::count();
        $new_users = User::where('created_at', '>=', now()->subDays(7))->count();

        $subscribed_users = User::whereHas('subscriptions')->count();

        $active_subscriptions = User::whereHas('subscriptions', function ($query) {
            $query->where('end_date', '>=', now());
        })->count();

        $expired_subscriptions = User::whereHas('subscriptions', function ($query) {
            $query->where('end_date', '<', now());
        })->count();


        // $total_profit 


        return view('content.dashboard', compact(
            'pageConfigs'
        ));
    }


    public function test()
    {


        broadcast(new BasicUserEvent(
            user: User::find(2),
            from: null,
            data: ['test' => 'test'],
            event: 'notification'
        ));
    }


    public function send(Request $request)
    {
    }
}
