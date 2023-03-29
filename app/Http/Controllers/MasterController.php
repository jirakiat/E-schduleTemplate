<?php

namespace App\Http\Controllers;

use App\Models\events;
use App\Models\setting_statuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\assignees;
use App\Models\Event_shares;

class MasterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('full_name', 'ldap_username', 'portrait_image')) {
            $assignshow = DB::table('assignees')->where('users_ldap', '=', $request->session()->get('ldap_username'))->count('assignees_id');
            $shareshow = DB::table('event_shares')->where('users_ldap', '=', $request->session()->get('ldap_username'))->count('event_shares_id');
            $share = DB::table('event_shares')->where('users_ldap', '=', $request->session()->get('ldap_username'))->where('event_shares_statuss', '=', 0)->count('event_shares_id');
            $assign = DB::table('assignees')->where('users_ldap', '=', $request->session()->get('ldap_username'))->where('assignees_status', '=', 0)->count('assignees_id');
            $data = [
                'assign' => $assign,
                'assignshow' => $assignshow,
                'shareshow' => $shareshow,
                'share' => $share,
            ];
            return view('main', $data);
        } else {
            return redirect(url('/signin'));
        }
    }

    public function getData(Request $request)
    {
        $data = array();
        $events = events::where('users_ldap', $request->session()->get('ldap_username'))
            ->get();
        $assigns = DB::table('assignees')
            ->Join('events', 'events.events_id', '=', 'assignees.events_id')
            ->join('users','users.users_ldap','=','assignees.creat_users_ldap')
            ->select('events.*', 'assignees.*','users.*')
            ->where('assignees.users_ldap', '=', $request->session()->get("ldap_username"))
            ->where('assignees.assignees_status', '=', 1)
            ->where('events.events_status', '=', 3)
            ->get();
        $sharemembers = DB::table('event_shares')
            ->join('events', 'events.events_id', '=', 'event_shares.events_id')
            ->join('users','users.users_ldap','=','event_shares.share_users_ldap')
            ->select('events.*', 'event_shares.*','users.*')
            ->where('event_shares.users_ldap', '=', $request->session()->get('ldap_username'))
            ->where('event_shares.event_shares_statuss', '=', 1)
            ->where('events.events_status', '=', 4)
            ->get();
        $affiliateevents = DB::table('event_affiliates')
            ->join('events', 'events.events_id', '=', 'event_affiliates.events_id')
            ->join('affiliates', 'affiliates.affiliate_id', '=', 'event_affiliates.affiliate_id')
            ->where('event_affiliates.users_ldap', '=', $request->session()->get('ldap_username'))
            ->where('events.events_status', '=', 5)
            ->select('events.*', 'event_affiliates.*', 'affiliates.*')
            ->get();
        $groupevents = DB::table('event_groups')
            ->join('events', 'events.events_id', '=', 'event_groups.events_id')
            ->join('groups', 'groups.group_id', '=', 'event_groups.group_id')
            ->where('event_groups.users_ldap', '=', $request->session()->get('ldap_username'))
            ->where('events.events_status', '=', 6)
            ->select('events.*', 'event_groups.*', 'groups.*')
            ->get();
        $eventaday=events::where('events_status','=',8)->get();
        foreach ($eventaday as $eventadays) {
                $data[] = array(
                    'id' => $eventadays["events_id"],
                    'title' => $eventadays["events_name"],
                    'start' => $eventadays["start_event"],
                    'end' => $eventadays["end_event"],
                    'description' => $eventadays["event_description"],
                    'color' => $eventadays["color"],
                    'dateStartTxt' => $this->formatDateThatadayoff($eventadays["start_event"]),
                    'dateEndTxt' => $this->formatDateThatadayoff($eventadays["end_event"]),
                    'icon' => "<span class='badge bade-danger bg-red w-20 pull-right m-4'>วันหยุดไทย</span>",

                );
            }
        foreach ($events as $event) {
            if ($event->events_status == 1 or $event->events_status == 4) {
                $data[] = array(
                    'id' => $event["events_id"],
                    'title' => $event["events_name"],
                    'start' => $event["start_event"],
                    'end' => $event["end_event"],
                    'description' => $event["event_description"],
                    'color' => $event["color"],
                    'dateStartTxt' => $this->formatDateThat($event["start_event"]),
                    'dateEndTxt' => $this->formatDateThat($event["end_event"]),
                );
            }
        }
        foreach ($assigns as $assign) {
            $data[] = array(
                'id' => $assign->events_id,
                'title' => $assign->events_name,
                'start' => $assign->start_event,
                'end' => $assign->end_event,
                'description' => $assign->event_description,
                'usercreat' => $assign->users_name,
                'icon' => "<span class='badge bade-danger bg-green w-20 pull-right m-4'><i class='fas fa-share-square'></i> $assign->users_name</span>",
                'color' => $assign->color,
                'dateStartTxt' => $this->formatDateThat($assign->start_event),
                'dateEndTxt' => $this->formatDateThat($assign->end_event),
            );
        }
        foreach ($sharemembers as $sharemember) {
            $data[] = array(
                'id' => $sharemember->events_id,
                'title' => $sharemember->events_name,
                'start' => $sharemember->start_event,
                'end' => $sharemember->end_event,
                'description' => $sharemember->event_description,
                'usershare' => $sharemember->users_name,
                'icon' => "<span class='badge bade-danger bg-orange w-20 pull-right m-4'><i class='fas fa-share-alt'></i> $sharemember->users_name</span>",
                'color' => $sharemember->color,
                'dateStartTxt' => $this->formatDateThat($sharemember->start_event),
                'dateEndTxt' => $this->formatDateThat($sharemember->end_event),
            );
        }
        foreach ($groupevents as $groupevent) {
            $data[] = array(
                'id' => $groupevent->events_id,
                'title' => $groupevent->events_name,
                'start' => $groupevent->start_event,
                'end' => $groupevent->end_event,
                'description' => $groupevent->event_description,
                'affiliate' => $groupevent->group_name,
                'icon' => "<span class='badge bade-danger bg-pink w-20 pull-right m-4'><i class='fas fa-users'></i> $groupevent->group_name</span>",
                'color' => $groupevent->color,
                'dateStartTxt' => $this->formatDateThat($groupevent->start_event),
                'dateEndTxt' => $this->formatDateThat($groupevent->end_event),
            );
        }
        foreach ($affiliateevents as $affiliateevent) {
            $data[] = array(
                'id' => $affiliateevent->events_id,
                'title' => $affiliateevent->events_name,
                'start' => $affiliateevent->start_event,
                'end' => $affiliateevent->end_event,
                'description' => $affiliateevent->event_description,
                'affiliate' => $affiliateevent->affiliate_name,
                'icon' => "<span class='badge bade-danger bg-blue w-20 pull-right m-4'><i class='fas fa-university'></i> $affiliateevent->affiliate_name</span>",
                'color' => $affiliateevent->color,
                'dateStartTxt' => $this->formatDateThat($affiliateevent->start_event),
                'dateEndTxt' => $this->formatDateThat($affiliateevent->end_event),
            );
        }


        echo json_encode($data,);
    }

    function formatDateThat($strDate)
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
        return "$strDay $strMonthThai $strYear $strHour.$strMinute น.";
    }
    function formatDateThatadayoff($strDate)
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

    public function dashborad(Request $request)
    {
        if ($request->session()->has('full_name', 'ldap_username', 'portrait_image')) {
            $assignshow = DB::table('assignees')->where('users_ldap', '=', $request->session()->get('ldap_username'))->count('assignees_id');
            $shareshow = DB::table('event_shares')->where('users_ldap', '=', $request->session()->get('ldap_username'))->count('event_shares_id');
            $share = DB::table('event_shares')->where('users_ldap', '=', $request->session()->get('ldap_username'))->where('event_shares_statuss', '=', 0)->count('event_shares_id');
            $assign = DB::table('assignees')->where('users_ldap', '=', $request->session()->get('ldap_username'))->where('assignees_status', '=', 0)->count('assignees_id');
            $sharemember = DB::table('event_shares')
                ->join('events', 'events.events_id', '=', 'event_shares.events_id')
                ->join('users','users.users_ldap','=','event_shares.share_users_ldap')
                ->select('events.*', 'event_shares.*','users.*')
                ->where('event_shares.users_ldap', '=', $request->session()->get('ldap_username'))
                ->where('event_shares.event_shares_statuss', '=', 0)
                ->orderBy('start_event', 'DESC')
                ->get();
            $checkshereevent = DB::table('event_shares')
                ->join('events', 'events.events_id', '=', 'event_shares.events_id')
                ->select('events.*', 'event_shares.*')
                ->where('event_shares.users_ldap', '=', $request->session()->get('ldap_username'))
                ->where('event_shares.event_shares_statuss', '=', 0)
                ->get();
            $assignee = DB::table('assignees')
                ->Join('events', 'events.events_id', '=', 'assignees.events_id')
                ->join('users','users.users_ldap','=','assignees.creat_users_ldap')
                ->select('events.*', 'assignees.*','users.*')
                ->where('assignees.users_ldap', '=', $request->session()->get("ldap_username"))
                ->where('assignees.assignees_status', '=', 0)
                ->get();
            $setting=setting_statuses::where('users_ldap','=',$request->session()->get("ldap_username"))->first();
            if ($request->input('checkacept')){
                $checkacept=$request->input('checkacept');

                if ($setting==null) {
                    $objcheck = new setting_statuses();
                    $objcheck->users_ldap = $request->session()->get("ldap_username");
                    $objcheck->status_acept_id = $checkacept;
                    $objcheck->save();
                }
                else{
                    $id=$setting->id;
                    $objcheck = setting_statuses::find($id);
                    $objcheck->status_acept_id = $checkacept;
                    $objcheck->save();
                }
            }
            $datecheck = date("Y-m-d");
            $newDate = date("Y-m-d", strtotime("-1 days", strtotime($datecheck)));
            if ($setting!=null) {
                $settingcheck=setting_statuses::where('users_ldap','=',$request->session()->get("ldap_username"))->first();
                $checkacpetses=$settingcheck->status_acept_id;
                foreach ($assignee as $assignees) {
                    if ($checkacpets=1){
                        $event_status=3;
                    }elseif ($checkacpets=2){
                        $event_status=2;
                    }
                    $endday = new \DateTime($assignees->end_event);
                    $enddate = $endday->format('Y-m-d');
                    if ($enddate <= $newDate) {
                        $idassign = $assignees->assignees_id;
                        $idevent = $assignees->events_id;
                        date_default_timezone_set("Asia/Bangkok");
                        $datevertifytime = new \DateTime;
                        $objgassign = assignees::find($idassign);
                        $objgassign->assignees_status = $checkacpetses;
                        $objgassign->vertify_time = $datevertifytime;
                        $objgassign->save();

                        $objgevents = events::find($idevent);
                        $objgevents->events_status = $event_status;
                        $objgevents->save();
                    }
                }
                foreach ($checkshereevent as $checkshereevents) {
                    if ($checkacpets=1){
                        $event_status=4;
                    }elseif ($checkacpets=2){
                        $event_status=2;
                    }
                    $endday = new \DateTime($checkshereevents->end_event);
                    $enddate = $endday->format('Y-m-d');
                    if ($enddate <= $newDate) {
                        $idshare = $checkshereevents->event_shares_id;
                        $event_id = $checkshereevents->events_id;
                        date_default_timezone_set("Asia/Bangkok");
                        $datevertifytime = new \DateTime;
                        $objgashare = Event_shares::find($idshare);
                        $objgashare->event_shares_statuss = $checkacpetses;
                        $objgashare->event_shares_vertify_time = $datevertifytime;
                        $objgashare->save();

                        $objgevents = events::find($event_id);
                        $objgevents->events_status = $event_status;
                        $objgevents->save();
                    }
                }
            }
            elseif ($setting==null) {
                foreach ($assignee as $assignees) {
                    $endday = new \DateTime($assignees->end_event);
                    $enddate = $endday->format('Y-m-d');
                    if ($enddate <= $newDate) {
                        $idassign = $assignees->assignees_id;
                        date_default_timezone_set("Asia/Bangkok");
                        $datevertifytime = new \DateTime;
                        $objgassign = assignees::find($idassign);
                        $objgassign->assignees_status = 5;
                        //                สถานะ 5 คือ ไม่กดอะไรเลยแล้วเลยวันที่
                        $objgassign->vertify_time = $datevertifytime;
                        $objgassign->save();
                    }
                }
                foreach ($checkshereevent as $checkshereevents) {
                    $endday = new \DateTime($checkshereevents->end_event);
                    $enddate = $endday->format('Y-m-d');
                    if ($enddate <= $newDate) {
                        $idshare = $checkshereevents->event_shares_id;
                        $event_id = $checkshereevents->events_id;
                        date_default_timezone_set("Asia/Bangkok");
                        $datevertifytime = new \DateTime;
                        $objgashare = Event_shares::find($idshare);
                        $objgashare->event_shares_statuss = 5;
//                สถานะ 5 คือ ไม่กดอะไรเลยแล้วเลยวันที่
                        $objgashare->event_shares_vertify_time = $datevertifytime;
                        $objgashare->save();
                    }
                }
            }
            $x = array();
            $y = 0;
            foreach ($sharemember as $sharemembers) {
                $x[$y] = $sharemembers;
                $x[$y]->thaidatestart = $this->formatDateThat($sharemembers->start_event);
                $x[$y]->thaidateend = $this->formatDateThat($sharemembers->end_event);
                if (isset($sharemembers->event_shares_vertify_time)) {
                    $x[$y]->thaivertifytime = $this->formatDateThat($sharemembers->event_shares_vertify_time);
                }
                $y = $y + 1;
            }
            foreach ($assignee as $assignees) {
                $x[$y] = $assignees;
                $x[$y]->thaidatestart = $this->formatDateThat($assignees->start_event);
                $x[$y]->thaidateend = $this->formatDateThat($assignees->end_event);
                if (isset($sharemembers->vertify_time)) {
                    $x[$y]->thaivertifytime = $this->formatDateThat($assignees->event_shares_vertify_time);
                }
                $y = $y + 1;
            }
            $settingshow=setting_statuses::where('users_ldap','=',$request->session()->get("ldap_username"))->first();
            if ($settingshow!=null) {
                $checkacpets = $settingshow->status_acept_id;
                if ($checkacpets == 1) {
                    $check1 = 'checked';
                    $check2 = '';
                    $check3 = '';
                } elseif ($checkacpets == 3) {
                    $check1 = '';
                    $check2 = 'checked';
                    $check3 = '';
                } elseif ($checkacpets == 5) {
                    $check1 = '';
                    $check2 = '';
                    $check3 = 'checked';
                }
            }else{
                $check1 = '';
                $check2 = '';
                $check3 = 'checked';
            }
            $data = [
                'assign' => $assign,
                'assignshow' => $assignshow,
                'shareshow' => $shareshow,
                'share' => $share,
                'sharemember' => $sharemember,
                'assignee' => $assignee,
                'check1' => $check1,
                'check2' => $check2,
                'check3' => $check3,
            ];
            return view('dashborad', $data);
        } else {
            return redirect(url('/signin'));
        }
    }

}
