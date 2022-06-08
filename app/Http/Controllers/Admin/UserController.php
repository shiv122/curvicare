<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function add()
    {
        return view('content.forms.add-user');
    }


    public function store(Request $request)
    {
    }
}
