<?php

namespace App\Http\Controllers\Admin;

use App\Events\TestEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function home()
    {
        $pageConfigs = ['pageHeader' => false, 'has_chart' => true];
        return view('content.dashboard', ['pageConfigs' => $pageConfigs]);
    }


    public function test()
    {
        return view('content.test');
    }


    public function send(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $id = $request->id;

        try {
            $ev =  event(new TestEvent('Hiii', $id));
            return json_encode($ev);
        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'error' => $e->getMessage()]);
        }
    }
}
