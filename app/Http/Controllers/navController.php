<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class navController extends Controller
{
    public function index(){
        $datauser=User::all()->where('users_ldap',session('ldap_username'));
        $data=[
           'datauser'=>$datauser,
        ];
        return view('layout.navbar',$data);
}
}
