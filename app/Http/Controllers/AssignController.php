<?php

namespace App\Http\Controllers;

use App\Models\assignees;
use App\Models\Event_shares;
use App\Models\events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;

class AssignController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('full_name', 'ldap_username', 'portrait_image')) {
            if ($request->input("check")) {
                $check = $request->input("check");
                $assign = DB::table('assignees')
                    ->Join('events', 'events.events_id', '=', 'assignees.events_id')
                    ->join('users', 'users.users_ldap', '=', 'assignees.creat_users_ldap')
                    ->select('events.*', 'assignees.*','users.*')
                    ->where('assignees.users_ldap', '=', $request->session()->get("ldap_username"))
                    ->where('assignees.assignees_status', '=', $check)
                    ->get();
            } else {
                $assign = DB::table('assignees')
                    ->Join('events', 'events.events_id', '=', 'assignees.events_id')
                    ->join('users', 'users.users_ldap', '=', 'assignees.creat_users_ldap')
                    ->select('events.*', 'assignees.*','users.*')
                    ->where('assignees.users_ldap', '=', $request->session()->get('ldap_username'))
                    ->get();
            }

            $x = array();
            $y = 0;
            foreach ($assign as $assigns) {
                $x[$y] = $assigns;
                $x[$y]->thaidatestart = $this->formatDateThat($assigns->start_event);
                $x[$y]->thaidateend = $this->formatDateThat($assigns->end_event);
                if (isset($assigns->vertify_time)) {
                    $x[$y]->thaivertifytime = $this->formatDateThat($assigns->vertify_time);
                }
                $y = $y + 1;
            }
            if ($request->input("check") == 0) {
                $checked1 = 'checked';
                $checked2 = '';
                $checked3 = '';
                $checked4 = '';
            } elseif ($request->input("check") == 1) {
                $checked2 = 'checked';
                $checked1 = '';
                $checked3 = '';
                $checked4 = '';
            } elseif ($request->input("check") == 3) {
                $checked3 = 'checked';
                $checked1 = '';
                $checked2 = '';
                $checked4 = '';
            } elseif ($request->input("check") == 5) {
                $checked3 = '';
                $checked1 = '';
                $checked2 = '';
                $checked4 = 'checked';
            }
            $data = [
                'assign' => $assign,
                'checked1' => $checked1,
                'checked2' => $checked2,
                'checked3' => $checked3,
                'checked4' => $checked4,
            ];
            return view('Assign', $data);
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
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear $strHour:$strMinute น";
    }

    public function reject(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datevertifytime = new \DateTime;
        $objgassign = assignees::find($request->input('assignees_id'));
        $objgassign->assignees_status = "3";
        $objgassign->vertify_time = $datevertifytime;
        $objgassign->save();

        $objgevents = events::find($request->input('events_id'));
        $objgevents->events_status = "2";
        $objgevents->save();

        return redirect(url('/assign'));
    }

    public function accept(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datevertifytime = new \DateTime;
        $objgassign = assignees::find($request->input('assignees_id'));
        $objgassign->assignees_status = "1";
        $objgassign->vertify_time = $datevertifytime;
        $objgassign->save();

        $objgevents = events::find($request->input('events_id'));
        $objgevents->events_status = "3";
        $objgevents->save();

        return redirect(url('/assign'));
    }

    public function assignshow(Request $request, $id)
    {
        $assign = DB::table('assignees')->where('users_ldap', '=', $request->session()->get('ldap_username'))->where('assignees_status', '=', 0)->count('assignees_id');
        $assignshow = DB::table('assignees')
            ->Join('events', 'events.events_id', '=', 'assignees.events_id')
            ->select('events.*', 'assignees.*')
            ->where('assignees.events_id', '=', $id)
            ->get();
        $x = array();
        $y = 0;
        foreach ($assignshow as $assignshows) {
            $x[$y] = $assignshows;
            $x[$y]->thaidatestart = $this->formatDateThat($assignshows->start_event);
            $x[$y]->thaidateend = $this->formatDateThat($assignshows->end_event);
            if (isset($assignshows->vertify_time)) {
                $x[$y]->thaivertifytime = $this->formatDateThat($assignshows->vertify_time);
            }
            $y = $y + 1;
        }
        $data1 = [
            'assignshow' => $assignshow,
            'assign' => $assign,
        ];
        return view('Assignshow', $data1);
    }

    public function assignedit(Request $request)
    {
        $assign = DB::table('assignees')->where('users_ldap', '=', $request->session()->get('ldap_username'))->where('assignees_status', '=', 0)->count('assignees_id');
        $assignshow = DB::table('assignees')
            ->Join('events', 'events.events_id', '=', 'assignees.events_id')
            ->join('users','users.users_ldap','=','assignees.users_ldap')
            ->select('events.*', 'assignees.*','users.*')
            ->where('assignees.creat_users_ldap', '=', $request->session()->get('ldap_username'))
            ->get();
        $x = array();
        $y = 0;
        foreach ($assignshow as $assignshows) {
            $x[$y] = $assignshows;
            $x[$y]->thaidatestart = $this->formatDateThat($assignshows->start_event);
            $x[$y]->thaidateend = $this->formatDateThat($assignshows->end_event);
            if (isset($assignshows->vertify_time)) {
                $x[$y]->thaivertifytime = $this->formatDateThat($assignshows->vertify_time);
            }
            $y = $y + 1;
        }
        $data = [
            'assignshow' => $assignshow,
            'assign' => $assign,
        ];
        return view('Assignedit', $data);

    }

    public function assignupdate(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $st_date = new \DateTime($request->input('startdate'));
        $en_date = new \DateTime($request->input('enddate'));
        $st_date->format('Y-m-d H:i:s');
        $en_date->format('Y-m-d H:i:s');
        $objgevents = events::find($request->input('id'));
        $objgevents->events_name = $request->input('names');
        $objgevents->start_event =$st_date;
        $objgevents->end_event = $en_date;
        $objgevents->event_description = $request->input('description');
        $objgevents->save();
        return redirect(url('/assignedit'));
    }

    public function sharemember(Request $request, $id)
    {
        $assign = DB::table('assignees')->where('users_ldap', '=', $request->session()->get('ldap_username'))->where('assignees_status', '=', 0)->count('assignees_id');
        $sharemember = DB::table('event_shares')
            ->join('events', 'events.events_id', '=', 'event_shares.events_id')
            ->select('events.*', 'event_shares.*')
            ->where('event_shares.events_id', '=', $id)
            ->limit('1')
            ->get();
        $test = DB::table('event_shares')
            ->join('events', 'events.events_id', '=', 'event_shares.events_id')
            ->join('users','users.users_ldap','=','event_shares.users_ldap')
            ->where('event_shares.events_id', '=', $id)
            ->select('events.*', 'event_shares.*','users.*')
            ->get();
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
        foreach ($test as $tests) {
            $x[$y] = $tests;
            if (isset($tests->event_shares_vertify_time)) {
                $x[$y]->thaivertifytimetest = $this->formatDateThat($tests->event_shares_vertify_time);
            }
            $y = $y + 1;
        }
        $data = [
            'sharemember' => $sharemember,
            'assign' => $assign,
            'test' => $test,
        ];
        return view('Eventsharemember', $data);
    }

    public function shareevent(Request $request)
    {
        if ($request->input("check")) {
            $check = $request->input("check");
            $sharemember = DB::table('event_shares')
                ->join('events', 'events.events_id', '=', 'event_shares.events_id')
                ->join('users', 'users.users_ldap', '=', 'event_shares.share_users_ldap')
                ->select('events.*', 'event_shares.*', 'users.*')
                ->where('event_shares.users_ldap', '=', $request->session()->get('ldap_username'))
                ->where('event_shares.event_shares_statuss', '=', $check)
                ->get();
        } else {
            $sharemember = DB::table('event_shares')
                ->join('events', 'events.events_id', '=', 'event_shares.events_id')
                ->join('users', 'users.users_ldap', '=', 'event_shares.share_users_ldap')
                ->select('events.*', 'event_shares.*', 'users.*')
                ->where('event_shares.users_ldap', '=', $request->session()->get('ldap_username'))
                ->get();
        }
        $assign = DB::table('assignees')->where('users_ldap', '=', $request->session()->get('ldap_username'))->where('assignees_status', '=', 0)->count('assignees_id');
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
        if ($request->input("check") == 0) {
            $checked1 = 'checked';
            $checked2 = '';
            $checked3 = '';
            $checked4 = '';
        } elseif ($request->input("check") == 1) {
            $checked2 = 'checked';
            $checked1 = '';
            $checked3 = '';
            $checked4 = '';
        } elseif ($request->input("check") == 3) {
            $checked3 = 'checked';
            $checked1 = '';
            $checked2 = '';
            $checked4 = '';
        }
        elseif ($request->input("check") == 5) {
            $checked3 = '';
            $checked1 = '';
            $checked2 = '';
            $checked4 = 'checked';
        }
        $data = [
            'sharemember' => $sharemember,
            'assign' => $assign,
            'checked1' => $checked1,
            'checked2' => $checked2,
            'checked3' => $checked3,
            'checked4' => $checked4,
        ];
        return view('Eventshares', $data);

    }

    public function shareeventreject(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datevertifytime = new \DateTime;
        $objgashare = Event_shares::find($request->input('shareid'));
        $objgashare->event_shares_statuss = "3";
        $objgashare->event_shares_vertify_time = $datevertifytime;
        $objgashare->save();

        return redirect(url('/eventshare'));

    }

    public function shareeventaccept(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datevertifytime = new \DateTime;
        $objgashare = Event_shares::find($request->input('shareid'));
        $objgashare->event_shares_statuss = "1";
        $objgashare->event_shares_vertify_time = $datevertifytime;
        $objgashare->save();

        return redirect(url('/eventshare'));

    }
    public function sharesedit(Request $request)
    {
            $sharesedit = events::
                where('users_ldap','=',$request->session()->get('ldap_username'))
                ->get();
                 foreach ($sharesedit as $sharesedits) {
                    $test = DB::table('event_shares')
                        ->join('events', 'events.events_id', '=', 'event_shares.events_id')
                        ->join('users', 'users.users_ldap', '=', 'event_shares.users_ldap')
                        ->select('events.*', 'event_shares.*', 'users.*')
                        ->get();
                }
                $x = array();
                $y = 0;
                if(isset($test)) {
                    foreach ($test as $tests) {
                        $x[$y] = $tests;
                        $x[$y]->thaidatestart = $this->formatDateThat($tests->start_event);
                        $x[$y]->thaidateend = $this->formatDateThat($tests->end_event);
                        if (isset($tests->event_shares_vertify_time)) {
                            $x[$y]->thaivertifytime = $this->formatDateThat($tests->event_shares_vertify_time);
                        }
                        $y = $y + 1;
                    }
                }
                else{
                    return redirect('/dashboard')->with('error', 'ไม่มีกิจกรรมที่แชร์ให้ผู้อื่น');
                }
        $x = array();
        $y = 0;
        foreach ($sharesedit as $sharesedits) {
            $x[$y] = $sharesedits;
            $x[$y]->thaidatestart = $this->formatDateThat($sharesedits->start_event);
            $x[$y]->thaidateend = $this->formatDateThat($sharesedits->end_event);
            if (isset($sharesedits->event_shares_vertify_time)) {
                $x[$y]->thaivertifytime = $this->formatDateThat($sharesedits->event_shares_vertify_time);
            }
            $y = $y + 1;
        }

        $data = [
            'sharesedit' => $sharesedit,
            'test' => $test,
        ];
        return view('Sharesedit', $data);
    }
    public function shareseditupdate(Request $request,$id){
        $task=events::where('events_id','=',$id)->first();
        $st_date = new \DateTime($task->start_event);
        $en_date = new \DateTime($task->end_event);
        $st_date->format('m/d/Y H:i:s');
        $en_date->format('m/d/Y H:i:s');
        $startdate = $st_date->format('m/d/Y H:i');
        $enddate = $en_date->format('m/d/Y H:i');
        $data = [
            'startdate' => $startdate,
            'enddate' => $enddate,
            'task' => $task,
        ];
        return view('Shareseditupdate', $data);
    }
    public function assigneditupdate(Request $request,$id){
        $task=events::where('events_id','=',$id)->first();
        $st_date = new \DateTime($task->start_event);
        $en_date = new \DateTime($task->end_event);
        $st_date->format('m/d/Y H:i:s');
        $en_date->format('m/d/Y H:i:s');
        $startdate = $st_date->format('m/d/Y H:i');
        $enddate = $en_date->format('m/d/Y H:i');
        $data = [
            'startdate' => $startdate,
            'enddate' => $enddate,
            'task' => $task,
        ];
        return view('Assigneditupdate', $data);
    }
    public function taskupdate(Request $request,$id){
        $task=events::where('events_id','=',$id)->first();
        $st_date = new \DateTime($task->start_event);
        $en_date = new \DateTime($task->end_event);
        $st_date->format('m/d/Y H:i:s');
        $en_date->format('m/d/Y H:i:s');
        $startdate = $st_date->format('m/d/Y H:i');
        $enddate = $en_date->format('m/d/Y H:i');
        $data = [
            'startdate' => $startdate,
            'enddate' => $enddate,
            'task' => $task,
        ];
        return view('Taskupdate', $data);
    }
    public function eventadayoffupdate(Request $request,$id){
        $task=events::where('events_id','=',$id)->first();
        $st_date = new \DateTime($task->start_event);
        $en_date = new \DateTime($task->end_event);
        $st_date->format('m/d/Y');
        $en_date->format('m/d/Y');
        $startdate = $st_date->format('m/d/Y');
        $enddate = $en_date->format('m/d/Y');
        $data = [
            'startdate' => $startdate,
            'enddate' => $enddate,
            'task' => $task,
        ];
        return view('Eventadayoffupdate', $data);
    }
}
