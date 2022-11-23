<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{



    public function index(UserDataTable $table)
    {
        $pageConfigs = ['has_table' => true];
        return $table->render('content.tables.users', compact('pageConfigs'));
    }

    public function add()
    {
        // return view('content.forms.add-user');

        return view('errors.work-in-progress');
    }


    public function store(Request $request)
    {
    }


    public function view($id)
    {
        $user =  User::with([
            'user_data' => ['user_goal', 'user_activity'],
            'moods' => ['mood'],
            'water',
            'steps',
            'medical_conditions' => ['condition'],

        ])->findOrFail($id);


        return view('content.pages.user-details', compact('user'));
    }
}
