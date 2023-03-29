@extends('master')
@section('content')
    <!-- begin #content -->
    <div id="content" class="content" >
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Follow<small></small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">DataTable - Show Follow</h4>
                    <div class="panel-heading-btn">
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="data-table-responsive" width="100%"  class="table table-bordered table-td-valign-middle">
                        <thead>
                        <tr>
                            <th class="text-nowrap">Name</th>
                            <th class="text-nowrap">Follow</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="odd gradeX">
                            <td>Calendar 1</td>
                            <td style="width: 300px">
                                <input type="checkbox" data-render="switchery" data-theme="blue" checked />
                            </td>
                        </tr>
                        <tr class="odd gradeX">
                            <td>Calendar 2</td>
                            <td style="width: 300px">
                                <input type="checkbox" data-render="switchery" data-theme="blue"  />
                            </td>
                        </tr>
                        <tr class="odd gradeX">
                            <td>Calendar 3</td>
                            <td style="width: 300px">
                                <input type="checkbox" data-render="switchery" data-theme="blue"  />
                            </td>
                        </tr>
                        <tr class="odd gradeX">
                            <td>Calendar 4</td>
                            <td style="width: 300px">
                                <input type="checkbox" data-render="switchery" data-theme="blue" />
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
