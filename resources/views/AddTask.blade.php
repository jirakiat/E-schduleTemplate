@extends('master')
@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">สร้างกิจกรรมของฉัน <small></small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <!-- begin col-6 -->
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="form-plugins-1">

                    <!-- begin panel-heading -->
                    <div class="panel-heading" style="background: cornflowerblue;">
                        <h4 class="panel-title">สร้างกิจกรรมของฉัน</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered" action="{{url('/addtask/insert')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">กิจกรรม</label>
                                <div class="col-lg-8">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" name="work" required data-toggle="tooltip" data-html="true" title="งาน"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">รายละเอียด</label>
                                <div class="col-lg-8">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" name="description"  data-toggle="tooltip" data-html="true" title="รายละเอียด"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">วันเวลา</label>
                                <div class="col-lg-8">
                                    <div class="row row-space-10">
                                        <div class="col-xs-6 mb-2 mb-sm-0">
                                            <input type="text" class="form-control" name="startdate" id="datetimepicker3" placeholder="เวลาเริ่มต้น"  required/>
                                        </div>
                                        <div class="col-xs-6">
                                            <input type="text" class="form-control" name="enddate" id="datetimepicker4" placeholder="เวลาสิ้นสุด"  required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">เลือกผู้ใช้(ต้องระบุ)</label>
                                <div class="col-lg-8">
                                    <div class="input-group date">
                                        <select class="form-control selectpicker" name="user_id" data-size="10" data-live-search="true" data-style="btn-white" >
                                            @foreach($datauser as $datauser)
                                                <option value="{{$datauser->user_id}}" >{{ $datauser->users_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">สี(กิจกรรมในปฏิทิน)</label>
                                <div class="col-lg-8">
                                    <div class="input-group colorpicker-component" data-color="rgb(0, 0, 0)" data-color-format="rgb"  id="colorpicker-append">
                                        <input type="text" value="rgb(0, 0, 0)" readonly="" name="colort" class="form-control" id="colorpicker-append-input" />
                                        <span class="input-group-append">
												<label class="input-group-text" for="colorpicker-append-input"><i class="fa fa-square fa-lg"></i></label>
											</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"></label>
                                <div class="col-lg-8">
                                    <div class="row row-space-10">
                                        <div class="col-xs-6">
                                            <button type="submit" class="btn btn-primary"  data-toggle="tooltip" data-html="true" title="สร้างงาน">บันทึก</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-2">
            <a href="#modal-dialog" class="btn btn-red" data-toggle="modal">
                ดูกิจกรรมที่ฉันสร้าง
            </a>
        </div>

    </div>>
    <div class="modal fade " id="modal-dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style="width: 800px;height: 800px;">
                            <iframe src="/task" id="info" class="iframe" name="info" seamless="" height="100%" width="100%"></iframe>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-danger" data-dismiss="modal">ปิด</a>
                        </div>
                </div>
            </div>
        </div>
@endsection
