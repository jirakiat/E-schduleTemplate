<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAddTaskController extends Controller
{
    public function index(Request $request){
        if ($request->session()->has('full_name','ldap_username','portrait_image')) {
            return view('AdminAddTask');
        }else {
            return redirect(url('/signin'));
        }
    }
}
