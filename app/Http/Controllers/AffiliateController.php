<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\AffiliateShare;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AffiliateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('full_name', 'ldap_username', 'portrait_image')) {
            if ($request->session()->get('statususer') == 1) {
                $datauser = User::all();
                $affiliate = DB::table('affiliates')
                    ->join('users', 'users.users_ldap', '=', 'affiliates.users_ldap')
                    ->where('affiliates.affiliates_status', '=', 1)
                    ->select('affiliates.*', 'users.*')
                    ->get();
                $data = [
                    "affiliate" => $affiliate,
                ];
                $datauser = [
                    "datauser" => $datauser,
                ];
                return view('affiliate', $data, $datauser);
            }
            else {
                return redirect('/dashboard')->with('error', 'ไม่สามารถเข้าถึงได้!!!');
            }
        }
        else {
            return redirect(url('/signin'));
        }
    }

    public function update(Request $request)
    {
        $objAffiliate = Affiliate::find($request->input('id'));
        $objAffiliate->affiliate_name = $request->input('names');
        $objAffiliate->affiliate_description = $request->input('description');
        $objAffiliate->save();
        return redirect('affiliate');
    }

    public function delete(Request $request, $id)
    {
        Affiliate::where("affiliate_id", $id)->delete();
        return redirect('affiliateadd');
    }

    public function updateadmin(Request $request)
    {
        $objAffiliate = Affiliate::find($request->input('id'));
        $objAffiliate->users_ldap = $request->input('user_id');
        $objAffiliate->save();
        $objAffiliateshare = new AffiliateShare();
        $objAffiliateshare->users_ldap = $request->input('user_id');
        $objAffiliateshare->affiliate_id = $request->input('id');
        $objAffiliateshare->save();
        return redirect('affiliate');
    }

    public function affiliatedelete(Request $request)
    {
        $objAffiliate = Affiliate::find($request->input('affiliate_id'));
        $objAffiliate->affiliates_status = 2;
        $objAffiliate->save();
        return redirect('affiliate');
    }

    public function affiliateshow(Request $request, $id)
    {
        $affiliateevent = DB::table('event_affiliates')
            ->join('events', 'events.events_id', '=', 'event_affiliates.events_id')
            ->join('affiliates', 'affiliates.affiliate_id', '=', 'event_affiliates.affiliate_id')
            ->where('event_affiliates.events_id', '=', $id)
            ->select('events.*', 'event_affiliates.*', 'affiliates.*')
            ->limit('1')
            ->get();
        $assign = DB::table('assignees')->where('users_ldap', '=', $request->session()->get('ldap_username'))->where('assignees_status', '=', 0)->count('assignees_id');
        $x = array();
        $y = 0;
        foreach ($affiliateevent as $affiliateevents) {
            $x[$y] = $affiliateevents;
            $x[$y]->thaidatestart = $this->formatDateThat($affiliateevents->start_event);
            $x[$y]->thaidateend = $this->formatDateThat($affiliateevents->end_event);
            $x[$y]->thaivertifytime = $this->formatDateThat($affiliateevents->event_affiliate_time);
            $y = $y + 1;
        }
        $data = [
            'assign' => $assign,
            'affiliateevent' => $affiliateevent,
        ];
        return view('affiliateshow', $data);
    }

    public function formatDateThat($strDate)
    {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $monthTH = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear $strHour:$strMinute น";
    }
}
