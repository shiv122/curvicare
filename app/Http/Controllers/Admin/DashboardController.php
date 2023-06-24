<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Template;
use App\Models\Dietician;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\DB;
use App\Events\User\BasicUserEvent;
use App\Models\RazorpayTransaction;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function home()
    {
        $pageConfigs = ['pageHeader' => false, 'has_chart' => true];
        $f_date = now()->subDays(500)->format('Y-m-d');


        $total_users = User::count();
        $new_users = User::where('created_at', '>=', now()->subDays(7))->count();

        $subscribed_users = User::whereHas('subscriptions')->count();


        $total_subscription = UserSubscription::count();

        $active_subscriptions = User::whereHas('subscriptions', function ($query) {
            $query->where('end_date', '>=', now());
        })->count();

        $expired_subscriptions = User::whereHas('subscriptions', function ($query) {
            $query->where('end_date', '<', now());
        })->count();

        $total_earings_inr = RazorpayTransaction::where('currency', 'INR')->sum('paid_amount');
        $total_earings_usd = RazorpayTransaction::where('currency', 'USD')->sum('paid_amount');

        $total_dieticians = Dietician::count();

        $total_recipe = Recipe::count();

        $total_templates = Template::count();

        $total_blogs = Blog::count();


        $paid_recipe = Recipe::where('is_paid', 'yes')->count();


        $users =  User::whereDate('created_at', '>=', $f_date)
            ->select(DB::raw('DATE_FORMAT(DATE(created_at),"%Y-%m-%d") as date'), DB::raw('count(*) as count'))
            ->where('isAdmin', '0')
            ->groupBy('date')
            ->get();

        $revenue = RazorpayTransaction::whereDate('created_at', '>=', $f_date)
            ->select(DB::raw('DATE_FORMAT(DATE(created_at),"%Y-%m-%d") as date'), DB::raw('sum(paid_amount) as amount'))
            ->groupBy('date')
            ->get();

        $user_count = $users->pluck('count')->toArray();
        $user_date = $users->pluck('date')->toArray();

        $revenue_count = $revenue->pluck('amount')->toArray();
        $revenue_date = $revenue->pluck('date')->toArray();


        return view('content.dashboard', compact(
            'pageConfigs',
            'total_users',
            'new_users',
            'subscribed_users',
            'active_subscriptions',
            'expired_subscriptions',
            'total_earings_inr',
            'total_earings_usd',
            'total_dieticians',
            'total_recipe',
            'total_templates',
            'paid_recipe',
            'total_subscription',
            'total_blogs',
            'user_count',
            'user_date',
            'revenue_count',
            'revenue_date'
        ));
    }


    public function test()
    {
    }


    public function send(Request $request)
    {
    }
}
