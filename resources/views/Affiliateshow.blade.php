@extends('master')
@section('content')
    <div id="content" class="content" >
        <ol class="breadcrumb float-xl-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">หน้าแรก</a></li>
            <li class="breadcrumb-item"><a href="{{url('task')}}">จัดการกิจกรรมของฉัน</a></li>
            <li class="breadcrumb-item active">กิจกรรมของหน่วยงาน</li>
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
                        <h4 class="panel-title">ตารางแสดงกิจกรรม</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                               data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body" style="text-align: center">
                        <table id="data-table-responsive-showassign" width="100%"
                               class="table table-striped table-td-valign-middle hover">
                            <thead>
                            <tr>
                                <th class="text-nowrap">กิจกรรม</th>
                                <th class="text-nowrap">รายละเอียด</th>
                                <th class="text-nowrap">วันเวลา</th>
                                <th class="text-nowrap">สี</th>
                                <th class="text-nowrap">หน่วยงาน</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd gradeX">
                                @foreach($affiliateevent as $affiliateevents)
                                    <td style="width: 20%;">{{$affiliateevents->events_name}}</td>
                                    <td style="width: 25%;"> {{(!empty( $affiliateevents->event_description)?  $affiliateevents->event_description : '-')}}</td>
                                    <td style="width: 20%;">{{$affiliateevents->thaidatestart}}
                                        -{{$affiliateevents->thaidateend}}</td>
                                    <td style="width: 5%;"><p class="btn"
                                                              style="background: {{$affiliateevents->color}};width: 100%;height: 100%;">
                                            &nbsp;</p></td>

                                    </td>
                                    <td style="width: 10%;">{{$affiliateevents->affiliate_name}}</td>
                            </tr>
                            @endforeach
                        </table>
                        </tbody>
                        </table>
                    </div>
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

        $('#data-table-responsive-showassign').DataTable({
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








