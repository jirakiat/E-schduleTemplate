@extends('master')
@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">เพิ่มวันหยุด <small></small></h1>
        <div class="row">
            <!-- end page-header -->
            <!-- begin row -->
            <div class="col-xl-12">
                <div class="panel panel-inverse">
                    <!-- begin col-6 -->
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">

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
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" action="{{url('/addtask/insert/adayoff')}}"
                                  method="post">
                                @csrf
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
                                            <input type="text" class="form-control" name="description"
                                                   data-toggle="tooltip" data-html="true" title="รายละเอียด"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">วัน</label>
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
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label"></label>
                                    <div class="col-lg-8">
                                        <div class="row row-space-10">
                                            <div class="col-xs-6">
                                                <button type="submit" class="btn btn-primary" data-toggle="tooltip"
                                                        data-html="true" title="เพิ่มวันหยุด">บันทึก
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading" style="background: white">
                        <h4 class="panel-title">วันหยุด</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                               data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <table id="data-table-responsive-eventadayoff" width="100%"
                               class="table table-bordered table-td-valign-middle">
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
                            @foreach($eventaday as $eventadays)
                                <tr class="odd gradeX">
                                    <td style="width: 20%;">&nbsp{{$eventadays->events_name}}
                                    </td>
                                    <td style="width: 30%;"> {{(!empty( $eventadays->event_description)?  $eventadays->event_description : '-')}}</td>
                                    <td style="width: 10%;">{{$eventadays->thaidatestart}}</td>
                                    <td style="width: 10%;">{{$eventadays->thaidateend}}</td>
                                    <td style="width: 5%;"><p class="btn"
                                                              style="background: {{$eventadays->color}};width: 100%;height: 100%;">
                                            &nbsp;</p></td>
                                    <td style="width: 20%; text-align: center">
                                        <a href="eventadayoff/update/{{$eventadays->events_id}}"
                                         class="btn  btn-primary width-80">แก้ไข</a>

                                        <a href="#modal-alert{{$eventadays->events_id}}"
                                           class="btn btn-danger width-80"
                                           data-toggle="modal">ลบ</a>
                                    </td>
                                    <div class="modal fade" id="modal-alert{{$eventadays->events_id}}">
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
                                                      action="{{url('/task/deletetask/adayoff')}}"
                                                      method="post">
                                                    @csrf
                                                    <div class="modal-body" style="font-size: 18px;">
                                                        <div class="alert alert-danger m-b-0">
                                                            <p><b>กิจกรรม</b>&nbsp;{{$eventadays->events_name}}</p>
                                                            <p>
                                                                <b>รายละเอียด</b>&nbsp;{{(!empty( $eventadays->event_description)?  $eventadays->event_description : '-')}}
                                                            </p>
                                                            <p><b>วันเริ่มต้น</b>&nbsp;{{$eventadays->thaidatestart}}
                                                            </p>
                                                            <p><b>วันสิ้นสุด</b>&nbsp;{{$eventadays->thaidateend}}</p>
                                                            </p>
                                                            <input type="hidden" value="{{$eventadays->events_id}}"
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
                                    <div class="modal" id="modal-without-animation{{$eventadays->events_id}}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{$eventadays->events_name}}(แก้ไข)</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">
                                                        ×
                                                    </button>
                                                </div>
                                                <form class="form-horizontal form-bordered"
                                                      action="{{url('/task/update/adayoff')}}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label">ชื่อกิจกรรม </label>
                                                            <div class="col-lg-8">
                                                                <div class="input-group date">
                                                                    <input type="text" class="form-control" name="names"
                                                                           value="{{$eventadays->events_name}}"
                                                                           required/>
                                                                    <input type="text" class="form-control"
                                                                           hidden="hidden" name="id"
                                                                           value="{{$eventadays->events_id}}"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label">รายละเอียด </label>
                                                            <div class="col-lg-8">
                                                                <div class="input-group date">
                                                        <textarea class="form-control" name="description"
                                                                  rows="8">{{$eventadays->event_description}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label">วัน</label>
                                                            <div class="col-lg-8">
                                                                <div id="test"></div>
                                                                <label>
                                                                    <input id="startedit" type="hidden" placeholder="Please select..." name="startdate"/>
                                                                </label>
                                                                <label>
                                                                    <input id="endedit"  type="hidden" placeholder="Please select..." name="enddate" />
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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>

        $('#data-table-responsive-eventadayoff').DataTable({
            responsive: true,
            "order": [[2, "asc"],],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
            themeVariant: 'light',
        });
        $('.btn-view-modal-alert').click(function () {
            var startdate = $(this).attr('startdate');
            var enddate = $(this).attr('enddate');
        });
        $(function () {
            $('#demo-calendar').mobiscroll().datepicker({
                controls: ['calendar'],
                select: 'range',
                startInput: '#start',
                endInput: '#end',
                // min: 'now',   ปิดวันก่อนหน้า
                touchUi: true,
                display: 'inline',
            });
            $('#test').mobiscroll().datepicker({
                controls: ['calendar'],
                select: 'range',
                startInput: '#startedit',
                endInput: '#endedit',
                touchUi: true,
                display: 'inline',
            });
        });


    </script>

@endsection