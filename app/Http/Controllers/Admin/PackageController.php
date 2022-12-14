<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\Models\PackageCoupon;
use App\Models\PackageFeature;
use Illuminate\Support\Facades\DB;
use App\DataTables\PackageDataTable;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    public function add()
    {
        $coupons = Coupon::active()->get();
        return view('content.forms.add-package', compact('coupons'));
    }


    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'title' => 'required|string',
            'price_in_rupees' => 'required|numeric',
            'price_in_dollar' => 'required|numeric',
            'duration' => 'required|numeric',
            'coupon.*' => 'nullable|exists:coupons,id',
            'terms_and_conditions' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'features.*.*' => 'required|string',

        ]);


        return  DB::transaction(function () use ($request) {
            $image = FileUploader::uploadFile($request->file('image'), 'images/packages');

            $package = Package::create([
                'title' => $request->title,
                'image' => $image,
                'duration' => $request->duration,
                'terms' => $request->terms_and_conditions,
            ]);



            $package->prices()->create([
                'currency' => "USD",
                'price' => $request->price_in_dollar,
            ]);
            $package->prices()->create([
                'currency' => "INR",
                'price' => $request->price_in_rupees,
            ]);


            $features = [];
            foreach ($request->features as $key => $ft) {
                $features[] = [
                    'title' => $ft['features'],
                    'package_id' => $package->id,
                    'created_at' => now(),
                ];
            }
            PackageFeature::insert($features);


            $coupons = [];

            if ($request->coupon) {
                foreach ($request->coupon as $key => $coupon) {
                    $coupons[] = [
                        'coupon_id' => $coupon,
                        'package_id' => $package->id,
                        'created_at' => now(),
                    ];
                }

                PackageCoupon::insert($coupons);
            }



            return response([
                'message' => 'Package added successfully',
                'package' => $package,
                'status' => 'success',
            ]);
        });
    }

    public function viewPackage(PackageDataTable $table)
    {
        $pageConfigs = ['has_table' => true, 'has_sweetAlert' => true];
        //for filter use with
        // $table->with('id', 1);
        return $table->render('content.tables.packages', compact('pageConfigs'));
    }


    public function show($id)
    {
        $package = Package::with(['prices', 'coupons.coupon', 'features'])->findOrFail($id);

        return view('content.pages.package-details', compact('package'));
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:packages,id',
            'status' => 'required|in:0,1'
        ]);
        $status = ['inactive', 'active'];
        Package::find($request->id)->update([
            'status' => $status[$request->status]
        ]);

        return response(['status' => 'success', 'header' => 'Updated', 'message' => 'Package status updated successfully']);
    }
}
