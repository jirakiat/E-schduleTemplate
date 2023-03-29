<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\AffiliateShare;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddAffiliateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('full_name', 'ldap_username', 'portrait_image')) {
            if ($request->session()->get('statususer') == 1 or $request->session()->get('statususer') == 2 ) {
                $datauser = User::all();
                $affiliate = Affiliate::where('affiliates_status', '=', 1)->where('users_ldap', '=', $request->session()->get('ldap_username'))->get();
                $data = [
                    "affiliate" => $affiliate,
                ];
                $datauser = [
                    "datauser" => $datauser,
                ];
                return view('AffiliateAdd', $data, $datauser);
            } else {
                return redirect('/dashboard')->with('error', 'ไม่สามารถเข้าถึงได้!!!');
            }
        }
        else {
            return redirect(url('/signin'));
        }
    }

    public function adduser(Request $request)
    {
        $checkuser = User::where('users_ldap', '=', $request->input('user_id'))->first();
        if ($checkuser == null) {
            $objuser = new User();
            $objuser->users_name = $request->input('fullname');
            $objuser->users_ldap = $request->input('user_id');
            $objuser->save();
        }
        $check = AffiliateShare::join('users', 'users.users_ldap', '=', 'affiliate_shares.users_ldap')
            ->select('users.*', 'affiliate_shares.*')
            ->where('affiliate_shares.affiliate_id', '=', $request->input('affiliate_id'))->get();
        foreach ($check as $checks) {
            if ($checks->users_ldap == $request->input('user_id')) {
                return redirect('/affiliateadd')->with('error', 'เพิ่มผู้ใช้ได้เนื้อง '.$checks->users_name.' อยู่ในหน่วยงานอยู่แล้ว!!!');
            }
        }
        $objAffiliateshare = new AffiliateShare();
        $objAffiliateshare->users_ldap = $request->input('user_id');
        $objAffiliateshare->affiliate_id = $request->input('affiliate_id');
        $objAffiliateshare->save();
        return redirect('/affiliateadd');
    }

    protected function getData(Request $request)
    {
        $html = '';
        $Affiliateshare = AffiliateShare::join('affiliates', 'affiliates.affiliate_id', '=', 'affiliate_shares.affiliate_id')
            ->join('users', 'users.users_ldap', '=', 'affiliate_shares.users_ldap')
            ->select('affiliate_shares.*', 'users.*', 'affiliates.*')
            ->where('affiliate_shares.affiliate_id', $request->affiliate_id)
            ->get();
        return response()->json(
            ['data' => $Affiliateshare, 'html' => $html]
        );
    }

    public function deleteuser(Request $request, $id)
    {
        AffiliateShare::where("affiliate_shares_id", $id)->delete();
        return redirect(url('/affiliateadd'));
    }
}
