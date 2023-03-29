@extends('master')
@section('content')
    <!-- begin #content -->
    <div id="content" class="content" >
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">หน่วยงาน<small></small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <!-- begin col-6 -->
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="form-plugins-1">

                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">สร้างหน่วยงาน</h4>
                        <div class="panel-heading-btn">
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered" action="{{url('Affiliate/insert')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">ชื่อหน่วยงาน</label>
                                <div class="col-lg-8">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" name="names" required data-toggle="tooltip" data-html="true" title="รายละเอียด"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">รายละเอียด</label>
                                <div class="col-lg-8">
                                    <div class="input-group date">
                                        <textarea class="form-control" name="description"  rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">ผู้ดูแล</label>
                                <div class="col-lg-8">
                                    <select  class="form-control selectadminadd"  name="userid" data-size="10" data-live-search="true" data-style="btn-white">
                                        <option value="" selected>เลือก</option>
                                        @foreach($datauser as $datauser)
                                            <option value="{{$datauser->user_id}}" >{{ $datauser->users_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"></label>
                                <div class="col-lg-8">
                                    <div class="row row-space-10">
                                        <div class="col-xs-6">
                                            <button type="submit" class="btn btn-primary"" data-toggle="tooltip" data-html="true" title="เพิ่มสังกัด"><i class="fas fa-lg fa-fw fa-save"></i>บันทึก</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-2">
                <a href="/affiliate" class="btn btn-red">ดูหน่วยงาน</a>
            </div>
        </div>

        <!-- end panel-body -->
    </div>
    <!-- end panel -->
    </div>

    <!-- end col-10 -->
    </div>


    <!-- end row -->
    </div>
    <!-- end #content -->



@endsection
@section('script')
    <script>
        $(".selectadminadd").selectpicker('show');
    </script>

@endsection
