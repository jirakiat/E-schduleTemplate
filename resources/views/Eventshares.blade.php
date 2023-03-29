@extends('master')
@section('content')
    <div id="content" class="content" >
        <ol class="breadcrumb float-xl-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">หน้าแรก</a></li>
            <li class="breadcrumb-item active">กิจกรรมที่แชร์กับฉัน</li>
        </ol>
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">กิจกรรมที่แชร์กับฉัน<small></small></h1>
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
                            <form action="{{url('eventshare')}}" method="get" id="filter-assign-list">
                                @csrf
                                <tr>
                                    <td class="with-img">
                                        <label> <input type="radio" name="check" value="0" {{$checked1}}>กิจกรรมที่แชร์กับฉัน</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="with-img">
                                        <label> <input type="radio" name="check" value="1" {{$checked2}} >&nbsp;&nbsp;ยอมรับ</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="with-img">
                                        <label> <input type="radio" name="check" value="3" {{$checked3}}>&nbsp;&nbsp;ไม่ยอมรับ</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="with-img">
                                        <label> <input type="radio" name="check" value="5" {{$checked4}}>&nbsp;&nbsp;เผิกเฉย</label>
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
                                <th class="text-nowrap">ผู้ที่แชร์กิจกรรม</th>
                                <th class="text-nowrap">วันเวลากิจกรรม</th>
                                <th class="text-nowrap">วันเวลาดำเนินการ</th>
                                <th class="text-nowrap">สี</th>
                                <th class="text-nowrap">เครื่องมือ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sharemember as $sharemembers)
                                <?php
                                if ($sharemembers->event_shares_statuss == 0) {
                                    $icon = 'fas fa-spinner fa-pulse';
                                    $color = '';
                                } elseif ($sharemembers->event_shares_statuss == 3) {
                                    $icon = 'fa fa-times-circle';
                                    $color = 'red';
                                } elseif ($sharemembers->event_shares_statuss == 1) {
                                    $icon = 'fa fa-check-circle';
                                    $color = 'green';
                                }
                                elseif ($sharemembers->event_shares_statuss == 5) {
                                    $icon = 'far fa-eye-slash';
                                    $color = '';
                                }
                                elseif ($sharemembers->event_shares_statuss == 9) {
                                    $icon = 'far fa-window-close';
                                    $color = 'red';
                                }
                                else{
                                    $icon='';
                                    $color = '';
                                }
                                ?>
                                <tr class="odd gradeX">
                                    @if($sharemembers->event_shares_statuss !=5)
                                        <td style="width: 20%;"><i class="{{$icon}}"
                                                                   style="color: {{$color}}"></i>&nbsp;{{$sharemembers->events_name}}
                                        </td>
                                    @else
                                        <td style="width: 20%;text-decoration:line-through"><i class="{{$icon}}"
                                                                   style="color: {{$color}}"></i>&nbsp;{{$sharemembers->events_name}}
                                        </td>

                                    @endif
                                    <td style="width: 30%;"> {{(!empty( $sharemembers->event_description)?  $sharemembers->event_description : '-')}}</td>
                                    <td style="width: 5%;">{{$sharemembers->users_name}}</td>
                                    <td style="width: 10%;">{{$sharemembers->thaidatestart}}
                                        -{{$sharemembers->thaidateend}}</td>
                                    <td style="width: 5%;">{{(!empty( $sharemembers->thaivertifytime)?  $sharemembers->thaivertifytime : '-')}}</td>
                                    <td style="width: 5%;"><p class="btn"
                                                              style="background: {{$sharemembers->color}};width: 100%;height: 100%;">
                                            &nbsp;</p></td>
                                    @if($sharemembers->event_shares_statuss == 3)
                                        <td style="text-align: center">
                                            <p style="color: red">ท่านได้ reject</p>
                                        </td>
                                    @elseif($sharemembers->event_shares_statuss == 1)
                                        <td style="text-align: center">
                                            <p style="color: green">ท่านได้ยืนยันแล้ว</p>
                                        </td>
                                    @elseif($sharemembers->event_shares_statuss == 5)
                                        <td style="text-align: center">
                                            <p style="color: black;">เผิกเฉย</p>
                                        </td>
                                        @elseif($sharemembers->event_shares_statuss == 9)
                                            <td style="text-align: center">
                                                <p style="color: red;">ถูกยกเลิก</p>
                                            </td>
                                    @elseif($sharemembers->event_shares_statuss ==0)
                                        <td style="width: 15%; text-align: center">
                                            <a href="#modal-dialog{{$sharemembers->event_shares_id}}"
                                               class="btn  btn-success width-80" data-toggle="modal">
                                                ยอมรับ
                                            </a>
                                            <a href="#modal-alert{{$sharemembers->event_shares_id}}"
                                               class="btn btn-danger width-80"
                                               data-toggle="modal">ไม่ยอมรับ</a>
                                        </td>
                                    @endif
                                </tr>
                                <div class="modal fade" id="modal-dialog{{$sharemembers->event_shares_id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Accept</h4>
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
                                                <h4 class="modal-title">Reject</h4>
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
                "zeroRecords": "Nothing found - sorry",
                "search": "ค้นหา:",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล ",
            }
        });


        $('input[name="check"]').change(function () {
            $("#filter-assign-list").submit();
        });

    </script>
@endsection