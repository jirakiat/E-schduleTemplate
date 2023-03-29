@extends('master')
@section('content')
    <!-- begin #content -->
    <div id="content" class="content" >
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">ให้สิทธิผู้ดูแล<small></small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <!-- begin col-6 -->
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                    <!-- begin panel-heading -->
                    <div class="panel-heading" style="background: white">
                        <h4 class="panel-title">User Form</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body addpermission">
                        <form class="form-horizontal"  action="{{url('/userform/insert')}}" method="post">
                        @csrf
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">ผู้ดูแล</label>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <input name="user_serach" type="text" class="form-control">
                                        <span class="input-group-append">
                                    <button class="btn btn-inverse btn-searchs" type="button"><i class="fa fa-search"></i></button>
											</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <select   name="user_id" class="form-control mb-3 usersname" required>
                                        <option value="" selected="">เลือกผู้ใช้</option>
                                    </select>
                                    <input type="hidden" name="fullname">
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-4 col-sm-4 col-form-label" for="fullname">สถานะ</label>
                                <div class="col-md-8 col-sm-8">
                                    <select class="form-control mb-3" name="status_id">
                                        <option value="" selected>เลือกสถานะ</option>
                                        @foreach($status as $statuses)
                                        <option value="{{$statuses->status_id}}">{{$statuses->status_name}}</option>
                                        @endforeach
                                    </select>
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
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading" style="background: white">
                    <h4 class="panel-title"></h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->

                <div class="panel-body">
                    <table id="data-table-responsive-eventadayoff" width="100%"
                           class="table table-bordered table-td-valign-middle">
                        <thead>
                        <tr>
                            <th class="text-nowrap">ชื่อ</th>
                            <th class="text-nowrap">สถานะ</th>
                            <th class="text-nowrap">เครื่องมือ</th>
                        </tr>
                        </thead>
                        @foreach($user as $users)
                            @if($users->status_id==1 or $users->status_id==2)
                            <tr class="odd gradeX">
                                <td style="width: 35%">{{$users->users_name}}</td>
                                <td  style="width: 35%">{{$users->status_name}}</td>
                                <td style="width: 15%;text-align: center">   <a href="#modal-without-animation{{$users->user_id}}"
                                          class="btn  btn-primary width-80" data-toggle="modal">แก้ไข</a>
                                    <a href="#modal-alert{{$users->user_id}}"
                                       class="btn btn-danger width-80"
                                       data-toggle="modal">ลบ</a>
                                 </td>
                                <div class="modal fade" id="modal-alert{{$users->user_id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">ยืนยันการลบ</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">
                                                    ×
                                                </button>
                                            </div>
                                            <form class="form-horizontal form-bordered"
                                                  action="{{url('userpermission/delete')}}"
                                                  method="post">
                                                @csrf
                                                <div class="modal-body" style="font-size: 18px;">
                                                    <div class="alert alert-danger m-b-0">
                                                        <p><b>ชื่อ</b>&nbsp;{{$users->users_name}}</p>
                                                        <p>
                                                            <b>สถานะ</b> {{$users->status_name}}
                                                        </p>
                                                        <input type="hidden" value="{{$users->user_id}}"
                                                               name="users_id">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:;" class="btn btn-white"
                                                       data-dismiss="modal">ปิด</a>
                                                    <button class="btn btn-danger" type="submit">ลบ</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modal-without-animation{{$users->user_id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{$users->users_name}}(แก้ไขสิทธิ)</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">
                                                    ×
                                                </button>
                                            </div>
                                            <form class="form-horizontal form-bordered"
                                                  action="{{url('userpermission/update')}}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group row m-b-15">
                                                        <label class="col-md-4 col-sm-4 col-form-label" for="fullname">สถานะ</label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <input type="hidden" value="{{$users->user_id}}" name="users_id">
                                                            <select class="form-control mb-3" name="status_id">
                                                                <option value="" selected>เลือกสถานะ</option>
                                                                @foreach($status as $statuses)
                                                                    <option value="{{$statuses->status_id}}">{{$statuses->status_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:;" class="btn btn-danger"
                                                       data-dismiss="modal">ปิด</a>
                                                    <button class="btn btn-primary" type="submit">บันทึก</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                          @endif
                        @endforeach
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end col-10 -->





@endsection
<input type="hidden" class="input-hidden-accessToken">
@section('script')
    <script>
        var html='';
        $(document).on("click",".btn-searchs",function() {
            html='';
            $.ajax({
                url: "http://e-asset.nsru.ac.th/service/get/sys-token",
                type: "get",
                data: {'userRequestor': 'jirakiat'},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                },
                success: function (response) {
                    console.log(response);

                    $('.input-hidden-accessToken').val(response['accessToken']);
                    var token = $('.input-hidden-accessToken').val();
                    var user = $('input[name=user_serach]').val();
                    serachusername(token, user);

                }
            });
        });
        $(document).on("change",".usersname",function() {
            $('input[name=fullname]').val($('.usersname option:selected').text());
            console.log($('.usersname option:selected').text());
        });
        function serachusername(token, user) {
            console.log([token, user]);
            $.ajax({
                url: "https://e-asset.nsru.ac.th/service/get/search/user-list",
                type: "post",
                data: {
                    'searchTitle': user,
                    'accessToken': token
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                },
                success: function (response) {
                    html = '<option value="">เลือกผู้ใช้</option>';
                    $('.usersname').html('');
                    $.each(response, function (key, value) {
                        optionText = value['userFullName'];
                        optionvalue = value['userID'];
                        html += '<option value="' + optionvalue + '">' + optionText + '</option>';
                    });
                    $('.usersname').append(html);
                }
            });

        }

        $('#data-table-responsive-manageaffiliate').DataTable({
            responsive: true,
        });

        $(".addpermission").on("keypress", function (event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });


        $('#data-table-responsive-eventadayoff').DataTable({
            responsive: true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "lengthMenu": "แสดง _MENU_ รายการ",
                "zeroRecords": "Nothing found - sorry",
                "search": "ค้นหา:",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล ",
            }
        });
    </script>

@endsection
