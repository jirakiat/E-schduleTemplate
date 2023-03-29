@extends('master')
@section('content')
    <!-- begin #content -->
    <div id="content" class="content" >
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Recent<small></small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="col-xl-2">
            <select class="form-control mb-3">
                <option value="">Filter</option>
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
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">DataTable - Show Recent</h4>
                    <div class="panel-heading-btn">
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="data-table-responsive" width="100%"  class="table table-bordered table-td-valign-middle">
                        <thead>
                        <tr>
                            <th class="text-nowrap">Task</th>
                            <th class="text-nowrap">Description</th>
                            <th class="text-nowrap">Date</th>
                            <th class="text-nowrap">End Date</th>
                            <th class="text-nowrap">Tools</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="odd gradeX">
                            <td>Trident</td>
                            <td>Trident</td>
                            <td>Internet Explorer 4.0</td>
                            <td>Win 95+</td>
                            <td>
                                <a href="#" class="btn btn-warning" data-toggle="modal"><i class="ion ion-md-construct"></i> Edit</a>
                                <a  href="javascript:;" data-click="swal-danger" class="btn btn-danger" ><i class="ion ion-md-trash"></i> Delete</a>
                            </td>
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
