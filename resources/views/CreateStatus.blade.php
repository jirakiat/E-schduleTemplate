@extends('master')
@section('content')
    <!-- begin #content -->
    <div id="content" class="content" >
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">สร้างผู้สถานะผู้ใช้<small></small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <!-- begin col-6 -->
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                    <!-- begin panel-heading -->
                    <div class="panel-heading" style="background: white">
                        <h4 class="panel-title"></h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{url('/userform/insertstatus')}}" method="post">
                            @csrf
                            <div class="form-group row m-b-15">
                                <label class="col-md-4 col-sm-4 col-form-label" for="fullname">ชื่อสถานะ</label>
                                <div class="col-md-8 col-sm-8">
                                    <input class="form-control" type="text"  name="users_status"  data-parsley-required="true" />
                                </div>
                            </div>
                            <div class="form-group row m-b-0">
                                <label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
                                <div class="col-md-8 col-sm-8">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-lg fa-fw fa-save"></i>บันทึก</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
