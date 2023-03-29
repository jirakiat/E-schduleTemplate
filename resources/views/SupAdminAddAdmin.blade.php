@extends('master')
@section('content')
    <!-- begin #content -->
    <div id="content" class="content" >
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">SuperAdmin Add Admin<small></small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <!-- begin col-6 -->
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="form-plugins-1">

                    <!-- begin panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Form Add Task</h4>
                        <div class="panel-heading-btn">
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered" action="{{url('#')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Select</label>
                                <div class="col-lg-8">
                                    <div class="row row-space-10">
                                        <div class="col-xs-6 mb-2 mb-sm-0">
                                            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white">
                                                <option value="" selected>Select</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AQ">Antarctica</option>
                                                <option value="AG">Antigua and Barbuda</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-6">
                                            <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white">
                                                <option value="" selected>Select</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AQ">Antarctica</option>
                                                <option value="AG">Antigua and Barbuda</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Status</label>
                                <div class="col-lg-8">
                                    <div class="input-group date">
                                        <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white">
                                            <option value="" selected>Admin</option>
                                            <option value="AF">Afghanistan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"></label>
                                <div class="col-lg-8">
                                    <div class="row row-space-10">
                                        <div class="col-xs-6">
                                            <button type="submit" data-click="swal-success" class="btn btn-primary" data-toggle="tooltip" data-html="true" title="เพิ่มแอดมิน"><i class="fas fa-lg fa-fw fa-save"></i>save</button>
                                        </div>
                                    </div>
                                </div>
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
