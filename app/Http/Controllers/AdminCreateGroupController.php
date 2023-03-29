<?php

namespace App\Http\Controllers;

use App\Models\group;
use App\Models\GroupShare;
use App\Models\User;
use GuzzleHttp\Promise\RejectedPromise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCreateGroupController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('full_name', 'ldap_username', 'portrait_image')) {
            if ($request->session()->get('statususer') == 1 or $request->session()->get('statususer') == 2) {
                $datagroup = DB::table('groups')
                    ->leftJoin('users', 'groups.create_users_ldap', '=', 'users.users_ldap')
                    ->select('groups.*', 'users.*')
                    ->where('users.users_ldap', $request->session()->get("ldap_username"))
                    ->get();
                $groupshare = DB::table('group_shares')
                    ->Join('groups', 'group_shares.group_id', '=', 'groups.group_id')
                    ->select('groups.*', 'group_shares.*')
                    ->get()->toArray();
                $user = User::all();
                $data = [
                    'datagroup' => $datagroup,
                    'groupshare' => $groupshare
                ];
                $datauser = [
                    'user' => $user
                ];
                $datagroupshare = [
                    'groupshare' => $groupshare
                ];
                return view('AdminCreateGroup', $data, $datauser, $datagroupshare);
            }  else {
                return redirect('/dashboard')->with('error', 'ไม่สามารถเข้าถึงได้!!!');
            }
        }else {
            return redirect(url('/signin'));
        }
    }

    public function insert(Request $request)
    {
        $objgroup = new group();
        $objgroup->group_name = $request->input('name');
        $objgroup->group_description = $request->input('description');
        $objgroup->group_status = $request->input('status');
        $objgroup->create_users_ldap = $request->session()->get("ldap_username");
        $objgroup->save();

        $groupscheck = group::where('group_name','=',$request->input('name'))
            ->where('group_description','=',$request->input('description'))
            ->where('create_users_ldap','=',$request->session()->get("ldap_username"))
            ->first();
        $objgroupshare = new GroupShare();
        $objgroupshare->users_ldap =$request->session()->get('ldap_username');
        $objgroupshare->group_id =$groupscheck->group_id;
        $objgroupshare->save();
        return redirect(url('/admincreategroup'));
    }

    public function adduser(Request $request)
    {
        $checkuser=User::where('users_ldap','=',$request->input('user_id'))->first();
        if ($checkuser==null){
            $objuser = new User();
            $objuser->users_name=$request->input('fullname');
            $objuser->users_ldap=$request->input('user_id');
            $objuser->save();
        }
        $check = GroupShare::join('users','users.users_ldap','=','group_shares.users_ldap')
            ->select('users.*','group_shares.*')
            ->get();
        foreach ($check as $checks) {
            if ($checks->users_ldap == $request->input('user_id') && $checks->group_id == $request->input('group_id')) {
                return redirect('/admincreategroup')->with('error', 'เพิ่มผู้ใช้ได้เนื้องจาก '.$checks->users_name.' อยู่ในกลุ่มอยู่แล้ว!!!');
            }
        }
        $objgroupshare = new GroupShare();
        $objgroupshare->users_ldap = $request->input('user_id');
        $objgroupshare->group_id = $request->input('group_id');
        $objgroupshare->save();
        return redirect(url('/admincreategroup'));
    }

    public function deletegroup(Request $request, $id)
    {
        group::where("group_id", $id)->delete();
        return redirect(url('/admincreategroup'));
    }

    protected function getData(Request $request)
    {
        $html = '';
        $groupshare = GroupShare::Join('groups', 'group_shares.group_id', '=', 'groups.group_id')
            ->join('users', 'users.users_ldap', '=', 'group_shares.users_ldap')
            ->where('group_shares.group_id', $request->group_id)
            ->select('groups.*', 'group_shares.*', 'users.*')
            ->get();

        foreach ($groupshare as $key => $group) {
            $html .= "<tr><td>" . ($key + 1) . "</td><td>$group->users_email</td></tr>";
        }

        return response()->json(
            ['data' => $groupshare, 'html' => $html]
        );
    }

    public function update(Request $request)
    {
        $objgroups = group::find($request->input('id'));
        $objgroups->group_name = $request->input('names');
        $objgroups->group_description = $request->input('description');
        $objgroups->group_status = $request->input('status');
        $objgroups->save();
        return redirect(url('/admincreategroup'));
    }

    public function deleteuser(Request $request, $id)
    {
        GroupShare::where("id", $id)->delete();
        return redirect(url('/admincreategroup'));
    }
}
