<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\AffiliateShare;
use App\Models\assignees;
use App\Models\event_affiliates;
use App\Models\event_groups;
use App\Models\Eventassign;
use App\Models\events;
use App\Models\group;
use App\Models\GroupShare;
use App\Models\User;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class AddTaskController extends UserController
{
    public function index(Request $request)
    {
        if ($request->session()->has('full_name', 'ldap_username', 'portrait_image')) {
            $datauser = User::all();
            $data = [
                "datauser" => $datauser,
            ];
            return view('AddTask', $data);
        } else {
            return redirect(url('/signin'));
        }
    }

    public function insert(Request $request)
    {

        if ($request->input("user_id")) {
            $showuser_id = $request->input("user_id");
            $status = 0;
            $checkuser = User::where('users_ldap', '=', $request->input('user_id'))->first();
            if ($checkuser == null) {
                $objuser = new User();
                $objuser->users_name = $request->input('fullname');
                $objuser->users_ldap = $request->input('user_id');
                $objuser->save();
            }
        } else {
            $showuser_id = $request->session()->get("ldap_username");
            $status = 1;
        }
        if ($request->input('affiliate_id')) {
            $status = 5;
        }
        if ($request->input('group_id')) {
            $status = 6;
        }
        date_default_timezone_set("Asia/Bangkok");
        $st_date = new \DateTime($request->input('startdate'));
        $en_date = new \DateTime($request->input('enddate'));
        $st_date->format('Y-m-d H:i:s');
        $en_date->format('Y-m-d H:i:s');
        $objevents = new events();
        $objevents->events_name = $request->input('work');
        $objevents->event_description = $request->input('description');
        $objevents->color = $request->input('colort');
        $objevents->start_event = $st_date;
        $objevents->end_event = $en_date;
        $objevents->events_status = $status;
        $objevents->users_ldap = $showuser_id;
        $objevents->save();
        if($showuser_id!==$request->session()->get("ldap_username")){
            $this->linemessage($showuser_id,'มีผู้ใช้เพิ่มกิจกรรม'
                .'ชื่อกิจรรม'.$request->input('work')
                .'รายละเอียดกิจกรรม :'.$request->input('description')
                .'ดูคลิก https://e-schedule.nsru.ac.th/dashboard');
        }
        if ($request->input('affiliate_id')) {
            $dataaffiliate = AffiliateShare::all()->where('affiliate_id', '=', $request->input('affiliate_id'));
            $dataevent = events::where('start_event', '=', $st_date)
                ->where('events_name', '=', $request->input('work'))
                ->where('event_description', '=', $request->input('description'))
                ->first();
            foreach ($dataaffiliate as $dataaffiliates) {
                $dateaffiliate = new \DateTime;
                $objeventsaffiliate = new event_affiliates();
                $objeventsaffiliate->event_affiliate_time = $dateaffiliate;
                $objeventsaffiliate->events_id = $dataevent->events_id;
                $objeventsaffiliate->affiliate_id = $request->input('affiliate_id');
                $objeventsaffiliate->event_users_ldap = $request->session()->get("ldap_username");
                $objeventsaffiliate->users_ldap = $dataaffiliates->users_ldap;
                $objeventsaffiliate->save();
                $affiliate=Affiliate::where('affiliate_id','=',$request->input('affiliate_id'))->first();
                $this->linemessage($dataaffiliates->users_ldap,'หน่วยงาน '.$affiliate->affiliate_name.' ได้เพิ่มกิจกรรมใหม่'
                    .'ชื่อกิจรรม'.$request->input('work')
                    .'รายละเอียดกิจกรรม :'.$request->input('description')
                    .'ดูคลิก https://e-schedule.nsru.ac.th/main');
            }
        }
        if ($request->input('group_id')) {
            $datagroup = GroupShare::all()->where('group_id', '=', $request->input('group_id'));
            $dataevent = events::where('start_event', '=', $st_date)
                ->where('events_name', '=', $request->input('work'))
                ->where('event_description', '=', $request->input('description'))
                ->first();
            foreach ($datagroup as $datagroups) {
                $dategroup = new \DateTime;
                $objeventgroup = new event_groups();
                $objeventgroup->event_group_time = $dategroup;
                $objeventgroup->events_id = $dataevent->events_id;
                $objeventgroup->group_id = $request->input('group_id');
                $objeventgroup->event_users_ldap = $request->session()->get("ldap_username");
                $objeventgroup->users_ldap = $datagroups->users_ldap;
                $objeventgroup->save();
                $group=group::where('group_id','=',$request->input('group_id'))->first();
                $this->linemessage($datagroups->users_ldap,'กลุ่มงาน '.$group->group_name.' ได้เพิ่มกิจกรรมใหม่'
                    .'ชื่อกิจรรม :'.$request->input('work')
                    .'รายละเอียดกิจกรรม :'.$request->input('description')
                    .'ดูคลิก https://e-schedule.nsru.ac.th/main');
            }
        }
        $taskchaek = events::where('events_name', $request->input('work'))
            ->where('events_name', $request->input('work'))
            ->where('event_description', $request->input('description'))
            ->where('events_status', 0)->first();
        if ($taskchaek != null) {
            $dateassign = new \DateTime;
            $dataassign = new assignees();
            $dataassign->assignees_status = 0;
            $dataassign->assignees_time = $dateassign;
            $dataassign->events_id = $taskchaek->events_id;
            $dataassign->creat_users_ldap = $request->session()->get("ldap_username");
            $dataassign->users_ldap = $showuser_id;
            $dataassign->save();
        }
        return redirect(url('/task'));

    }

    public function addeventadayoff(Request $request)
    {
        if ($request->session()->has('full_name', 'ldap_username', 'portrait_image')) {
            if ($request->session()->get('statususer') == 1) {
                $eventaday = events::where('events_status', '=', 8)->get();
                $x = array();
                $y = 0;
                foreach ($eventaday as $eventadays) {
                    $x[$y] = $eventadays;
                    $x[$y]->thaidatestart = $this->formatDateThat($eventadays->start_event);
                    $x[$y]->thaidateend = $this->formatDateThat($eventadays->end_event);
                    $y = $y + 1;
                }
                $data = [
                    'eventaday' => $eventaday,
                ];
                return view('AddEventaDayOff', $data);
            } else {
                return redirect('/dashboard')->with('error', 'ไม่สามารถเข้าถึงได้!!!');
            }
        }
    }

    public function insertadayoff(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $st_date = new \DateTime($request->input('startdate'));
        $en_date = new \DateTime($request->input('enddate'));
        $st_date->format('Y-m-d');
        $en_date->format('Y-m-d');
        $objevents = new events();
        $objevents->events_name = $request->input('work');
        $objevents->event_description = $request->input('description');
        $objevents->color = '#008A0D';
        $objevents->start_event = $st_date;
        $objevents->end_event = $en_date;
        $objevents->events_status = 8;
        $objevents->users_ldap = $request->session()->get("ldap_username");
        $objevents->save();
        return redirect(url('/addeventadayoff'));
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
        $strMonthThai = $monthTH[$strMonth];
        return "$strDay $strMonthThai $strYear";

    }

}
