<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\user_statuses;
use Illuminate\Http\Request;

class UserformController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('full_name', 'ldap_username', 'portrait_image')) {
            if ($request->session()->get('statususer') == 1) {
                $status = user_statuses::all();
                $user=User::join('user_statuses','user_statuses.status_id','=','users.status_id')
                    ->select('user_statuses.*','users.*')->get();
                $data = [
                    'status' => $status,
                    'user' => $user,
                ];
                return view('Ueserform', $data);
            } else {
                return redirect('/dashboard')->with('error', 'ไม่สามารถเข้าถึงได้!!!');
            }

        }
        else {
            return redirect(url('/signin'));
        }
    }

    public function insert(Request $request)
    {
        $checkuser = User::where('users_ldap', '=', $request->input('user_id'))->first();
        if ($checkuser == null) {
            $objuser = new User();
            $objuser->users_ldap = $request->input('user_id');
            $objuser->users_name = $request->input('fullname');
            $objuser->status_id = $request->input('status_id');
            $objuser->save();
        } else
            $id = $checkuser->user_id;
        $objuser = User::find($id);
        $objuser->status_id = $request->input('status_id');
        $objuser->save();

        return redirect(url('/userform'));

    }

    public function insertstatus(Request $request)
    {
        $objstatus = new user_statuses();
        $objstatus->status_name = $request->input('users_status');
        $objstatus->save();
        return redirect(url('/createstatus'));
    }

    public function createstatus(Request $request)
    {
        if ($request->session()->has('full_name', 'ldap_username', 'portrait_image')) {
            if ($request->session()->get('statususer') == 1) {

                return view('CreateStatus');
            } else {
                return redirect('/dashboard')->with('error', 'ไม่สามารถเข้าถึงได้!!!');
            }

        }
        else {
            return redirect(url('/signin'));
        }
    }
    public function permissionupdate(Request $request){
        $objuser = User::find($request->input('users_id'));
        $objuser->status_id = $request->input('status_id');
        $objuser->save();
        return redirect(url('/userform'));
    }
    public function permissiondelete(Request $request){
        $objuser = User::find($request->input('users_id'));
        $objuser->status_id = null;
        $objuser->save();
        return redirect(url('/userform'));
    }
}
