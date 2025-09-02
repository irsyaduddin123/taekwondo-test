<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewUserController extends Controller
{
    //
    public function index(){
        return view('user.dashboard-user.index');
    }
}
