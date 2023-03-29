@extends('master')
@section('content')
    <!-- begin #content -->
    <div id="content" class="content" >
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Group<small></small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">DataTable - Show Group</h4>
                    <div class="panel-heading-btn">
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="data-table-responsive" width="100%"  class="table table-bordered table-td-valign-middle">
                        <thead>
                        <tr>
                            <th class="text-nowrap">name</th>
                            <th class="text-nowrap">Description</th>
                            <th class="text-nowrap">user</th>
                            <th class="text-nowrap">Tools</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="odd gradeX">
                            <td>Trident</td>
                            <td>Trident</td>
                            <td>Trident</td>
                            <td style="width: 300px;">
                                <a href="#modal-dialog" class="btn btn-primary" data-toggle="modal"><i class="ion ion-md-add"></i> AddUser</a>
                                <a href="#modal-alert" class="btn  btn-warning" data-toggle="modal"><i class="ion ion-md-construct"></i> Edit</a>
                                <a href="javascript:;" data-click="swal-danger" class="btn btn-danger" ><i class="ion ion-md-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal-dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add User</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Search</label>
                                            <div class="col-lg-8">
                                                <div class="row row-space-10">
                                                    <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white">
                                                        <option value="">Search User</option>
                                                        <option value="AF">Afghanistan</option>
                                                        <option value="AL">Albania</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Permission</label>
                                            <div class="col-lg-8">
                                                <div class="row row-space-10">
                                                        <select class="form-control mb-3">
                                                            <option value="">Permission</option>
                                                            <option value="AF">Afghanistan</option>
                                                            <option value="AL">Albania</option>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                        <a href="javascript:;" class="btn btn-success">Action</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modal-alert">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Alert Header</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger m-b-0">
                                            <h5><i class="fa fa-info-circle"></i> Alert Header</h5>
                                            <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal">Action</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                        </tbody>
                    </table>
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
