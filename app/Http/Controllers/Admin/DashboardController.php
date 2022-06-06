<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function home()
    {
        $pageConfigs = ['pageHeader' => false, 'has_chart' => true];
        return view(
            'content.dashboard'
        );
    }
}
