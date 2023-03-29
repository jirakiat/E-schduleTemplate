@extends('master')
@section('content')
    <!-- begin #content -->
    <div id="content" class="content" >
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">ผู้ใช้<small></small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">ตารางแสดงผู้ใช้</h4>
                    <div class="panel-heading-btn">
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="data-table-responsive" width="100%"  class="table table-bordered table-td-valign-middle">
                        <thead>
                        <tr>
                            <th class="text-nowrap">ชื่อ</th>
                            <th class="text-nowrap">หน่วยงาน</th>
                            <th class="text-nowrap">เครื่องมือ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user as $users)
                            <tr class="odd gradeX">
                                <td>{{$users->users_name }}</td>
                                <td>{{ $users->affiliate_name}}</td>
                                <td style="width: 300px; text-align: center">
                                    <a href="#modal-dialog{{ $users->affiliate_id}}" class="btn  btn-warning" data-toggle="modal"><i class="icon-note"></i> แก้ไข</a>
                                    <a href="/Affiliate/delete/{{ $users->affiliate_id}}" class="btn btn-danger" ><i class="ion ion-md-trash"></i> ลบ</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- end panel-body -->
            </div>

            @endsection
