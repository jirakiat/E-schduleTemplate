@extends('master')
@section('content')
    <div id="content" class="content" >
        <ol class="breadcrumb float-xl-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">หน้าแรก</a></li>
            <li class="breadcrumb-item active">กิจกรรมที่ฉันได้รับมอบหมาย</li>
        </ol>
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">กิจกรรมที่ฉันได้รับมอบหมาย <small></small></h1>
        <!-- end page-header -->
        <hr/>
        <!-- begin vertical-box -->
        <div class="vertical-box">
            <!-- begin event-list -->

            <div class="vertical-box-column p-r-30 d-none d-lg-table-cell" style="width: 215px">
                <div class="table-responsive">
                    <div id="external-events" class="fc-event-list">
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <form action="{{url('assign')}}" method="get" id="filter-assign-list">
                                @csrf
                                <tr>
                                    <td class="with-img">
                                        <label> <input type="radio" name="check" value="0" {{$checked1}}>&nbsp;กิจกรรมที่ฉันได้รับมอบหมาย</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="with-img">
                                        <label> <input type="radio" name="check" value="1" {{$checked2}}>&nbsp;ยอมรับ</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="with-img">
                                        <label> <input type="radio" name="check" value="3" {{$checked3}}>&nbsp;&nbsp;ไม่ยอมรับ</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="with-img">
                                        <label> <input type="radio" name="check" value="5" {{$checked4}}>&nbsp;&nbsp;เพิกเฉย</label>
                                    </td>
                                </tr>
                            </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end event-list -->
            <!-- begin calendar -->
            <div class="col-xl-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading" style="background: white">
                        <h4 class="panel-title"style="color: black;"></h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                               data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <table id="data-table-responsive-assign" width="100%"
                               class="table table-bordered table-td-valign-middle">
                            <thead>
                            <tr>
                                <th class="text-nowrap">กิจกรรม</th>
                                <th class="text-nowrap">รายละเอียด</th>
                                <th class="text-nowrap">ผู้ที่เพิ่มกิจกรรม</th>
                                <th class="text-nowrap">วันเวลากิจกรรม</th>
                                <th class="text-nowrap">วันเวลาดำเนินการ</th>
                                <th class="text-nowrap">สี</th>
                                <th class="text-nowrap">เครื่องมือ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($assign as $assigns)
                                <?php
                                if ($assigns->assignees_status == 0) {
                                    $icon = 'fas fa-spinner fa-pulse';
                                    $color = '';
                                } elseif ($assigns->assignees_status == 3) {
                                    $icon = 'fa fa-times-circle';
                                    $color = 'red';
                                } elseif ($assigns->assignees_status == 1) {
                                    $icon = 'fa fa-check-circle';
                                    $color = 'green';
                                }
                                elseif ($assigns->assignees_status == 5) {
                                    $icon = 'far fa-eye-slash';
                                    $color = '';
                                } elseif ($assigns->assignees_status == 9) {
                                    $icon = 'far fa-window-close';
                                    $color = 'red';
                                }
                                else{
                                    $icon='';
                                    $color = '';
                                }
                                ?>
                                <tr class="odd gradeX">
                                    @if($assigns->assignees_status != 5)
                                    <td style="width: 20%;"><i class="{{$icon}}"
                                                               style="color: {{$color}}"></i>&nbsp;{{$assigns->events_name}}
                                    </td>
                                    @else
                                        <td style="width: 20%;text-decoration:line-through"><i class="{{$icon}}"
                                                                   style="color: {{$color}}"></i>&nbsp;{{$assigns->events_name}}
                                        </td>
                                    @endif
                                    <td style="width: 30%;"> {{(!empty( $assigns->event_description)?  $assigns->event_description : '-')}}</td>
                                    <td style="width: 5%;">{{$assigns->users_name}}</td>
                                    <td style="width: 10%;">{{$assigns->thaidatestart}}-{{$assigns->thaidateend}}</td>
                                    <td style="width: 5%;">{{(!empty( $assigns->thaivertifytime)?  $assigns->thaivertifytime : '-')}}</td>
                                    <td style="width: 5%;"><p class="btn"
                                                              style="background: {{$assigns->color}};width: 100%;height: 100%;">
                                            &nbsp;</p></td>
                                    @if($assigns->assignees_status == 3)
                                        <td style="text-align: center">
                                            <p style="color: red">ท่านไม่ยอมรับ</p>
                                        </td>
                                    @elseif($assigns->assignees_status == 1)
                                        <td style="text-align: center">
                                            <p style="color: green">ท่านได้ยืนยันแล้ว</p>
                                        </td>
                                        @elseif($assigns->assignees_status == 5)
                                            <td style="text-align: center">
                                                <p style="color: black">เพิกเฉย</p>
                                            </td>
                                        @elseif($assigns->assignees_status == 9)
                                            <td style="text-align: center">
                                                <p style="color: red">ถูกยกเลิก</p>
                                            </td>
                                    @elseif($assigns->assignees_status == 0)
                                        <td style="width: 15%; text-align: center">
                                            <a href="#modal-dialog{{$assigns->assignees_id}}"
                                               class="btn  btn-success width-80" data-toggle="modal">
                                                ยอมรับ
                                            </a>
                                            <a href="#modal-alert{{$assigns->assignees_id}}"
                                               class="btn btn-danger width-80"
                                               data-toggle="modal">ไม่ยอมรับ</a>
                                        </td>
                                    @endif
                                </tr>
                                <div class="modal fade" id="modal-dialog{{$assigns->assignees_id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Modal Dialog</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×
                                                </button>
                                            </div>
                                            <form class="form-horizontal form-bordered"
                                                  action="{{url('/assign/accept')}}"
                                                  method="post">
                                                @csrf
                                                <div class="modal-body" style="font-size: 18px;">
                                                    <p><b>กิจกรรม</b>&nbsp;{{$assigns->events_name}}</p>
                                                    <p>
                                                        <b>รายละเอียด</b>&nbsp;{{(!empty( $assigns->event_description)?  $assigns->event_description : '-')}}
                                                    </p>
                                                    <p><b>ผู้เพิ่มกิจกรรม</b>&nbsp;{{$assigns->users_name}}
                                                    </p>
                                                    <p><b>วันเริ่มต้น</b>&nbsp;{{$assigns->thaidatestart}}</p>
                                                    <p><b>วันสิ้นสุด</b>&nbsp;{{$assigns->thaidateend}}</p>
                                                    <p><b>สี</b> &nbsp;&nbsp;<button class="btn width-40"
                                                                                     style="background: {{$assigns->color}};width: 40px;height: 40px;">
                                                            &nbsp;
                                                        </button>
                                                    </p>
                                                    <input type="hidden" value="{{$assigns->events_id}}"
                                                           name="events_id">
                                                    <input type="hidden" value="{{$assigns->assignees_id}}"
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
                                <div class="modal fade" id="modal-alert{{$assigns->assignees_id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Reject</h4>
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
                                                        <p><b>กิจกรรม</b>&nbsp;{{$assigns->events_name}}</p>
                                                        <p>
                                                            <b>รายละเอียด</b>&nbsp;{{(!empty( $assigns->event_description)?  $assigns->event_description : '-')}}
                                                        </p>
                                                        <p><b>ผู้เพิ่มกิจกรรม</b>&nbsp;{{$assigns->users_name}}
                                                        </p>
                                                        <p><b>วันเริ่มต้น</b>&nbsp;{{$assigns->thaidatestart}}</p>
                                                        <p><b>วันสิ้นสุด</b>&nbsp;{{$assigns->thaidateend}}</p>
                                                        <p><b>สี</b> &nbsp;&nbsp;<button class="btn width-40"
                                                                                         style="background: {{$assigns->color}};width: 40px;height: 40px;">
                                                                &nbsp;
                                                            </button>
                                                        </p>
                                                        <input type="hidden" value="{{$assigns->events_id}}"
                                                               name="events_id">
                                                        <input type="hidden" value="{{$assigns->assignees_id}}"
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end calendar -->
        </div>
        <!-- end vertical-box -->
    </div>
@endsection

@section('script')
    <script>
        $('#data-table-responsive-assign').DataTable({
            responsive: true,
            "order": [[3, "desc"]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "lengthMenu": "แสดง _MENU_ รายการ",
                "search": "ค้นหา:",
                "zeroRecords": "Nothing found - sorry",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล ",
            }
        });


        $('input[name="check"]').change(function () {
            $("#filter-assign-list").submit();
        });

    </script>
@endsection