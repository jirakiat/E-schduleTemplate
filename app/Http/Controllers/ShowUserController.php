<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowUserController extends Controller
{
    public function index(Request $request){
        if ($request->session()->has('full_name','ldap_username','portrait_image')) {
            $user = DB::table('users')
                ->join('affiliates', 'users.user_id', '=', 'affiliates.user_id')
                ->select('users.*', 'affiliates.*')
                ->distinct()->get()->toArray();
            $data = [
                "user" =>  $user,
            ];
            return view('ShowUser',$data);
        }else {
            return redirect(url('/signin'));
        }
    }
}
