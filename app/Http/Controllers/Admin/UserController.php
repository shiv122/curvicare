<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addUser()
    {
        return view('content.forms.add-user');
    }


    public function storeUser(Request $request)
    {
    }
}
