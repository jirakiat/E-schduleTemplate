<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\AffiliateShare;
use App\Models\User;
use Illuminate\Http\Request;

class SupAdminAddAffiliateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('full_name', 'ldap_username', 'portrait_image')) {
            $datauser = User::all();
            $data = [
                "datauser" => $datauser,
            ];
            return view('SupAdminAddAffiliate', $data);
        } else {
            return redirect(url('/signin'));
        }
    }

    public function insert(Request $request)
    {

        $check = $request->input('user_id');
        $objAffiliate = new Affiliate();
        $objAffiliate->affiliate_name = $request->input('names');
        $objAffiliate->affiliate_description = $request->input('description');
        $objAffiliate->users_ldap = $check;
        $objAffiliate->affiliates_status = 1;
        $objAffiliate->save();
        if (!empty($check)) {
            $checkaffiliate = Affiliate::where('affiliate_name', $request->input('names'))->first();
            $objAffiliateshare = new AffiliateShare();
            $objAffiliateshare->users_ldap = $request->input('user_id');
            $objAffiliateshare->affiliate_id = $checkaffiliate->affiliate_id;
            $objAffiliateshare->save();
            $datauser = User::where('users_ldap', '=', $request->input('user_id'))->first();
            if ($datauser == null) {
                $objuser = new User();
                $objuser->users_ldap = $check;
                $objuser->users_name=$request->input('fullname');
                $objuser->status_id = 2;
                $objuser->save();
            }elseif($datauser !== null){
                $id=$datauser->user_id;
                $objuser = User::find($id);
                $objuser->status_id = 2;
                $objuser->save();
            }
        }


        return redirect(url('/affiliate'));

    }

}
