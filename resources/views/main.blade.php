@extends('master')
@section('content')
    <div id="content" class="content" style="background: whitesmoke">
        <ol class="breadcrumb float-xl-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">หน้าแรก</a></li>
            <li class="breadcrumb-item active">ปฏิทินของฉัน</li>
        </ol>
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
{{--        <h1 class="page-header">แจ้งเตือน<small></small></h1>--}}
{{--        <div class="row" style="margin: auto" id="tests">--}}
{{--            <div class="col-xl-3 col-md-6">--}}
{{--                <div class="widget widget-stats bg-blue">--}}
{{--                    <div class="stats-icon"><i class="fas fa-share-square"></i></div>--}}
{{--                    <div class="stats-info">--}}
{{--                        <h4 style="font-size: 20px;">กิจกรรมที่ได้รับหมอบหมาย</h4>--}}
{{--                        <p> {{$assignshow}} รายการ</p>--}}
{{--                    </div>--}}
{{--                    <div class="stats-link">--}}
{{--                        <a href="{{url('assign')}}">ดูรายละเอียด <i class="fa fa-arrow-alt-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xl-3 col-md-6">--}}
{{--                <div class="widget widget-stats bg-blue">--}}
{{--                    <div class="stats-icon"><i class="fa fa-bell"></i></div>--}}
{{--                    <div class="stats-info">--}}
{{--                        <h4 style="font-size: 20px;">แจ้งเตือนกิจกรรมที่ได้รับหมอบหมาย</h4>--}}
{{--                        <p>{{$assign}} รายการ</p>--}}
{{--                    </div>--}}
{{--                    <div class="stats-link">--}}
{{--                        <a href="{{url('assign')}}">ดูรายละเอียด <i class="fa fa-arrow-alt-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- end col-3 -->--}}
{{--            <!-- begin col-3 -->--}}
{{--            <div class="col-xl-3 col-md-6">--}}
{{--                <div class="widget widget-stats bg-blue">--}}
{{--                    <div class="stats-icon"><i class="fa fa-link"></i></div>--}}
{{--                    <div class="stats-info">--}}
{{--                        <h4 style="font-size: 20px;">กิจกรรมที่ผู้อื่นแชร์</h4>--}}
{{--                        <p>{{$shareshow}} รายการ</p>--}}
{{--                    </div>--}}
{{--                    <div class="stats-link">--}}
{{--                        <a href="{{url('eventshare')}}">ดูรายละเอียด <i--}}
{{--                                    class="fa fa-arrow-alt-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xl-3 col-md-6">--}}
{{--                <div class="widget widget-stats bg-blue">--}}
{{--                    <div class="stats-icon"><i class="fa fa-bell"></i></div>--}}
{{--                    <div class="stats-info">--}}
{{--                        <h4 style="font-size: 20px;">แจ้งเตือนกิจกรรมที่ผู้อื่นแชร์</h4>--}}
{{--                        <p>{{$share}} รายการ</p>--}}
{{--                    </div>--}}
{{--                    <div class="stats-link">--}}
{{--                        <a href="{{url('eventshare')}}">ดูรายละเอียด <i--}}
{{--                                    class="fa fa-arrow-alt-circle-right"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- end page-header -->--}}
{{--        <hr/>--}}
        <!-- begin vertical-box -->
        <h1 class="page-header">ปฏิทินของฉัน<small></small></h1>
    <hr/>
        <div class="vertical-box">
        <div id="calendar" class="calendar" style="width: 100%;">
        </div>
        <br>
            <!-- begin event-list -->
            <!-- end event-list -->
            <!-- begin calendar -->
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
            <!-- end vertical-box -->
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
                        defaultView: 'month',
                        locale: 'th',
                        firstDay: 0,
                        header: {
                            left: 'month,agendaWeek,listWeek,listMonth,listYear',
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
                        $('#calendar').fullCalendar('changeView', 'listMonth', {});
                        $('#tests').hide();
                    } else {
                        $('#calendar').fullCalendar('changeView', 'month', {});
                        $('#tests').show();
                    }
                }

                var x = window.matchMedia("(max-width: 1080px)")
                myFunction(x)
                x.addListener(myFunction)


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
            </script>

@endsection


