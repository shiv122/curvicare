<?php

namespace App\Http\Controllers\Admin;

use Storage;
use Carbon\Carbon;
use App\Mail\Admin\Error;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MiscellaneousController extends Controller
{
    public function sendReport(Request $request)
    {
        $request->validate([
            'error' => 'required',
        ]);

        $path = 'errors/error-' . time() . '.json';

        $file = Storage::put($path, json_encode($request->error, true));

        // clock()->info("User {$file} logged in!");

        $details = ['Page' => $request->from, 'From' => 'panel', 'Datetime' => Carbon::now()];
        $mail = \Mail::to('shivesh.appdid@gmail.com')->send(new Error($details, $path));
        return response(['status' => 'success', 'message' => 'Report sent successfully']);
    }

    public function workInProgress()
    {
        return view('errors.work-in-progress');
    }
}
