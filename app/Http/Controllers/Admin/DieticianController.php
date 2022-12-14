<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\Dietician;
use App\Models\Expertise;
use App\Models\DieticianKyc;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use Yajra\DataTables\DataTables;
use App\Models\DieticianExpertise;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DieticianBankDetails;
use Illuminate\Support\Facades\Hash;
use App\DataTables\DieticianDataTable;
use App\Mail\Dietician\DieticianPassword;

class DieticianController extends Controller
{
    public function add()
    {
        $expertise = Expertise::active()->get();
        return view('content.forms.add-dietician', compact('expertise'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:dieticians|max:255',
            'phone' => 'required|required|unique:dieticians',
            'address' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bank_name' => 'required|string',
            'account_number' => 'required|numeric',
            'ifsc_code' => 'required|string',
            'branch_name' => 'required|string',
            'aadhar_card_number' => 'numeric|required_without:pan_card_number|nullable',
            'pan_card_number' => 'numeric|required_without:aadhar_card_number|nullable',
            'aadhar_card_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required_without:pan_card_image|nullable',
            'pan_card_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required_without:aadhar_card_image|nullable',
            'gender' => 'required|in:male,female,other',
            'location' => 'required|string',
            'username' => 'required|unique:dieticians',
            'password' => 'nullable|string|min:8',
            'expertise' => 'required|array',
            'expertise.*' => 'required|numeric',
            'for' => 'required|string|in:local,abroad,global',
        ]);

        $image = FileUploader::uploadFile($request->file('image'), 'images/dietician');
        $pass = $request->password ? $request->password : Helper::makePassword($request->name);

        DB::beginTransaction();

        $dietician =  Dietician::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $image,
            'gender' => $request->gender,
            'password' => Hash::make($pass),
            'username' => $request->username,
            'for' => $request->for,
        ]);
        $exp_data = [];
        foreach ($request->expertise as $key => $value) {
            $exp_data[] = [
                'dietician_id' => $dietician->id,
                'expertise_id' => $value,
                'created_at' => now(),
            ];
        }
        DieticianExpertise::insert($exp_data);

        DieticianBankDetails::create([
            'dietician_id' => $dietician->id,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'branch_name' => $request->branch_name,
            'ifsc_code' => $request->ifsc_code

        ]);
        $pan_card_image = null;
        $aadhar_card_image = null;
        if ($request->hasFile('pan_card_image')) {
            $pan_card_image = FileUploader::uploadFile($request->file('pan_card_image'), 'images/dietician/key');
        }
        if ($request->hasFile('aadhar_card_image')) {
            $aadhar_card_image = FileUploader::uploadFile($request->file('aadhar_card_image'), 'images/dietician/kyc');
        }
        $certificate = FileUploader::uploadFile($request->file('certificate'), 'images/dietician/certificate');

        DieticianKyc::create([
            'dietician_id' => $dietician->id,
            'pan_card_image' => $pan_card_image,
            'aadhar_card_image' => $aadhar_card_image,
            'aadhar_card_number' => $request->aadhar_card_number,
            'pan_card_number' => $request->pan_card_number,
            'certificate' => $certificate,
        ]);

        DB::commit();


        $details = ['name' => $request->name, 'password' => $pass, 'username' => $request->username, 'reset_link' => '#'];
        $mail = \Mail::to($request->email)->send(new DieticianPassword($details));
        return response(['status' => 'success', 'header' => 'Inserted', 'message' => 'Dietician added successfully', 'mail' => $mail]);
    }

    public function viewDietician(DieticianDataTable $table)
    {
        $pageConfigs = ['has_table' => true, 'has_sweetAlert' => true];
        //for filter use with
        // $table->with('id', 1);
        return $table->render('content.tables.dieticians', compact('pageConfigs'));
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:dieticians,id',
            'status' => 'required|in:0,1'
        ]);
        $status = ['inactive', 'active'];
        Dietician::find($request->id)->update([
            'status' => $status[$request->status]
        ]);

        return response(['status' => 'success', 'header' => 'Updated', 'message' => 'Dietician status updated successfully']);
    }
}
