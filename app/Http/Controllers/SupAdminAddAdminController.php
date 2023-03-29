<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupAdminAddAdminController extends Controller
{
    public function index(Request $request){
        if ($request->session()->has('full_name','ldap_username','portrait_image')) {
            return view('SupAdminAddAdmin');
        }else {
            return redirect(url('/signin'));
        }

    }
}
