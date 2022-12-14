<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VersionControl;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function versionControl()
    {
        $version = VersionControl::first();
        return view('content.forms.app-setting', compact('version'));
    }


    public function storeVersionControl(Request $request)
    {
        $request->validate([
            'android_version' => 'required|numeric',
            'ios_version' => 'required|numeric',
            'android_force_update' => 'nullable|in:on',
            'ios_force_update' => 'nullable|in:on',
        ]);

        VersionControl::updateOrCreate(
            ['id' => 1],
            [
                'android_version' => $request->android_version,
                'ios_version' => $request->ios_version,
                'android_force_update' => $request->android_force_update ? 1 : 0,
                'ios_force_update' => $request->ios_force_update ? 1 : 0,
            ]
        );

        return response()->json([
            'message' => 'App Setting Updated Successfully',
            'status' => 'success',
        ]);
    }
}
