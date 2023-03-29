@extends('master')
@section('content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb float-xl-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">หน้าแรก</a></li>
            <li class="breadcrumb-item"><a href="{{url('task')}}">จัดการกิจกรรมของฉัน</a></li>
            <li class="breadcrumb-item active">กิจกรรมของหน่วยงาน</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header"><small>กิจกรรมหน่วยงาน</small></h1>
        <a href="{{url('/profile')}}" class="btn btn-warning pull-left">
            กลับ
        </a>
        <br>
        <!-- end page-header -->
        <!-- begin timeline -->
        <ul class="timeline">
            @foreach($affiliate as $affiliates)
            <li>
                <!-- begin timeline-time -->
                <div class="timeline-time">
                    <span class="time">{{$affiliates->thaidatestart}}</span>
                </div>
                <!-- end timeline-time -->
                <!-- begin timeline-icon -->
                <div class="timeline-icon">
                    <a href="javascript:;">&nbsp;</a>
                </div>
                <!-- end timeline-icon -->
                <!-- begin timeline-body -->
                <div class="timeline-body">
                    <div class="timeline-header">
                        <span><i class="fas fa-university"></i> {{$affiliates->affiliate_name}}</span>
                        <br>
                        <span class="username"><a href="javascript:;">กิจกรรม :{{$affiliates->events_name}}</a></span>
                        <br>
                        <span class="username"><a href="javascript:;">รายละเอียด :{{(!empty( $affiliates->event_description)?  $affiliates->event_description : '-')}}</a></span>
                    </div>
                    <div class="timeline-content">
                        <p>
                            ผู้เพิ่มกิจกรรม :{{$affiliates->event_users_ldap}}
                           <span class="pull-right">{{$affiliates->thaidatestart}}ถึง{{$affiliates->thaidateend}}</span>
                        </p>
                    </div>
                </div>
                <!-- end timeline-body -->
            </li>
            @endforeach
        </ul>
        <!-- end timeline -->
    </div>
    <!-- end table -->

@endsection
@section('script')
    <script>
        $('#data-table-responsive-showassign').DataTable({
            responsive: true,
            "order": [[3, "desc"]],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "lengthMenu": "แสดง _MENU_ รายการ",
                "zeroRecords": "Nothing found - sorry",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล ",
            }
        });

    </script>
@endsection
