@extends('master')
@section('content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb float-xl-right">
            <li class="breadcrumb-item active">แดชบอร์ด</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        @if($assign>0 || $share>0)
            @php  $count=$assign+$share;   @endphp
            <h1 class="page-header">แจ้งเตือน <span class="badge bade-danger bg-blue">มีรายการที่ยังไม่ได้ดำเนินการทั้งหมด {{$count}} รายการ</span><small></small></h1>
    @endif
    <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <div class="col-lg-12 col-md-6">
                @foreach($sharemember as $sharemembers)
                    <div class="alert alert-danger">
                        <div class="row">
                            <div class="col-md-8">
                                <p style="font-size: 16px;">
                                    <strong>ชื่อกิจกรรม: </strong>{{$sharemembers->events_name}}
                                    <strong>รายละเอียด: </strong>{{(!empty( $sharemember->event_description)?  $sharemember->event_description : '-')}}
                                    <strong>ผู้แชร์กิจกรรม: </strong>{{$sharemembers->users_name}}
                                    <strong>วันเริ่มต้น: </strong>{{$sharemembers->thaidatestart}}
                                    <strong>วันสิ้นสุด: </strong>{{$sharemembers->thaidateend}}
                                    <span class="badge bade-danger bg-warning w-20"><i
                                                class="fas fa-share-alt"></i> แชร์</span>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <a href="#" class="close ml-3" data-dismiss="alert" aria-label="close" title="ปิด">&times;</a>
                                <a href="#modal-alert{{$sharemembers->event_shares_id}}"
                                   class="btn btn-sm btn-danger  pull-right ml-1"
                                   data-toggle="modal">ไม่ยอมรับ
                                </a>
                                <a href="#modal-dialog{{$sharemembers->event_shares_id}}"
                                   class="btn  btn-sm btn-success pull-right" data-toggle="modal">
                                    <i class="fa fa-check"></i> ยอมรับ
                                </a>

                                <br>
                                <br>
                                <span class="pull-right">หมายเหตุ : รายการนี้ต้องได้รับการ <b>ยอมรับ</b> จากท่าน จึงจะปรากฏใน <b>ปฏิทินของฉัน</b> </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-dialog{{$sharemembers->event_shares_id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">ยอมรับ</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×
                                    </button>
                                </div>
                                <form class="form-horizontal form-bordered"
                                      action="{{url('eventshare/accept')}}"
                                      method="post">
                                    @csrf
                                    <div class="modal-body" style="font-size: 18px;">
                                        <p><b>กิจกรรม</b>&nbsp;{{$sharemembers->events_name}}</p>
                                        <p>
                                            <b>รายละเอียด</b>&nbsp;{{(!empty( $sharemembers->event_description)?  $sharemembers->event_description : '-')}}
                                        </p>
                                        <p><b>ผู้เพิ่มกิจกรรม</b>&nbsp;{{$sharemembers->users_name}}
                                        </p>
                                        <p><b>วันเริ่มต้น</b>&nbsp;{{$sharemembers->thaidatestart}}</p>
                                        <p><b>วันสิ้นสุด</b>&nbsp;{{$sharemembers->thaidateend}}</p>
                                        <p><b>สี</b> &nbsp;&nbsp;<button class="btn width-40"
                                                                         style="background: {{$sharemembers->color}};width: 40px;height: 40px;">
                                                &nbsp;
                                            </button>
                                        </p>
                                        <input type="hidden" value="{{$sharemembers->events_id}}"
                                               name="events_id">
                                        <input type="hidden" value="{{$sharemembers->event_shares_id}}"
                                               name="shareid">
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white"
                                           data-dismiss="modal">ปิด</a>
                                        <button class="btn btn-success" type="submit">ยืนยัน</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-alert{{$sharemembers->event_shares_id}}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">ไม่ยอมรับ</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">
                                        ×
                                    </button>
                                </div>
                                <form class="form-horizontal form-bordered"
                                      action="{{url('/eventshare/reject')}}"
                                      method="post">
                                    @csrf
                                    <div class="modal-body" style="font-size: 18px;">
                                        <div class="alert alert-danger m-b-0">
                                            <p><b>กิจกรรม</b>&nbsp;{{$sharemembers->events_name}}</p>
                                            <p>
                                                <b>รายละเอียด</b>&nbsp;{{(!empty( $sharemembers->event_description)?  $sharemembers->event_description : '-')}}
                                            </p>
                                            <p>
                                                <b>ผู้ที่แชร์กิจกรรม</b>&nbsp;{{$sharemembers->users_name}}
                                            </p>
                                            <p><b>วันเริ่มต้น</b>&nbsp;{{$sharemembers->thaidatestart}}</p>
                                            <p><b>วันสิ้นสุด</b>&nbsp;{{$sharemembers->thaidateend}}</p>
                                            <p><b>สี</b> &nbsp;&nbsp;<button class="btn width-40"
                                                                             style="background: {{$sharemembers->color}};width: 40px;height: 40px;">
                                                    &nbsp;
                                                </button>
                                            </p>
                                            <input type="hidden" value="{{$sharemembers->events_id}}"
                                                   name="events_id">
                                            <input type="hidden" value="{{$sharemembers->event_shares_id}}"
                                                   name="shareid">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white"
                                           data-dismiss="modal">ปิด</a>
                                        <button class="btn btn-danger" type="submit">ไม่ยอมรับ</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($assignee as $assignees)
                    <div class="alert alert-danger">
                        <div class="row">
                            <div class="col-md-8">
                                <p style="font-size: 16px;">
                                <strong>ชื่อกิจกรรม: </strong>{{$assignees->events_name}}
                                <strong>รายละเอียด: </strong>{{(!empty( $assignees->event_description)?  $assignees->event_description : '-')}}
                                <strong>ผู้มอบหมายกิจกรรม: </strong>{{$assignees->users_name}}
                                <strong>วันเวลา: </strong>{{$assignees->thaidatestart}}
                                ถึง {{$assignees->thaidateend}}
                                <span class="badge bade-danger bg-green w-20"><i
                                            class="fas fa-share-square"></i> มอบหมาย</span>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <a href="#" class="close ml-3" data-dismiss="alert" aria-label="close" title="ปิด">&times;</a>
                                <a href="#modal-alert{{$assignees->assignees_id}}"
                                   class="btn btn-sm btn-danger  pull-right ml-1"
                                   data-toggle="modal">ไม่ยอมรับ
                                </a>
                                <a href="#modal-dialog{{$assignees->assignees_id}}"
                                   class="btn  btn-sm btn-success pull-right" data-toggle="modal">
                                    <i class="fa fa-check"></i> ยอมรับ
                                </a>

                                <br>
                                <br>
                                <span class="pull-right">หมายเหตุ : รายการนี้ต้องได้รับการ <b>ยอมรับ</b> จากท่าน จึงจะปรากฏใน <b>ปฏิทินของฉัน</b> </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-dialog{{$assignees->assignees_id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">ยืมยันกิจกรรมที่ได้รับมอบหมาย<br><small>(หากยอมรับแล้วกิจกรรมจะปรากฏที่ปฏิทินของฉัน)</small>
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×
                                    </button>
                                </div>
                                <form class="form-horizontal form-bordered"
                                      action="{{url('/assign/accept')}}"
                                      method="post">
                                    @csrf
                                    <div class="modal-body" style="font-size: 18px;">
                                        <p><b>กิจกรรม</b>&nbsp;{{$assignees->events_name}}</p>
                                        <p>
                                            <b>รายละเอียด</b>&nbsp;{{(!empty( $assignees->event_description)?  $assignees->event_description : '-')}}
                                        </p>
                                        <p><b>ผู้เพิ่มกิจกรรม</b>&nbsp;{{$assignees->users_name}}
                                        </p>
                                        <p><b>วันเริ่มต้น</b>&nbsp;{{$assignees->thaidatestart}}</p>
                                        <p><b>วันสิ้นสุด</b>&nbsp;{{$assignees->thaidateend}}</p>
                                        <p><b>สี</b> &nbsp;&nbsp;<button class="btn width-40"
                                                                         style="background: {{$assignees->color}};width: 40px;height: 40px;">
                                                &nbsp;
                                            </button>
                                        </p>
                                        <input type="hidden" value="{{$assignees->events_id}}"
                                               name="events_id">
                                        <input type="hidden" value="{{$assignees->assignees_id}}"
                                               name="assignees_id">
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white"
                                           data-dismiss="modal">ปิด</a>
                                        <button class="btn btn-success" type="submit">ยืนยัน</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-alert{{$assignees->assignees_id}}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">ไม่ยอมรับ</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">
                                        ×
                                    </button>
                                </div>
                                <form class="form-horizontal form-bordered"
                                      action="{{url('/assign/reject')}}"
                                      method="post">
                                    @csrf
                                    <div class="modal-body" style="font-size: 18px;">
                                        <div class="alert alert-danger m-b-0">
                                            <p><b>กิจกรรม</b>&nbsp;{{$assignees->events_name}}</p>
                                            <p>
                                                <b>รายละเอียด</b>&nbsp;{{(!empty( $assignees->event_description)?  $assignees->event_description : '-')}}
                                            </p>
                                            <p><b>ผู้เพิ่มกิจกรรม</b>&nbsp;{{$assignees->users_name}}
                                            </p>
                                            <p><b>วันเริ่มต้น</b>&nbsp;{{$assignees->thaidatestart}}</p>
                                            <p><b>วันสิ้นสุด</b>&nbsp;{{$assignees->thaidateend}}</p>
                                            <p><b>สี</b> &nbsp;&nbsp;<button class="btn width-40"
                                                                             style="background: {{$assignees->color}};width: 40px;height: 40px;">
                                                    &nbsp;
                                                </button>
                                            </p>
                                            <input type="hidden" value="{{$assignees->events_id}}"
                                                   name="events_id">
                                            <input type="hidden" value="{{$assignees->assignees_id}}"
                                                   name="assignees_id">
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
                @endforeach

            </div>
        </div>
        <h1 class="page-header">เมนู<small></small></h1>
        @if (session('error'))
            <div style="text-align: left; font-size: 16px; color: #ff0000;text-align: center;"
                 class="alert alert-danger fade show">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <i class="fas fa-lg fa-fw mr-10 fa-times-circle"></i>{{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="widget">
                    <a href="{{url('/main')}}" class="btn btn-outline-primary"
                       style="width: 100%;height: 80px;">
                        <div class="stats-info">
                            <h4 style="font-size: 20px;padding-top: 20px">ปฏิทินของฉัน <i
                                        class="fa fa-lg fa-calendar"></i></h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="widget">
                    <a href="{{url('task')}}" class="btn btn-outline-warning" style="width: 100%;height: 80px">
                        <div class="stats-info">
                            <h4 style="font-size: 20px;padding-top: 20px">จัดการกิจกรรม <i
                                        class="fa fa-lg fa-edit"></i>
                            </h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="widget">
                    <a href="{{url('assign')}}" class="btn btn-outline-danger" style="width: 100%;height: 80px">
                        <div class="stats-info">
                            <h4 style="font-size: 20px;padding-top: 20px">กิจกรรมที่ฉันได้รับมอบหมาย <i
                                        class="fa fa-share-square"></i></h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="widget">
                    <a href="{{url('eventshare')}}" class="btn btn-outline-success"
                       style="width: 100%;height: 80px">
                        <div class="stats-info">
                            <h4 style="font-size: 20px;padding-top: 20px">กิจกรรมที่แชร์กับฉัน <i
                                        class="fas fa-share-alt"></i></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="panel panel-inverse" style="background: white">
            <!-- begin panel-heading -->
            <div class="panel-heading" style="background: white;">
                <h4 class="panel-title" style="color: black;font-size: 16px;">กิจกรรมวันนี้</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                       data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <div class="row col-lg-12" style="margin: auto;text-align: center;height: auto;width: auto">
                    <div class="col-xl-6 col-sm-6">
                        <br>
                        <b style="font-size: 20px;">กิจกรรมประจำวัน</b>
                        <div id="calendar" class="calendar scollshow inner-border"
                             style="height: 350px;width: 100%">
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-6">
                        <br>
                        <b style="font-size: 20px">กิจกรรมประจำสัปดาห์</b>
                        <div id="calendar2" class="calendar  scollshow inner-border"
                             style="height: 350px;width: 100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade showmodal" id="modal-dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-hover">
                            <tbody>
                            <tr>
                                <td style="width: 120px"><b>รายละเอียด</b></td>
                                <td><p class="description">&nbsp;</p></td>
                            </tr>
                            <tr>
                                <td style="width: 120px"><b>วันเริ่มต้น</b></td>
                                <td><p class="startdate">&nbsp;</p></td>
                            </tr>
                            <tr>
                                <td style="width: 120px"><b>วันสิ้นสุด</b></td>
                                <td><p class="enddate">&nbsp;</p></td>
                            </tr>
                            <tr class="showassign">
                                <td style="width: 120px"><b>ผู้มอบหมายกิจกรรม</b></td>
                                <td><p class="usercreat">&nbsp;</p></td>
                            </tr>
                            <tr class="showshare">
                                <td style="width: 120px"><b>ผู้แชร์กิจกรรม</b></td>
                                <td><p class="usershare">&nbsp;</p></td>
                            </tr>
                            <tr class="showaffiliate">
                                <td style="width: 120px"><b>หน่วยงาน</b></td>
                                <td><p class="affiliatename">&nbsp;</p></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal">ปิด</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="theme-panel theme-panel-lg">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog" title="ตั้งค่าการแจ้งเตือน"></i></a>
            <div class="theme-panel-content">
                <form action="{{url('/dashboard')}}" method="get" id="filter-assign-list">
                    @csrf
                <h5>ตั้งค่าแจ้งเตือนปฏิทิน</h5>
                    <div class="divider"></div>
                    <div class="row m-t-10">
                        <div class="col-6 control-label text-inverse f-w-600">ยอมรับ</div>
                        <div class="col-6 d-flex">

                                <input type="radio" name="checkacept" value="1" {{$check1}}>&nbsp;

                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-6 control-label text-inverse f-w-600">ไม่ยอมรับ</div>
                        <div class="col-6 d-flex">

                                <input type="radio" name="checkacept" value="3" {{$check2}}>&nbsp;

                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-6 control-label text-inverse f-w-600">เพิกเฉย</div>
                        <div class="col-6 d-flex">

                                <input type="radio" name="checkacept" value="5" {{$check3}}>&nbsp;


                        </div>
                    </div>
                    <div class="divider"></div>
                </form>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var calendar = $('#calendar').fullCalendar({
                eventClick: function (info) {
                    alert('Event: ' + info.event.title);
                    alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    alert('View: ' + info.view.type);

                    // change the border color just for fun
                    info.el.style.borderColor = 'red';
                },
                eventRender: function (event, element) {
                    if (event.icon == null) {
                        event.icon = '';
                    }
                    element.find('.fc-title').append(" " + event.icon);
                    element.find('.fc-list-item-title').append(" " + event.icon);
                },
                displayEventTime: false,
                eventLimit: true,
                draggable: false,
                defaultView: 'list',
                locale: 'th',
                firstDay: 0,
                header: {
                    center: 'title',
                    right: 'prev,next',
                },
                events: 'master/get-data',
                eventClick: function (event, jsEvent, view) {
                    if (event.usercreat == null) {
                        $('.showassign').addClass('d-none');
                        event.usercreat = '&nbsp;-';
                    } else {
                        $('.showassign').removeClass('d-none');
                    }
                    if (event.usershare == null) {
                        $('.showshare').addClass('d-none');
                        event.usershare = '&nbsp;-';
                    } else {
                        $('.showshare').removeClass('d-none');
                    }
                    if (event.affiliate == null) {
                        $('.showaffiliate').addClass('d-none');
                        event.affiliate = '&nbsp;-';
                    } else {
                        $('.showaffiliate').removeClass('d-none');
                    }
                    if (event.description == null) {
                        event.description = '&nbsp;-';
                    }
                    if (event.icon == null) {
                        event.icon = '';
                    }
                    $('.showmodal').modal('show');
                    $('.modal-title').html(event.icon + event.title + " ");
                    $('.description').html("&nbsp;" + event.description);
                    $('.startdate').html("&nbsp;" + event.dateStartTxt);
                    $('.enddate').html("&nbsp;" + event.dateEndTxt);
                    $('.usercreat').html("&nbsp;" + event.usercreat);
                    $('.usershare').html("&nbsp;" + event.usershare);
                    $('.affiliatename').html("&nbsp;" + event.affiliate);
                }
            });
        });
        $('.closemodal').click(function () {
            $('.showmodal').removeClass('show');
        });

        function myFunction(x) {
            if (x.matches) {
                $('#calendar').fullCalendar('changeView', 'listWeek', {});
                $('#tests').hide();
            } else {
                $('#calendar').fullCalendar('changeView', 'listWeek', {});
                $('#tests').show();
            }
        }

        var x = window.matchMedia("(max-width: 1080px)")
        myFunction(x)
        x.addListener(myFunction)
        $(document).ready(function () {
            var calendar = $('#calendar2').fullCalendar({
                eventClick: function (info) {
                    alert('Event: ' + info.event.title);
                    alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    alert('View: ' + info.view.type);

                    // change the border color just for fun
                    info.el.style.borderColor = 'red';
                },
                eventRender: function (event, element) {
                    if (event.icon == null) {
                        event.icon = '';
                    }
                    element.find('.fc-title').append(" " + event.icon);
                    element.find('.fc-list-item-title').append(" " + event.icon);
                },
                displayEventTime: false,
                eventLimit: true,
                draggable: false,
                defaultView: 'listWeek',
                locale: 'th',
                firstDay: 0,
                header: {
                    center: 'title',
                    right: 'prev,next',
                },
                events: 'master/get-data',
                eventClick: function (event, jsEvent, view) {
                    if (event.usercreat == null) {
                        $('.showassign').addClass('d-none');
                        event.usercreat = '&nbsp;-';
                    } else {
                        $('.showassign').removeClass('d-none');
                    }
                    if (event.usershare == null) {
                        $('.showshare').addClass('d-none');
                        event.usershare = '&nbsp;-';
                    } else {
                        $('.showshare').removeClass('d-none');
                    }
                    if (event.affiliate == null) {
                        $('.showaffiliate').addClass('d-none');
                        event.affiliate = '&nbsp;-';
                    } else {
                        $('.showaffiliate').removeClass('d-none');
                    }
                    if (event.description == null) {
                        event.description = '&nbsp;-';
                    }
                    if (event.icon == null) {
                        event.icon = '';
                    }
                    $('.showmodal').modal('show');
                    $('.modal-title').html(event.icon + event.title + " ");
                    $('.description').html("&nbsp;" + event.description);
                    $('.startdate').html("&nbsp;" + event.dateStartTxt);
                    $('.enddate').html("&nbsp;" + event.dateEndTxt);
                    $('.usercreat').html("&nbsp;" + event.usercreat);
                    $('.usershare').html("&nbsp;" + event.usershare);
                    $('.affiliatename').html("&nbsp;" + event.affiliate);
                }
            });
        });


        setTimeout(function () {
            $('.fc-prev-button').mouseenter(function () {
                $(this).css("background", "#2CACFF");
            }).mouseleave(function () {
                $(this).css("background", "#fff");
            });
        }, 2000);
        setTimeout(function () {
            $('.fc-next-button').mouseenter(function () {
                $(this).css("background", "#2CACFF");
            }).mouseleave(function () {
                $(this).css("background", "#fff");
            });
        }, 2000);

        $('input[name="checkacept"]').change(function () {
            $("#filter-assign-list").submit();
        });
    </script>

@endsection
