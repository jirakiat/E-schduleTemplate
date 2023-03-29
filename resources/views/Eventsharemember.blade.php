@extends('master')
@section('content')
    <div id="content" class="content" >
        <ol class="breadcrumb float-xl-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">หน้าแรก</a></li>
            <li class="breadcrumb-item"><a href="{{url('task')}}">จัดการกิจกรรมของฉัน</a></li>
            <li class="breadcrumb-item active">กิจกรรมที่ฉันแชร์</li>
        </ol>
        <h1 class="page-header">จัดการกิจกรรมของฉัน
        </h1>
        <div class="row">
            <a href="{{url('task')}}" class="btn btn-warning pull-right f-s-14 width-60">
               กลับ
            </a>
            <div class="col-xl-12">
                <br>
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading" style="background: black;">
                        <h4 class="panel-title"></h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                               data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body" style="text-align: center">
                        <table id="data-table-responsive-member" width="100%"
                               class="table table-striped table-td-valign-middle hover">
                            <thead>
                            <tr>
                                <th class="text-nowrap">กิจกรรม</th>
                                <th class="text-nowrap">รายละเอียด</th>
                                <th class="text-nowrap">วันเวลา</th>
                                <th class="text-nowrap">สี</th>
                                <th class="text-nowrap">แชร์ให้กับ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sharemember as $sharemembers)
                                <tr class="odd gradeX">
                                    <td style="width: 20%;">{{$sharemembers->events_name}}</td>
                                    <td style="width: 30%;"> {{(!empty( $sharemembers->event_description)?  $sharemembers->event_description : '-')}}</td>
                                    <td style="width: 20%;">{{$sharemembers->thaidatestart}}
                                        -{{$sharemembers->thaidateend}}</td>
                                    <td style="width: 5%;"><p class="btn"
                                                              style="background: {{$sharemembers->color}};width: 100%;height: 100%;">
                                            &nbsp;</p></td>

                                    </td>
                                    <td style="width: 20%;text-align: left;">
                                        @foreach($test as $tests)
                                            <i class="fas fa-caret-right"></i>&nbsp;
                                            {{$tests->users_name}}
                                        <br>
                                            @if($tests->event_shares_statuss==1)
                                                (
                                                <span style="color: green;font-size: 12px"><i
                                                            class="fa fa-check-circle"></i> Accept เวลา :{{ $tests->thaivertifytime}}</span>
                                                )
                                            @elseif($tests->event_shares_statuss==3)
                                                (
                                                <span style="color: red;font-size: 12px"><i
                                                            class="fa fa-times-circle"></i>  Reject  เวลา :{{$tests->thaivertifytime}}</span>
                                                )
                                            @elseif($tests->event_shares_statuss==0)
                                                (
                                                <span style="color: cornflowerblue;font-size: 12px"><i class="fas fa-spinner fa-pulse"></i> กำลังดำเนินการ </span>
                                                )
                                            @elseif($tests->event_shares_statuss==5)
                                                (
                                                <span style="color: black;font-size: 12px"><i class="far fa-eye-slash"></i> เผิกเฉย {{$tests->thaivertifytime}}</span>
                                                )
                                            @endif
                                            <br>
                                        @endforeach
                                    </td>
                                    {{--                                    <td style="width: 5%;">{{$assignshows->creat_users_ldap}}</td>--}}
                                </tr>
                            @endforeach
                        </table>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade " id="modal-dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form class="form-horizontal form-bordered" action="{{url('/addtask/insert')}}"
                          method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="col-xl-12">
                                <div class="panel panel-inverse">
                                    <!-- begin col-6 -->
                                    <!-- begin panel -->
                                    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">

                                        <!-- begin panel-heading -->
                                        <div class="panel-heading" style="background: cornflowerblue;">
                                            <h4 class="panel-title">สร้างกิจกรรมของฉัน</h4>
                                            <div class="panel-heading-btn">
                                            </div>
                                        </div>
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
                                            <label class="col-lg-4 col-form-label">วันเวลา</label>
                                            <div class="col-lg-8">
                                                <div class="row row-space-10">
                                                    <div class="col-xs-6 mb-2 mb-sm-0">
                                                        <input type="text" class="form-control" name="startdate"
                                                               id="datetimepicker3" placeholder="เวลาเริ่มต้น"
                                                               required/>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input type="text" class="form-control" name="enddate"
                                                               id="datetimepicker4" placeholder="เวลาสิ้นสุด"
                                                               required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">เลือกผู้ใช้</label>
                                            <div class="col-lg-8">
                                                <div class="test" style="width: 100%; height: 100px;">
                                                    <div class="input-group date">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="radio" name="user_id"
                                                                   onchange="mytask(this);" value="" checked hidden/>
                                                            <input type="radio" name="myRadios"
                                                                   onchange="user(this);"/>
                                                            <label>เพิ่มงานให้ผู้อื่น</label>
                                                            <input type="radio" name="myRadios"
                                                                   onchange="group(this);"/>
                                                            <label>เพิ่มงานกลุ่มงาน</label>
                                                            <div class="div-showuser">
                                                                <input type="text" name="showuser_id">
                                                            </div>
                                                            <select class="form-control div-showgroup" name="group_id"
                                                                    data-size="10" data-live-search="true"
                                                                    data-style="btn-white">
                                                                <option value="">หน่วยงาน</option>
                                                            </select>
                                                        </div>
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
    </div>
    <p class="badge-yellow"></p>
@endsection






@section('script')
    <script>
        function user(src) {
            $('.div-showuser').show();
            $('.div-showgroup').hide();
            // $('.test ').removeClass('badge-warning');
            // $('.test ').addClass('note-warning');
        }

        function group(src) {
            $('.div-showgroup').show();
            $('.div-showuser').hide();
            // $('.test ').removeClass('badge-aqua');
            // $('.test ').addClass('badge-warning');
        }


        $('.div-showuser').hide();
        $('.div-showgroup').hide();
        $('#data-table-responsive-member').DataTable({
            responsive: true,
            "order": [[2, "asc"],],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "lengthMenu": "แสดง _MENU_ รายการ",
                "zeroRecords": "ไม่มีข้อมูล",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล",
            }
        });

    </script>
@endsection








