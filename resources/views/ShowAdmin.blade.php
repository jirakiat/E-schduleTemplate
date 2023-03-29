@extends('master')
@section('content')
    <!-- begin #content -->
    <div id="content" class="content" >
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Show Admin<small></small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">DataTable - Show Admin</h4>
                    <div class="panel-heading-btn">
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="data-table-responsive" width="100%"  class="table table-bordered table-td-valign-middle">
                        <thead>
                        <tr>
                            <th class="text-nowrap">User</th>
                            <th class="text-nowrap">Group</th>
                            <th class="text-nowrap">Tools</th>
                            <th class="text-nowrap">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="odd gradeX">
                            <td>User</td>
                            <td>Agency</td>
                            <td style="width: 300px;">
                                <a href="#modal-alert" class="btn  btn-warning" data-toggle="modal"><i class="ion ion-md-construct"></i> Edit</a>
                                <a href="javascript:;" data-click="swal-danger" class="btn btn-danger" ><i class="ion ion-md-trash"></i> Delete</a>
                            </td>
                            <td>  <input type="checkbox" data-render="switchery" data-theme="default" checked /></td>
                        </tr>
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
