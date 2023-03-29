<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\AffiliateShare;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NSRU\App;

class UserController extends Controller
{
    private $myAuth;
    private $app;
    private $dc;

    public function __construct()
    {
        $app_id = "6089450093";
        $app_secret = "JKFXQ3M3VBZRBESELEMN";

        $this->app = new App($app_id, $app_secret);
        $this->myAuth = $this->app->createMyAuth();
        $this->dc = $this->app->createDataCore();
    }

    public function signin(Request $request)
    {
        if ($request->session()->has('full_name', 'ldap_username', 'portrait_image')) {
            return redirect(url('/'));
        } else {
            $target_url = url('signin_postback');
            $signin_url = $this->myAuth->getSigninURL($target_url, ['_token' => csrf_token()]);
            return redirect($signin_url);
        }

    }

    public function signin_postback(Request $request)
    {
        $student_info = $this->dc->find_student($request->input('username'));
        if ($student_info == false) {
            $student_info = $this->dc->find_staff($request->input('username'));
        }
        $checkuser = User::where('users_ldap', $student_info->ldap_username)->first();

        $statususer = null;
        if (isset($checkuser)) {
            $statususer = $checkuser->status_id;
        }
        $checkuserform = User::where('users_ldap', $student_info->ldap_username)->first();
        if(!isset($checkuserform)){
            $objuser = new User();
            $objuser->users_name=$student_info->full_name;
            $objuser->users_ldap=$student_info->ldap_username;
            $objuser->save();
        }

        $session_set = [
            "full_name" => $student_info->full_name,
            "ldap_username" => $student_info->ldap_username,
            "portrait_image" => $student_info->portrait_image,
            "statususer" => $statususer,
        ];
        $request->session()->put($session_set);
        return redirect(url('/dashboard'));
    }

    public function signout()
    {
        $logout_url = url('signout_postback');
        $signout_url = $this->myAuth->getSignoutURL($logout_url);
        return redirect($signout_url);
    }

    public function signout_postback(Request $request)
    {
        $request->session()->forget(['full_name', 'ldap_username', 'portrait_image', 'statususer']);
        $this->myAuth->doSignoutPostback();
        return redirect(url('/signin'));
    }

    public function profile(Request $request)
    {
        $dataaffiliate = DB::table('affiliates')
            ->join('affiliate_shares', 'affiliate_shares.affiliate_id', '=', 'affiliates.affiliate_id')
            ->where('affiliate_shares.users_ldap','=',$request->session()->get('ldap_username'))
            ->select('affiliate_shares.*', 'affiliates.*')
            ->get();
        $datagroup=DB::table('groups')
            ->join('group_shares','group_shares.group_id','=','groups.group_id')
            ->where('group_shares.users_ldap','=',$request->session()->get('ldap_username'))
            ->select('group_shares.*','groups.*')
            ->get();
        $share = DB::table('event_shares')->where('users_ldap', '=', $request->session()->get('ldap_username'))->where('event_shares_statuss', '!=', 2)->count('event_shares_id');
        $assign = DB::table('assignees')->where('users_ldap', '=', $request->session()->get('ldap_username'))->where('assignees_status', '!=', 2)->count('assignees_id');
        $sharemember = DB::table('event_shares')->where('share_users_ldap', '=', $request->session()->get('ldap_username'))->where('event_shares_statuss', '!=', 2)->count('event_shares_id');
        $assignmember = DB::table('assignees')->where('creat_users_ldap', '=', $request->session()->get('ldap_username'))->where('assignees_status', '!=', 2)->count('assignees_id');
        $data=[
          'affiliate'=>$dataaffiliate,
          'group'=>$datagroup,
          'share'=>$share,
          'assign'=>$assign,
          'assignmember'=>$assignmember,
          'sharemember'=>$sharemember,
        ];
        return view('Profile',$data);
    }

    public function pdf()
    {
        return view('Pdf');
    }
    public function eventaffiliate(Request $request,$id){
        $affiliateevents = DB::table('event_affiliates')
            ->join('events', 'events.events_id', '=', 'event_affiliates.events_id')
            ->join('affiliates', 'affiliates.affiliate_id', '=', 'event_affiliates.affiliate_id')
            ->where('event_affiliates.affiliate_id', '=', $id)
            ->where('event_affiliates.users_ldap', '=', $request->session()->get('ldap_username'))
            ->where('events.events_status', '=', 5)
            ->orderBy('events.start_event','DESC')
            ->select('events.*', 'event_affiliates.*', 'affiliates.*')
            ->get();
        $x = array();
        $y = 0;
        foreach ($affiliateevents as $affiliateevent) {
            $x[$y] = $affiliateevent;
            $x[$y]->thaidatestart = $this->formatDateThat($affiliateevent->start_event);
            $x[$y]->thaidateend = $this->formatDateThat($affiliateevent->end_event);
            $y = $y + 1;
        }
        $data=[
            'affiliate'=>$affiliateevents,
        ];
        return view('EventsAffiliate',$data);

    }
    public function eventgroup(Request $request,$id){
        $groupevent = DB::table('event_groups')
            ->join('events', 'events.events_id', '=', 'event_groups.events_id')
            ->join('groups', 'groups.group_id', '=', 'event_groups.group_id')
            ->where('event_groups.users_ldap', '=', $request->session()->get('ldap_username'))
            ->where('event_groups.group_id', '=', $id)
            ->where('events.events_status', '=', 6)
            ->orderBy('events.start_event','DESC')
            ->select('events.*', 'event_groups.*', 'groups.*')
            ->get();
        $x = array();
        $y = 0;
        foreach ($groupevent as $groupevents) {
            $x[$y] = $groupevents;
            $x[$y]->thaidatestart = $this->formatDateThat($groupevents->start_event);
            $x[$y]->thaidateend = $this->formatDateThat($groupevents->end_event);
            $y = $y + 1;
        }
        $data=[
            'groupevent'=>$groupevent,
        ];
        return view('Eventgroups',$data);
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


    protected function xxx(Request $request){
        $url = 'http://e-asset.nsru.ac.th/service/get/sys-token '; // กำหนด URl ของเว็บไวต์ B
        $request = 'userRequestor=jirakiat'; // กำหนด HTTP Request โดยระบุ username=guest และ password=เguest (รูปแบบเหมือนการส่งค่า $_GET แต่ข้างหน้าข้อความไม่มีเครื่องหมาย ?)

        $ch = curl_init(); // เริ่มต้นใช้งาน cURL

        curl_setopt($ch, CURLOPT_URL, $url); // กำหนดค่า URL
        curl_setopt($ch, CURLOPT_POST, 1); // กำหนดรูปแบบการส่งข้อมูลเป็นแบบ $_POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request); // กำหนดค่า HTTP Request
        curl_setopt($ch, CURLOPT_HEADER, 0); // กำให้ cURL ไม่มีการตั้งค่า Header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // กำหนดให้ cURL คืนค่าผลลัพท์

        $response = curl_exec($ch); // ประมวลผล cURL
        curl_close($ch); // ปิดการใช้งาน cURL

        echo $response; // แสดงผลการทำงาน
    }
    public function linemessage($ldap_username,$message)
    {
        $html_head = '';
        $html_body = '
    <h3>ข้อมูลผู้ลงทะเบียนใหม่</h3> ';
// ของระบบ ems  $mail = new \NSRU\Messenger\Mail('HHK6RRDEZZ6H8EEFO4HI');
//        $mail = new \NSRU\Messenger\Mail('UWGC6SPU0S2YRG5R3C3L');
//        $mail->set_from('employment@nsru.ac.th', 'register employment');
//        $mail->add_receiver('kunlada@nsru.ac.th', 'kunlada suansala');
//        $mail->send($html_head, $html_body);

        $line = new \NSRU\Messenger\Bot();
        $status_sent_line = $line->push_once($ldap_username, $message, [
            'FRAKR-J8D44-Z56J7-SAZJI-9873O-37T1H-K6FA2-XKDQ4'
        ]);
    }

}
