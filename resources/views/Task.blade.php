@extends('master')
@section('content')
    <div id="content" class="content">
        <ol class="breadcrumb float-xl-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">หน้าแรก</a></li>
            <li class="breadcrumb-item active">จัดการกิจกรรมของฉัน</li>
        </ol>
        <h1 class="page-header">จัดการกิจกรรมของฉัน
        </h1>
        <br>
        <div class="row">
            <div class="col-xl-12">
                @if($assign>0)
                    <a href="{{url('assign')}}" class="btn btn-danger pull-right f-s-14 width-60">
                        <i class="fa fa-bell"></i>
                        <span class="pull-right">
                        {{$assign}}
                </span>
                    </a>
                @endif
                <a href="#modal-dialog" class="btn btn-outline-success pull-right" style=" margin-right: 5px;"
                   data-toggle="modal">
                    <i class="fa fa-plus"></i> สร้างกิจกรรม
                </a>
            </div>
            <div class="col-xl-12 col-md-12 col-sm-12">
                <br>
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading" style="background: white;">
                        <h4 class="panel-title"></h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                               data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <table id="data-table-responsive-mytask" width="100%"
                               class="table table-bordered table-hover table-td-valign-middle">
                            <thead>
                            <tr>
                                <th class="text-nowrap">กิจกรรม</th>
                                <th class="text-nowrap">รายละเอียด</th>
                                <th class="text-nowrap">วันเวลาเริ่มต้น</th>
                                <th class="text-nowrap">วันเวลาสิ้นสุด</th>
                                <th class="text-nowrap">สี</th>
                                <th class="text-nowrap">เครื่องมือ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($task as $tasks)
                                @if($tasks->users_ldap==session('ldap_username'))
                                @if($tasks->events_status == 1 or $tasks->events_status == 4 or $tasks->events_status == 9)
                                    <tr class="odd gradeX">
                                        <td style="width: 20%;">
                                            @if($tasks->events_status == 4)
                                                <p
                                                        style="color: orange"><i class="fas fa-lg fa-share-alt-square"></i>
                                                    {{$tasks->events_name}}
                                                    @php $newtask =  new DateTime($tasks->created_at);@endphp
                                                    @if($newtask->format('Y-m-d') == date('Y-m-d'))
                                                        <span class="badge  waitingForConnection text-inverse"
                                                              style="font-size: 14px">New</span>
                                                    @endif</p>
                                            @elseif($tasks->events_status == 1)
                                                {{$tasks->events_name}}
                                                @php $newtask =  new DateTime($tasks->created_at);@endphp
                                                @if($newtask->format('Y-m-d') == date('Y-m-d'))
                                                    <span class="badge  waitingForConnection text-inverse"
                                                          style="font-size: 14px">New</span>
                                                @endif
                                            @elseif($tasks->events_status == 9)
                                                {{$tasks->events_name}}
                                                @php $newtask =  new DateTime($tasks->created_at);@endphp
                                                @if($newtask->format('Y-m-d') == date('Y-m-d'))
                                                    <span class="badge  waitingForConnection text-inverse"
                                                          style="font-size: 14px">New</span>
                                                @endif
                                                <br>
                                                <b style="font-size: 12px;color: red">(หมายเหตุ:{{$tasks->event_note}})</b>
                                            @endif
                                        </td>
                                        <td style="width: 20%;"> {{(!empty( $tasks->event_description)?  $tasks->event_description : '-')}}</td>
                                        <td style="width: 12%;">{{$tasks->thaidatestart}}</td>
                                        <td style="width: 12%;">{{$tasks->thaidateend}}</td>
                                        <td style="width: 2%;"><p class="btn"
                                                                  style="background: {{$tasks->color}};width: 100%;height: 100%;">
                                                &nbsp;</p></td>

                                        <td style="width: 30%; text-align: center">
                                            @if($tasks->events_status == 1 or $tasks->events_status == 4)
                                                <a href="task/update/{{$tasks->events_id}}"
                                                   class="btn  btn-primary width-50">แก้ไข</a>
                                                <a href="#modal-alert{{$tasks->events_id}}"
                                                   class="btn btn-danger width-50"
                                                   data-toggle="modal">ลบ</a>
                                                <a href="#modal-message{{$tasks->events_id}}"
                                                   class="btn btn-warning width-50"
                                                   data-toggle="modal">แชร์</a>
                                                <a href="#modal-dialog{{$tasks->events_id}}"
                                                   class="btn btn-pink width-60"
                                                   data-toggle="modal">ยกเลิก</a>
                                            @elseif($tasks->events_status == 9)
                                                <p style="color: red">ยกเลิก</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                <div class="modal fade" id="modal-dialog{{$tasks->events_id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">  {{$tasks->events_name}}(ยกเลิก)</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <form class="form-horizontal form-bordered"
                                                  action="{{url('/task/cancel')}}"
                                                  method="post">
                                                @csrf
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">หมายเหตุ </label>
                                                    <div class="col-lg-8">
                                                        <div class="input-group date">
                                                            <input type="text" class="form-control" name="event_note"
                                                                   value="" required>
                                                            <input type="text" class="form-control"
                                                                   hidden="hidden" name="id"
                                                                   value="{{$tasks->events_id}}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="javascript:;" class="btn btn-danger"
                                                   data-dismiss="modal">ปิด</a>
                                                <button class="btn btn-primary">ยืนยัน</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade taskshare" id="modal-message{{$tasks->events_id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">แชร์</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×
                                                </button>
                                            </div>
                                            <form class="form-horizontal form-bordered"
                                                  action="{{url('/task/shareevent')}}"
                                                  method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">ผู้ใช้</label>
                                                        <div class="col-lg-4">
                                                            <div class="input-group">
                                                                <input name="user_serach" type="text" mode="shared"
                                                                       class="form-control">
                                                                <span class="input-group-append">
												<button class="btn btn-inverse btn-searchs" type="button" id="{{$tasks->events_id}}" mode="shared"><i
                                                            class="fa fa-search"></i></button>
											</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="row row-space-10">
                                                                <div class="col-lg-12">
                                                                    <select name="user_id" mode="shared" id="{{$tasks->events_id}}"
                                                                            class="form-control mb-3 usersname">
                                                                        <option value="" selected="">ค้นหาผู้ใช้
                                                                        </option>
                                                                    </select>
                                                                    <input type="hidden" name="fullname">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" value="{{$tasks->events_id}}"
                                                           name="events_id">
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:;" class="btn btn-danger"
                                                       data-dismiss="modal">ปิด</a>
                                                    <button class="btn btn-primary">ยืนยัน</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modal-alert{{$tasks->events_id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">ยืนยันการลบ</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">
                                                    ×
                                                </button>
                                            </div>
                                            <form class="form-horizontal form-bordered"
                                                  action="{{url('/task/deletetask')}}"
                                                  method="post">
                                                @csrf
                                                <div class="modal-body" style="font-size: 18px;">
                                                    <div class="alert alert-danger m-b-0">
                                                        <p><b>กิจกรรม</b>&nbsp;{{$tasks->events_name}}</p>
                                                        <p>
                                                            <b>รายละเอียด</b>&nbsp;{{(!empty( $tasks->event_description)?  $tasks->event_description : '-')}}
                                                        </p>
                                                        <p><b>วันเริ่มต้น</b>&nbsp;{{$tasks->thaidatestart}}</p>
                                                        <p><b>วันสิ้นสุด</b>&nbsp;{{$tasks->thaidateend}}</p>
                                                        <p><b>สี</b> &nbsp;&nbsp;<button class="btn width-40"
                                                                                         style="background: {{$tasks->color}};width: 40px;height: 40px;">
                                                                &nbsp;
                                                            </button>
                                                        </p>
                                                        <input type="hidden" value="{{$tasks->events_id}}"
                                                               name="events_id">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:;" class="btn btn-white"
                                                       data-dismiss="modal">ปิด</a>
                                                    <button class="btn btn-danger" type="submit">ลบ</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modal-without-animation{{$tasks->events_id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{$tasks->events_name}}(แก้ไข)</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">
                                                    ×
                                                </button>
                                            </div>
                                            <form class="form-horizontal form-bordered"
                                                  action="{{url('/task/update')}}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label">ชื่อกิจกรรม </label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group date">
                                                                <input type="text" class="form-control" name="names"
                                                                       value="{{$tasks->events_name}}"
                                                                       required/>
                                                                <input type="text" class="form-control"
                                                                       hidden="hidden" name="id"
                                                                       value="{{$tasks->events_id}}"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label">รายละเอียด </label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group date">
                                                        <textarea class="form-control" name="description"
                                                                  rows="8">{{$tasks->event_description}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:;" class="btn btn-danger"
                                                       data-dismiss="modal">ปิด</a>
                                                    <button class="btn btn-primary" type="submit">บันทึก</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            @foreach($affiliateevents as $affiliateevent)
                                <tr class="odd gradeX">
                                    <td style="width: 20%;">
                                            <a style="color: blue"> <i
                                                        class="fas fa-university"></i>
                                                {{$affiliateevent->events_name}}
                                                @php $newaffiliate =  new DateTime($affiliateevent->created_at);@endphp
                                                @if($newaffiliate->format('Y-m-d') == date('Y-m-d'))
                                                    <span class="badge  waitingForConnection text-inverse"
                                                          style="font-size: 14px">New</span>
                                                @endif
                                                <br>
                                                @if($affiliateevent->events_status == 9)
                                                    <br>
                                                    <b style="font-size: 12px;color: red">(หมายเหตุ:{{$affiliateevent->event_note}})</b>
                                                @endif
                                            </a>
                                    </td>
                                    <td style="width: 30%;"> {{(!empty( $affiliateevent->event_description)?  $affiliateevent->event_description : '-')}}</td>
                                    <td style="width: 12%;">{{$affiliateevent->thaidatestart}}</td>
                                    <td style="width: 12%;">{{$affiliateevent->thaidateend}}</td>
                                    <td style="width: 6%;"><p class="btn"
                                                              style="background: {{$affiliateevent->color}};width: 100%;height: 100%;">
                                            &nbsp;</p></td>

                                    <td style="width: 20%; text-align: center">
                                        @if($affiliateevent->event_users_ldap== session('ldap_username'))
                                            <a href="task/update/{{$affiliateevent->events_id}}"
                                               class="btn  btn-primary width-50">แก้ไข</a>
                                            <a href="#modal-alert{{$affiliateevent->events_id}}"
                                               class="btn btn-danger width-50"
                                               data-toggle="modal">ลบ</a>
                                            <a href="#modal-message{{$affiliateevent->events_id}}"
                                               class="btn btn-warning width-50"
                                               data-toggle="modal">แชร์</a>
                                            <a href="#modal-dialog{{$affiliateevent->events_id}}"
                                               class="btn btn-pink width-60"
                                               data-toggle="modal">ยกเลิก</a>
                                            <br>
                                            หน่วยงาน: {{$affiliateevent->affiliate_name}}
                                        @elseif($affiliateevent->events_status == 9)
                                            หน่วยงาน: {{$affiliateevent->affiliate_name}}
                                            <p style="color: red">ยกเลิก</p>
                                    @else
                                            หน่วยงาน: {{$affiliateevent->affiliate_name}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($sharemembers as $sharemember)
                                    <tr class="odd gradeX">
                                        <td style="width: 20%;">
                                            @if($sharemember->events_status == 4)
                                                <a style=""><i class="fas fa-lg fa-users"></i>
                                                    {{$sharemember->events_name}}

                                                    @php $new =  new DateTime($sharemember->created_at);@endphp
                                                    @if($new->format('Y-m-d') == date('Y-m-d'))
                                                        <span class="badge  waitingForConnection text-inverse"
                                                              style="font-size: 14px">New</span>
                                                    @endif
                                                    @elseif($sharemember->events_status == 9)
                                                        {{$sharemember->events_name}}
                                                        @php $newtask =  new DateTime($sharemember->created_at);@endphp
                                                        @if($newtask->format('Y-m-d') == date('Y-m-d'))
                                                            <span class="badge  waitingForConnection text-inverse"
                                                                  style="font-size: 14px">New</span>
                                                        @endif
                                                        <br>
                                                        <b style="font-size: 12px;color: red">(หมายเหตุ:{{$sharemember->event_note}})</b>
                                                    @endif
                                                </a>
                                        </td>
                                        <td style="width: 30%;"> {{(!empty( $sharemember->event_description)?  $sharemember->event_description : '-')}}</td>
                                        <td style="width: 12%;">{{$sharemember->thaidatestart}}</td>
                                        <td style="width: 12%;">{{$sharemember->thaidateend}}</td>
                                        <td style="width: 6%;"><p class="btn"
                                                                  style="background: {{$sharemember->color}};width: 100%;height: 100%;">
                                                &nbsp;</p></td>

                                        <td style="width: 20%; text-align: center">
                                            ผู้แชร์: {{$sharemember->users_name}}
                                            @if($sharemember->events_status == 9)
                                            <p style="color: red">(ยกเลิก)</p>
                                            @endif
                                        </td>
                                    </tr>
                            @endforeach
                            @foreach($groupevent as $groupevents)
                                @if($groupevents->users_ldap == session('ldap_username'))
                                    <tr class="odd gradeX">
                                        <td style="width: 20%;">
                                            @if($groupevents->users_ldap == session('ldap_username'))
                                                <a style="color: deeppink"><i class="fas fa-lg fa-users"></i>
                                                    {{$groupevents->events_name}}

                                                    @php $new =  new DateTime($groupevents->created_at);@endphp
                                                    @if($new->format('Y-m-d') == date('Y-m-d'))
                                                        <span class="badge  waitingForConnection text-inverse"
                                                              style="font-size: 14px">New</span>
                                                    @endif
                                                </a>
                                            @if($groupevents->events_status == 9)
                                                <br>
                                                <b style="font-size: 12px;color: red">(หมายเหตุ:{{$groupevents->event_note}})</b>
                                            @endif
                                            @endif
                                        </td>
                                        <td style="width: 30%;"> {{(!empty( $groupevents->event_description)?  $groupevents->event_description : '-')}}</td>
                                        <td style="width: 12%;">{{$groupevents->thaidatestart}}</td>
                                        <td style="width: 12%;">{{$groupevents->thaidateend}}</td>
                                        <td style="width: 6%;"><p class="btn"
                                                                  style="background: {{$groupevents->color}};width: 100%;height: 100%;">
                                                &nbsp;</p></td>

                                        <td style="width: 20%; text-align: center">
                                            @if($groupevents->event_users_ldap== session('ldap_username'))
                                                <a href="task/update/{{$groupevents->events_id}}"
                                                   class="btn  btn-primary width-50">แก้ไข</a>
                                                <a href="#modal-alert{{$groupevents->events_id}}"
                                                   class="btn btn-danger width-50"
                                                   data-toggle="modal">ลบ</a>
                                                <a href="#modal-message{{$groupevents->events_id}}"
                                                   class="btn btn-warning width-50"
                                                   data-toggle="modal">แชร์</a>
                                                <a href="#modal-dialog{{$groupevents->events_id}}"
                                                   class="btn btn-pink width-60"
                                                   data-toggle="modal">ยกเลิก</a>
                                                <br>
                                                กลุ่มงาน: {{$groupevents->group_name}}
                                            @elseif($groupevents->events_status == 9)
                                                กลุ่มงาน: {{$groupevents->group_name}}
                                                <p style="color: red">ยกเลิก</p>
                                            @elseif($groupevents->users_ldap== session('ldap_username'))
                                                กลุ่มงาน: {{$groupevents->group_name}}
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @foreach($assignees as $assignee)
                                <tr class="odd gradeX">
                                    <td style="width: 20%;">
                                        <i class="fas fa-lg fa-share-square"></i>
                                        {{$assignee->events_name}}
                                        @php $new =  new DateTime($assignee->created_at);@endphp
                                        @if($new->format('Y-m-d') == date('Y-m-d'))
                                            <span class="badge  waitingForConnection text-inverse"
                                                  style="font-size: 14px">New</span>
                                        @endif
                                    </td>
                                    <td style="width: 30%;"> {{(!empty( $assignee->event_description)?  $assignee->event_description : '-')}}</td>
                                    <td style="width: 12%;">{{$assignee->thaidatestart}}</td>
                                    <td style="width: 12%;">{{$assignee->thaidateend}}</td>
                                    <td style="width: 6%;"><p class="btn"
                                                              style="background: {{$assignee->color}};width: 100%;height: 100%;">
                                            &nbsp;</p></td>

                                    <td style="width: 20%; text-align: center">
                                        @if($assignee->creat_users_ldap == session('ldap_username'))
                                            <a href="#modal-without-animation{{$assignee->events_id}}"
                                               class="btn  btn-primary width-80" data-toggle="modal">แก้ไข</a>
                                            <a href="#"
                                               class="btn btn-default width-80"
                                               data-toggle="modal">ลบ</a>
                                            <a href="#"
                                               class="btn btn-default width-50"
                                               data-toggle="modal">แชร์</a>
                                            <br>
                                        @else
                                            ผู้มอบหมาย: {{$assignee->users_name}}
                                            @if($assignee->events_status == 9)
                                                <p style="color: red">(ยกเลิก)</p>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    <div class="modal fade " id="modal-dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">สร้างกิจกรรม</h4>
                </div>
                <form class="form-horizontal form-bordered" id="taskinsert" action="{{url('/addtask/insert')}}"
                      method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="col-xl-12">
                            <div class="panel panel-inverse">
                                <!-- begin col-6 -->
                                <!-- begin panel -->
                                <div class="panel panel-inverse" data-sortable-id="form-plugins-1">

                                    <!-- begin panel-heading -->
                                    <!-- end panel-heading -->
                                    <!-- begin panel-body -->
                                    <div class="panel-body panel-form">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">กิจกรรม</label>
                                            <div class="col-lg-8">
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" name="work" required
                                                           data-toggle="tooltip" data-html="true" title="งาน"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">รายละเอียด</label>
                                            <div class="col-lg-8">
                                                <div class="input-group date">
                                                         <textarea class="form-control" name="description"
                                                                   rows="8"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">สี(กิจกรรมในปฏิทิน)</label>
                                        <div class="col-lg-8">
                                            <div class="input-group colorpicker-component"
                                                 data-color="rgb(0, 0, 0)"
                                                 data-color-format="rgb" id="colorpicker-append">
                                                <input type="text" value="rgb(0, 0, 0)" readonly=""
                                                       name="colort"
                                                       class="form-control" id="colorpicker-append-input"/>
                                                <span class="input-group-append">
												<label class="input-group-text" for="colorpicker-append-input"><i
                                                            class="fa fa-square fa-lg"></i></label>
											</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">เลือกผู้ใช้</label>
                                        <div class="col-lg-8">
                                            <label><input type="radio" id="f-option" name="myRadios"
                                                   onchange="groupshare(this);"/>
                                           กิจกรรมกลุ่มงาน</label>
                                            <input type="radio" name="user_id"
                                                   onchange="mytask(this);" value="" checked hidden/>
                                            <label> <input type="radio" name="myRadios"
                                                   onchange="user(this);"/>
                                            มอบหมายกิจกรรมให้ผู้อื่น</label>
                                            <label><input type="radio" name="myRadios"
                                                   onchange="group(this);"/>
                                          กิจกรรมหน่วยงาน</label>
                                            <select class="form-control div-showgroupshare"
                                                    name="group_id"
                                                    data-size="10" data-live-search="true"
                                                    data-style="btn-white">
                                                <option value="">กลุ่มงาน</option>
                                                @foreach($group as $groups)
                                                    <option value="{{$groups->group_id}}">{{$groups->group_name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="div-showuser">
                                                <div class="form-group row">
                                                    <label class="col-lg-2 col-form-label">ผู้ใช้</label>
                                                    <div class="col-lg-4">
                                                        <div class="input-group">
                                                            <input name="user_serach" type="text" mode="assign"
                                                                   class="form-control">
                                                            <span class="input-group-append">
												<button class="btn btn-inverse btn-searchs" type="button" mode="assign"><i
                                                            class="fa fa-search"></i></button>
											</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="row row-space-10">
                                                            <div class="col-lg-12">
                                                                <select name="user_id" mode="assign"
                                                                        class="form-control mb-3 usersname">
                                                                    <option value="" selected="">ค้นหาผู้ใช้
                                                                    </option>
                                                                </select>
                                                                <input type="hidden" name="fullname">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <select class="form-control div-showgroup"
                                                    name="affiliate_id"
                                                    data-size="10" data-live-search="true"
                                                    data-style="btn-white">
                                                <option value="">หน่วยงาน</option>
                                                @foreach($affiliate as $affiliates)
                                                    <option value="{{$affiliates->affiliate_id}}">{{$affiliates->affiliate_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">วันเวลา</label>
                                        <div class="col-lg-8">
                                            <div id="demo-calendar"></div>
                                            <label>
                                                <input id="start" type="hidden"  placeholder="Please select..." name="startdate"/>
                                            </label>
                                            <label>
                                                <input id="end"  type="hidden"  placeholder="Please select..." name="enddate" />
                                            </label>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal">ปิด</a>
                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-html="true"
                                title="สร้างงาน">บันทึก
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <p class="badge-yellow"></p>
@endsection

<input type="hidden" class="input-hidden-accessToken">

@section('script')
    <script>
        function user(src) {
            $('.div-showuser').show();
            $('.div-showgroup').hide();
            $('.div-showgroupshare').hide();
            // $('.test ').removeClass('badge-warning');
            // $('.test ').addClass('note-warning');
        }
        function group(src) {
            $('.div-showgroup').show();
            $('.div-showuser').hide();
            $('.div-showgroupshare').hide();
            // $('.test ').removeClass('badge-aqua');
            // $('.test ').addClass('badge-warning');
        }
        function groupshare(src) {
            $('.div-showgroup').hide();
            $('.div-showuser').hide();
            $('.div-showgroupshare').show();
            // $('.test ').removeClass('badge-aqua');
            // $('.test ').addClass('badge-warning');
        }
        $('.div-showuser').hide();
        $('.div-showgroup').hide();
        $('.div-showgroupshare').hide();
        $('#data-table-responsive-mytask').DataTable({
            responsive: true,
            "order": [[2, "asc"],],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "lengthMenu": "แสดง _MENU_ รายการ",
                "search": "ค้นหา:",
                "zeroRecords": "ไม่มีข้อมูล",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล",
            }
        });
        var html = '';



        $(document).on("click", ".btn-searchs", function () {
            var mode = $(this).attr('mode'),
                btn_id = $(this).attr('id');
            html = '';
            $.ajax({
                url: "https://e-asset.nsru.ac.th/service/get/sys-token",
                type: "get",
                data: {'userRequestor': 'jirakiat'},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                },
                success: function (response) {

                    $('.input-hidden-accessToken').val(response['accessToken']);
                    var token = $('.input-hidden-accessToken').val();

                    if(btn_id != undefined){
                        var user = $('#modal-message'+btn_id+' input[name="user_serach"][mode="'+mode+'"]').val();
                    } else {
                        var user = $('input[name="user_serach"][mode="'+mode+'"]').val();
                    }

                    serachusername(token, user, mode);
                }
            });
        });




        $(document).on("change", ".usersname", function () {
            var mode = $(this).attr('mode'),
                btn_id = $(this).attr('id');
            if(btn_id != undefined){
                var user = $('#modal-message'+btn_id+' select[name="user_id"][mode="'+mode+'"] option:selected').text();
            } else {
                var user = $('.usersname option:selected').text();
            }
            $('input[name=fullname]').val(user);

        });



        function serachusername(token, user, mode) {
            $.ajax({
                url: "https://e-asset.nsru.ac.th/service/get/search/user-list",
                type: "post",
                data: {
                    'searchTitle': user,
                    'accessToken': token
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                },
                success: function (response) {
                    html = '<option value="">เลือกผู้ใช้</option>';
                    $('.usersname').html('');
                    $.each(response, function (key, value) {
                        optionText = value['userFullName'];
                        optionvalue = value['userID'];
                        html += '<option value="' + optionvalue + '">' + optionText + '</option>';
                    });
                    $('.usersname[mode="'+mode+'"]').append(html);
                }
            });
        }


        $("#taskinsert").on("keypress", function (event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });

        $(".taskshare").on("keypress", function (event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }

        });

        mobiscroll.setOptions({
            locale: mobiscroll.localeEn,
            theme: 'ios',
            themeVariant: 'light'
        });
        $(function () {

            $('#demo-calendar').mobiscroll().datepicker({
                controls: ['calendar', 'time'],
                select: 'range',
                startInput: '#start',
                endInput: '#end',
                touchUi: true,
                display: 'inline',
            });
        });


    </script>
@endsection











