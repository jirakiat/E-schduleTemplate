@extends('master')
@section('content')
    <div id="content" class="content">
        <ol class="breadcrumb float-xl-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">หน้าแรก</a></li>
            <li class="breadcrumb-item active">กิจกรรมที่ฉันได้มอบหมายผู้อื่น</li>
        </ol>
        <!-- begin vertical-box -->
        <div class="vertical-box">
            <div class="row">
                <h1 class="page-header">กิจกรรมที่ฉันได้มอบหมายผู้อื่น
                </h1>
                <div class="col-xl-12">
                    <br>
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <!-- begin panel-heading -->
                        <div class="panel-heading" style="background: white">
                            <h4 class="panel-title" style="color: black;"></h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                   data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        <div class="panel-body">
                            <table id="data-table-responsive-myassign" width="100%"
                                   class="table table-bordered table-td-valign-middle hover">
                                <thead>
                                <tr>
                                    <th class="text-nowrap">กิจกรรม</th>
                                    <th class="text-nowrap">รายละเอียด</th>
                                    <th class="text-nowrap">วันเวลา</th>
                                    <th class="text-nowrap">สี</th>
                                    <th class="text-nowrap">ผู้ถูกเพิ่มงาน</th>
                                    <th class="text-nowrap">สถานะ</th>
                                    <th class="text-nowrap">เครื่องมือ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assignshow as $assignshows)
                                    <tr class="odd gradeX">
                                        <td style="width: 20%;">
                                            @if($assignshows->events_status==9)
                                                {{$assignshows->events_name}}
                                                <br>
                                                <b style="font-size: 12px;color: red">(หมายเหตุ:{{$assignshows->event_note}}
                                                    )</b>
                                            @elseif($assignshows->events_status==3 or $assignshows->events_status==0)
                                                {{$assignshows->events_name}}
                                            @endif
                                        </td>
                                            <td style="width: 23%;"> {{(!empty( $assignshows->event_description)?  $assignshows->event_description : '-')}}</td>
                                            <td style="width: 15%;">{{$assignshows->thaidatestart}}
                                                -{{$assignshows->thaidateend}}</td>
                                            <td style="width: 5%;"><p class="btn"
                                                                      style="background: {{$assignshows->color}};width: 100%;height: 100%;">
                                                    &nbsp;</p></td>

                                            </td>
                                            <td style="width: 12%;">{{$assignshows->users_name}}</td>
                                            <td style="width: 10%;text-align: center">
                                                @if($assignshows->assignees_status==1)
                                                    <span style="color: green"><i class="fa fa-check-circle"></i> ยอมรับ  <p
                                                                style="font-size: 12px;">( เวลา :{{ $assignshows->thaivertifytime}} )</p></span>
                                                @elseif($assignshows->assignees_status==3)
                                                    <span style="color: red"><i class="fa fa-times-circle"></i> ไม่ยอมรับ <p
                                                                style="font-size: 12px;">( เวลา :{{ $assignshows->thaivertifytime}} )</span>
                                                @elseif($assignshows->assignees_status==0)
                                                    <span><i class="fas fa-spinner fa-pulse"></i> กำลังดำเนินการ</span>
                                                @elseif($assignshows->assignees_status==5)
                                                    <span style="color: black"><i class="far fa-eye-slash"></i> เพิกเฉย <p
                                                                style="font-size: 12px;">( เวลา :{{ $assignshows->thaivertifytime}} )</span>
                                                @endif</td>
                                            <td style="width: 15%;text-align: center">
                                                <a href="assignedit/update/{{$assignshows->events_id}}"
                                                   class="btn  btn-primary width-80" >แก้ไข</a>
                                                <a href="#modal-dialog{{$assignshows->events_id}}"
                                                   class="btn btn-pink width-80"
                                                   data-toggle="modal">ยกเลิก</a>
                                                @if($assignshows->events_status==9)
                                                    <p style="color: red">ยกเลิก</p>
                                                @endif
                                            </td>
                                    </tr>
                                    <div class="modal fade" id="modal-dialog{{$assignshows->events_id}}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">  {{$assignshows->events_name}}(ยกเลิก)</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×
                                                    </button>
                                                </div>
                                                <form class="form-horizontal form-bordered"
                                                      action="{{url('/task/cancel/assign')}}"
                                                      method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label">หมายเหตุ </label>
                                                            <div class="col-lg-8">
                                                                <div class="input-group date">
                                                                    <input type="text" class="form-control"
                                                                           name="event_note"
                                                                           value="" required>
                                                                    <input type="text" class="form-control"
                                                                           hidden="hidden" name="id"
                                                                           value="{{$assignshows->events_id}}"/>
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
                                    <div class="modal fade" id="modal-without-animation{{$assignshows->events_id}}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{$assignshows->events_name}}(แก้ไข)</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">
                                                        ×
                                                    </button>
                                                </div>
                                                <form class="form-horizontal form-bordered"
                                                      action="{{url('/assignedit/update')}}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label">ชื่อกิจกรรม </label>
                                                            <div class="col-lg-8">
                                                                <div class="input-group date">
                                                                    <input type="text" class="form-control" name="names"
                                                                           value="{{$assignshows->events_name}}"
                                                                           required/>
                                                                    <input type="text" class="form-control"
                                                                           hidden="hidden" name="id"
                                                                           value="{{$assignshows->events_id}}"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label">รายละเอียด </label>
                                                            <div class="col-lg-8">
                                                                <div class="input-group date">
                                                        <textarea class="form-control" name="description"
                                                                  rows="8">{{$assignshows->event_description}}</textarea>
                                                                </div>
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
                                                    <div class="modal-footer">
                                                        <a href="javascript:;" class="btn btn-danger"
                                                           data-dismiss="modal">ปิด</a>
                                                        <button class="btn btn-primary" type="submit">บันทึก</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </table>
                            </tbody>
                            </table>
                        </div>
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


        $('#data-table-responsive-myassign').DataTable({
            responsive: true,
            "order": [[2, "asc"], [0, "asc"]],
            "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
            "language": {
                "lengthMenu": "แสดง _MENU_ รายการ",
                "zeroRecords": "ไม่มีข้อมูล",
                "search": "ค้นหา:",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล",
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
                display: 'inline'
            });
        });
    </script>
@endsection








