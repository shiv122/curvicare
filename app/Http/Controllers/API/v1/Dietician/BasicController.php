<?php

namespace App\Http\Controllers\API\v1\Dietician;

use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BasicController extends Controller
{
    public function profile(Request $request)
    {
        return $request->user('dietician');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:512',
            'phone' => 'required|string|size:10',
            'address' => 'required|string|max:3000',
        ]);
        $dietician = $request->user('dietician');
        $dietician->update($request->only(['name', 'phone', 'address']));
        if ($request->hasFile('image')) {
            $dietician->image = FileUploader::uploadFile($request->file('image'), 'images/dieticians', 'dietician');
            $dietician->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Dietician profile updated successfully',
        ]);
    }
}