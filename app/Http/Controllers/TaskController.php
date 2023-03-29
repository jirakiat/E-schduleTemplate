<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\assignees;
use App\Models\event_affiliates;
use App\Models\event_groups;
use App\Models\Event_shares;
use App\Models\events;
use App\Models\Eventshare;
use App\Models\Eventshares;
use App\Models\group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends UserController
{
    public function index(Request $request)
    {
        if ($request->session()->has('full_name', 'ldap_username', 'portrait_image')) {

//            $task = DB::table('events')->where('events_status', '=', 1)->orderByRaw('start_event ASC')->get();
            $task = events::where('users_ldap','=',$request->session()->get('ldap_username'))
                ->get();
            $checkgroup = group::where('create_users_ldap', '=', $request->session()->get("ldap_username"))->first();
            $group = group::where('group_status', '=', 1)->where('create_users_ldap', '=', $request->session()->get("ldap_username"))->get();
            $affiliate = Affiliate::where('affiliates_status', '=', 1)->where('users_ldap', '=', $request->session()->get('ldap_username'))->get();
            $check = Affiliate::where('affiliates_status', '=', 1)->where('users_ldap', '=', $request->session()->get('ldap_username'))->first();
            $assign = DB::table('assignees')->where('users_ldap', '=', $request->session()->get('ldap_username'))->where('assignees_status', '=', 0)->count('assignees_id');
            $datauser = User::all();
            $affiliateevents = DB::table('event_affiliates')
                ->join('events', 'events.events_id', '=', 'event_affiliates.events_id')
                ->join('affiliates', 'affiliates.affiliate_id', '=', 'event_affiliates.affiliate_id')
                ->where('event_affiliates.users_ldap', '=', $request->session()->get('ldap_username'))
                ->where('events.events_status', '=', 5)
                ->select('events.*', 'event_affiliates.*', 'affiliates.*')
                ->get();
            $sharemembers = DB::table('event_shares')
                ->join('events', 'events.events_id', '=', 'event_shares.events_id')
                ->join('users', 'users.users_ldap', '=', 'event_shares.share_users_ldap')
                ->select('events.*', 'event_shares.*', 'users.*')
                ->where('event_shares.users_ldap', '=', $request->session()->get('ldap_username'))
                ->get();
            $groupevent = DB::table('event_groups')
                ->join('events', 'events.events_id', '=', 'event_groups.events_id')
                ->join('groups', 'groups.group_id', '=', 'event_groups.group_id')
                ->where('event_groups.users_ldap', '=', $request->session()->get('ldap_username'))
                ->where('events.events_status', '=', 6)
                ->select('events.*', 'event_groups.*', 'groups.*')
                ->get();
            $assignees = DB::table('assignees')
                ->Join('events', 'events.events_id', '=', 'assignees.events_id')
                ->join('users', 'users.users_ldap', '=', 'assignees.creat_users_ldap')
                ->select('events.*', 'assignees.*','users.*')
                ->where('assignees.users_ldap', '=', $request->session()->get('ldap_username'))
                ->where('events.events_status', '=', 3)
                ->where('assignees.assignees_status', '=', 1)
                ->get();
            $x = array();
            $y = 0;
            foreach ($task as $tasks) {
                $x[$y] = $tasks;
                $x[$y]->thaidatestart = $this->formatDateThat($tasks->start_event);
                $x[$y]->thaidateend = $this->formatDateThat($tasks->end_event);
                $y = $y + 1;
            }
            foreach ($groupevent as $groupevents) {
                $x[$y] = $groupevents;
                $x[$y]->thaidatestart = $this->formatDateThat($groupevents->start_event);
                $x[$y]->thaidateend = $this->formatDateThat($groupevents->end_event);
                $y = $y + 1;
            }
            foreach ($affiliateevents as $affiliateevent) {
                $x[$y] = $affiliateevent;
                $x[$y]->thaidatestart = $this->formatDateThat($affiliateevent->start_event);
                $x[$y]->thaidateend = $this->formatDateThat($affiliateevent->end_event);
                $y = $y + 1;
            }
            foreach ($sharemembers as $sharemember) {
                $x[$y] = $sharemember;
                $x[$y]->thaidatestart = $this->formatDateThat($sharemember->start_event);
                $x[$y]->thaidateend = $this->formatDateThat($sharemember->end_event);
                $y = $y + 1;
            }
            foreach ($assignees as $assignee) {
                $x[$y] = $assignee;
                $x[$y]->thaidatestart = $this->formatDateThat($assignee->start_event);
                $x[$y]->thaidateend = $this->formatDateThat($assignee->end_event);
                $y = $y + 1;
            }
            $datecheck = date("Y-m-d");
            $data = [
                'task' => $x,
                'datauser' => $datauser,
                'assign' => $assign,
                'affiliate' => $affiliate,
                'check' => $check,
                'checkgroup' => $checkgroup,
                'group' => $group,
                'affiliateevents' => $affiliateevents,
                'sharemembers' => $sharemembers,
                'groupevent' => $groupevent,
                'datecheck' => $datecheck,
                'assignees' => $assignees,
            ];
            return view('Task', $data);
        } else {
            return redirect(url('/signin'));
        }
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
        return "$strDay $strMonthThai $strYear $strHour:$strMinute น";
    }

    public function deletetask(Request $request)
    {
        $objgevents = events::find($request->input('events_id'));
        $objgevents->events_status = "2";
        $objgevents->save();
        return redirect(url('/task'));
    }

    public function taskupdate(Request $request)
    {
        if ($request->input('startdate')==null && $request->input('enddate')==null){
            date_default_timezone_set("Asia/Bangkok");
            $st_date = new \DateTime($request->input('startdate2'));
            $en_date = new \DateTime($request->input('enddate2'));
            $st_date->format('Y-m-d H:i:s');
            $en_date->format('Y-m-d H:i:s');
        }elseif($request->input('startdate')!==null && $request->input('enddate')!==null) {
            date_default_timezone_set("Asia/Bangkok");
            $st_date = new \DateTime($request->input('startdate'));
            $en_date = new \DateTime($request->input('enddate'));
            $st_date->format('Y-m-d H:i:s');
            $en_date->format('Y-m-d H:i:s');
        }
        $objgevents = events::find($request->input('id'));
        $objgevents->events_name = $request->input('names');
        $objgevents->event_description = $request->input('description');
        $objgevents->start_event =$st_date;
        $objgevents->end_event = $en_date;
        $objgevents->save();
        return redirect(url('/task'));
    }
    public function taskupdateadayoff(Request $request)
    {
        if ($request->input('startdate')==null && $request->input('enddate')==null){
            date_default_timezone_set("Asia/Bangkok");
            $st_date = new \DateTime($request->input('startdate2'));
            $en_date = new \DateTime($request->input('enddate2'));
            $st_date->format('Y-m-d');
            $en_date->format('Y-m-d');
        }elseif($request->input('startdate')!==null && $request->input('enddate')!==null) {
            date_default_timezone_set("Asia/Bangkok");
            $st_date = new \DateTime($request->input('startdate'));
            $en_date = new \DateTime($request->input('enddate'));
            $st_date->format('Y-m-d');
            $en_date->format('Y-m-d');
        }
        $objgevents = events::find($request->input('id'));
        $objgevents->events_name = $request->input('names');
        $objgevents->event_description = $request->input('description');
        $objgevents->start_event =$st_date;
        $objgevents->end_event = $en_date;
        $objgevents->save();
        return redirect(url('/addeventadayoff'));
    }
    public function deleteadayoff(Request $request)
    {
        $objgevents = events::find($request->input('events_id'));
        $objgevents->events_status = "2";
        $objgevents->save();
        return redirect(url('/addeventadayoff'));
    }
    public function taskupdateshare(Request $request)
    {
        if ($request->input('startdate')==null && $request->input('enddate')==null){
            date_default_timezone_set("Asia/Bangkok");
            $st_date = new \DateTime($request->input('startdate2'));
            $en_date = new \DateTime($request->input('enddate2'));
            $st_date->format('Y-m-d H:i:s');
            $en_date->format('Y-m-d H:i:s');
        }elseif($request->input('startdate')!==null && $request->input('enddate')!==null) {
            date_default_timezone_set("Asia/Bangkok");
            $st_date = new \DateTime($request->input('startdate'));
            $en_date = new \DateTime($request->input('enddate'));
            $st_date->format('Y-m-d H:i:s');
            $en_date->format('Y-m-d H:i:s');
        }
        $objgevents = events::find($request->input('id'));
        $objgevents->events_name = $request->input('names');
        $objgevents->event_description = $request->input('description');
        $objgevents->start_event =$st_date;
        $objgevents->end_event = $en_date;
        $objgevents->save();
        return redirect(url('/shareedit'));
    }
    public function taskupdateassign(Request $request)
    {
        if ($request->input('startdate')==null && $request->input('enddate')==null){
            date_default_timezone_set("Asia/Bangkok");
            $st_date = new \DateTime($request->input('startdate2'));
            $en_date = new \DateTime($request->input('enddate2'));
            $st_date->format('Y-m-d H:i:s');
            $en_date->format('Y-m-d H:i:s');
        }elseif($request->input('startdate')!==null && $request->input('enddate')!==null) {
            date_default_timezone_set("Asia/Bangkok");
            $st_date = new \DateTime($request->input('startdate'));
            $en_date = new \DateTime($request->input('enddate'));
            $st_date->format('Y-m-d H:i:s');
            $en_date->format('Y-m-d H:i:s');
        }
        $objgevents = events::find($request->input('id'));
        $objgevents->events_name = $request->input('names');
        $objgevents->event_description = $request->input('description');
        $objgevents->start_event =$st_date;
        $objgevents->end_event = $en_date;
        $objgevents->save();
        return redirect(url('/assignedit'));
    }

    public function shareevent(Request $request)
    {
        $checkuser = User::where('users_ldap', '=', $request->input('user_id'))->first();
        if ($checkuser == null) {
            $objuser = new User();
            $objuser->users_name = $request->input('fullname');
            $objuser->users_ldap = $request->input('user_id');
            $objuser->save();
        }
        $objeventshare = new Event_shares();
        $objeventshare->event_shares_statuss = 0;
        $objeventshare->events_id = $request->input('events_id');
        $objeventshare->share_users_ldap = $request->session()->get("ldap_username");
        $objeventshare->users_ldap = $request->input('user_id');
        $objeventshare->save();
        $event=events::where('events_id','=',$request->input('events_id'))->first();
        $this->linemessage($request->input('user_id'),'มีผู้ใช้แชร์'.'ชื่อกิจรรม'.$event->events_name.'ดูคลิก https://e-schedule.nsru.ac.th/dashboard');
        $objgevents = events::find($request->input('events_id'));
        $objgevents->events_status = "4";
        $objgevents->save();
        return redirect(url('/task'));
    }

    public function shareeventshareedit(Request $request)
    {
        $checkshare = Event_shares::join('users', 'users.users_ldap', '=', 'event_shares.users_ldap')
            ->where('event_shares.users_ldap', '=', $request->input('user_id'))
            ->where('event_shares.events_id', '=', $request->input('events_id'))
            ->select('users.*','event_shares.*')
            ->first();
        if ($checkshare == null) {
            $checkuser = User::where('users_ldap', '=', $request->input('user_id'))->first();
            if ($checkuser == null) {
                $objuser = new User();
                $objuser->users_name = $request->input('fullname');
                $objuser->users_ldap = $request->input('user_id');
                $objuser->save();
            }
            $objeventshare = new Event_shares();
            $objeventshare->event_shares_statuss = 0;
            $objeventshare->events_id = $request->input('events_id');
            $objeventshare->share_users_ldap = $request->session()->get("ldap_username");
            $objeventshare->users_ldap = $request->input('user_id');
            $objeventshare->save();

            $objgevents = events::find($request->input('events_id'));
            $objgevents->events_status = "4";
            $objgevents->save();
            return redirect(url('/shareedit'));
        } else
            return redirect('/shareedit')->with('error', 'แชร์ไม่ได้เนื่องจาก '.$checkshare->users_name .' ได้รับการแชร์กิจกรรมนี้ไปแล้ว!!!');
    }
    public function cancel(Request $request){
        $objgeventscancel = events::find($request->input('id'));
        $objgeventscancel->events_status = 9;
        $objgeventscancel->event_note = $request->input('event_note');
        $objgeventscancel->save();
        $checkeventshare=Event_shares::where('events_id','=',$request->input('id'))->get();;
        $event=events::where('events_id','=',$request->input('id'))->first();
        foreach ($checkeventshare as $checkeventshares){
            $id=$checkeventshares->event_shares_id;
            $objgeventsshare = Event_shares::find($id);
            $objgeventsshare->event_shares_statuss = "9";
            $objgeventsshare->save();
            $this->linemessage($checkeventshares->users_ldap,'กิจกรรมถูกยกเลิก'.
                'ชื่อกิจรรม'.$event->events_name.'รายละเอียดกิจกรรม :'
                .$event->event_description
                .'หมายเหตุ : '.$event->event_note
                .'ดูคลิก https://e-schedule.nsru.ac.th/dashboard');
        }
        $checkassign=assignees::where('events_id','=',$request->input('id'))->get();
        foreach ($checkassign as $checkassigns){
            $id=$checkassigns->assignees_id ;
            $objgeventsassign = assignees::find($id);
            $objgeventsassign->assignees_status = "9";
            $objgeventsassign->save();
            $this->linemessage($checkassigns->users_ldap,'กิจกรรมถูกยกเลิก'
                .'ชื่อกิจรรม'.$event->events_name
                .'รายละเอียดกิจกรรม : '.$event->event_description
                .'หมายเหตุ : '.$event->event_note.
                'ดูคลิก https://e-schedule.nsru.ac.th/dashboard');
        }
        $checkgroupevent=event_groups::where('events_id','=',$request->input('id'))->get();
        foreach ($checkgroupevent as $checkgroupevents) {
            $group=group::where('group_id','=',$checkgroupevents->group_id)->first();
            $this->linemessage($checkgroupevents->users_ldap,'กิจกรรมถูกยกเลิก'.'กลุ่มงาน'.$group->group_name
                .'ชื่อกิจรรม'.$event->events_name
                .'รายละเอียดกิจกรรม :'.$event->event_description
                .'หมายเหตุ : '.$event->event_note
                .'ดูคลิก https://e-schedule.nsru.ac.th/dashboard');
        }
        $checkeventaffiliate=event_affiliates::where('events_id','=',$request->input('id'))->get();
        foreach ($checkeventaffiliate as $checkeventaffiliates) {
            $affiliate=Affiliate::where('affiliate_id','=',$checkeventaffiliates->affiliate_id)->first();
            $this->linemessage($checkgroupevents->users_ldap,'กิจกรรมถูกยกเลิก'.'หน่วยงาน'.$affiliate->affiliate_name
                .'ชื่อกิจรรม'.$event->events_name
                .'รายละเอียดกิจกรรม :'.$event->event_description
                .'หมายเหตุ : '.$event->event_note
                .'ดูคลิก https://e-schedule.nsru.ac.th/dashboard');
        }
        return redirect(url('/task'));
    }
    public function cancelshare(Request $request){
        $objgeventscancel = events::find($request->input('id'));
        $objgeventscancel->events_status = 9;
        $objgeventscancel->event_note = $request->input('event_note');
        $objgeventscancel->save();
        $checkeventshare=Event_shares::where('events_id','=',$request->input('id'))->get();;
        $event=events::where('events_id','=',$request->input('id'))->first();
        foreach ($checkeventshare as $checkeventshares){
            $id=$checkeventshares->event_shares_id;
            $objgeventsshare = Event_shares::find($id);
            $objgeventsshare->event_shares_statuss = "9";
            $objgeventsshare->save();
            $this->linemessage($checkeventshares->users_ldap,'กิจกรรมถูกยกเลิก'.
                'ชื่อกิจรรม'.$event->events_name.'รายละเอียดกิจกรรม :'
                .$event->event_description
                .'หมายเหตุ : '.$event->event_note
                .'ดูคลิก https://e-schedule.nsru.ac.th/dashboard');
        }
        $checkassign=assignees::where('events_id','=',$request->input('id'))->get();
        foreach ($checkassign as $checkassigns){
            $id=$checkassigns->assignees_id ;
            $objgeventsassign = assignees::find($id);
            $objgeventsassign->assignees_status = "9";
            $objgeventsassign->save();
            $this->linemessage($checkassigns->users_ldap,'กิจกรรมถูกยกเลิก'
                .'ชื่อกิจรรม'.$event->events_name
                .'รายละเอียดกิจกรรม : '.$event->event_description
                .'หมายเหตุ : '.$event->event_note.
                'ดูคลิก https://e-schedule.nsru.ac.th/dashboard');
        }
        $checkgroupevent=event_groups::where('events_id','=',$request->input('id'))->get();
        foreach ($checkgroupevent as $checkgroupevents) {
            $group=group::where('group_id','=',$checkgroupevents->group_id)->first();
            $this->linemessage($checkgroupevents->users_ldap,'กิจกรรมถูกยกเลิก'.'กลุ่มงาน'.$group->group_name
                .'ชื่อกิจรรม'.$event->events_name
                .'รายละเอียดกิจกรรม :'.$event->event_description
                .'หมายเหตุ : '.$event->event_note
                .'ดูคลิก https://e-schedule.nsru.ac.th/dashboard');
        }
        $checkeventaffiliate=event_affiliates::where('events_id','=',$request->input('id'))->get();
        foreach ($checkeventaffiliate as $checkeventaffiliates) {
            $affiliate=Affiliate::where('affiliate_id','=',$checkeventaffiliates->affiliate_id)->first();
            $this->linemessage($checkgroupevents->users_ldap,'กิจกรรมถูกยกเลิก'.'หน่วยงาน'.$affiliate->affiliate_name
                .'ชื่อกิจรรม'.$event->events_name
                .'รายละเอียดกิจกรรม :'.$event->event_description
                .'หมายเหตุ : '.$event->event_note
                .'ดูคลิก https://e-schedule.nsru.ac.th/dashboard');
        }
        return redirect(url('/shareedit'));
    }
    public function deleteusershare(Request $request){
        $objgeventsdeleteshare = Event_shares::find($request->input('event_shares_id'));
        $objgeventsdeleteshare->delete();
        return redirect(url('/shareedit'));
    }
    public function cancelassign(Request $request){
        $objgeventscancel = events::find($request->input('id'));
        $objgeventscancel->events_status = 9;
        $objgeventscancel->event_note = $request->input('event_note');
        $objgeventscancel->save();
        $checkeventshare=Event_shares::where('events_id','=',$request->input('id'))->get();;
        $event=events::where('events_id','=',$request->input('id'))->first();
        foreach ($checkeventshare as $checkeventshares){
            $id=$checkeventshares->event_shares_id;
            $objgeventsshare = Event_shares::find($id);
            $objgeventsshare->event_shares_statuss = "9";
            $objgeventsshare->save();
            $this->linemessage($checkeventshares->users_ldap,'กิจกรรมถูกยกเลิก'.
                'ชื่อกิจรรม'.$event->events_name.'รายละเอียดกิจกรรม :'
                .$event->event_description
                .'หมายเหตุ : '.$event->event_note
                .'ดูคลิก https://e-schedule.nsru.ac.th/dashboard');
        }
        $checkassign=assignees::where('events_id','=',$request->input('id'))->get();
        foreach ($checkassign as $checkassigns){
            $id=$checkassigns->assignees_id ;
            $objgeventsassign = assignees::find($id);
            $objgeventsassign->assignees_status = "9";
            $objgeventsassign->save();
            $this->linemessage($checkassigns->users_ldap,'กิจกรรมถูกยกเลิก'
                .'ชื่อกิจรรม'.$event->events_name
                .'รายละเอียดกิจกรรม : '.$event->event_description
                .'หมายเหตุ : '.$event->event_note.
                'ดูคลิก https://e-schedule.nsru.ac.th/dashboard');
        }
        $checkgroupevent=event_groups::where('events_id','=',$request->input('id'))->get();
        foreach ($checkgroupevent as $checkgroupevents) {
            $group=group::where('group_id','=',$checkgroupevents->group_id)->first();
            $this->linemessage($checkgroupevents->users_ldap,'กิจกรรมถูกยกเลิก'.'กลุ่มงาน'.$group->group_name
                .'ชื่อกิจรรม'.$event->events_name
                .'รายละเอียดกิจกรรม :'.$event->event_description
                .'หมายเหตุ : '.$event->event_note
                .'ดูคลิก https://e-schedule.nsru.ac.th/dashboard');
        }
        $checkeventaffiliate=event_affiliates::where('events_id','=',$request->input('id'))->get();
        foreach ($checkeventaffiliate as $checkeventaffiliates) {
            $affiliate=Affiliate::where('affiliate_id','=',$checkeventaffiliates->affiliate_id)->first();
            $this->linemessage($checkgroupevents->users_ldap,'กิจกรรมถูกยกเลิก'.'หน่วยงาน'.$affiliate->affiliate_name
                .'ชื่อกิจรรม'.$event->events_name
                .'รายละเอียดกิจกรรม :'.$event->event_description
                .'หมายเหตุ : '.$event->event_note
                .'ดูคลิก https://e-schedule.nsru.ac.th/dashboard');
        }
        return redirect(url('/assignedit'));
    }
}
