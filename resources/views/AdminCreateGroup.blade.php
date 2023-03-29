@extends('master')
@section('content')
    <div id="content" class="content">
        <ol class="breadcrumb float-xl-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">หน้าแรก</a></li>
            <li class="breadcrumb-item active">จัดการกลุ่ม</li>
        </ol>

        <h1 class="page-header">จัดการกลุ่ม</h1>


        <div class="row">
            <!-- begin col-6 -->
            <div class="col-xl-12">
                <div class="panel panel-inverse">
                    <!-- begin col-6 -->
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">

                        <!-- begin panel-heading -->
                        <div class="panel-heading" style="background: white;">
                            <h4 class="panel-title" style="color: black;font-size: 16px;">สร้างกลุ่ม</h4>
                            <div class="panel-heading-btn ">
                                <a href="javascript:;"
                                   class="btn btn-xs btn-icon btn-circle btn-warning btn-swith-show-div-create-group"
                                   data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        <div class="panel-body panel-form div-create-group">
                            <form class="form-horizontal form-bordered" action="{{url('/admincreategroup/insert')}}"
                                  method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">ชื่อกลุ่ม</label>
                                    <div class="col-lg-8">
                                        <div class="input-group date">
                                            <input type="text" class="form-control" name="name" required
                                                   data-toggle="tooltip" data-html="true" title="กลุ่มงาน"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">รายละเอียด</label>
                                    <div class="col-lg-8">
                                        <div class="input-group date">
                                            <input type="text" class="form-control" name="description"
                                                   data-toggle="tooltip" data-html="true" title="รายละเอียด"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">สถานะ</label>
                                    <div class="col-lg-8">
                                        <div class="input-group date">
                                            <label> <input type="radio" name="status" value="1" checked> เปิด</label>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <label> <input type="radio" name="status" value="2"> ปิด</label>
                                            {{--                                            <select class="form-control mb-3" name="status">--}}
                                            {{--                                                <option value="">สถานะ</option>--}}
                                            {{--                                                <option value="1">เปิด</option>--}}
                                            {{--                                                <option value="2">ปิด</option>--}}
                                            {{--                                            </select>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label"></label>
                                    <div class="col-lg-8">
                                        <div class="row row-space-10">
                                            <div class="col-xs-6">
                                                <button type="submit" class="btn btn-primary" data-toggle="tooltip"
                                                        data-html="true" title="สร้างกลุ่ม">บันทึก
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


            <!-- begin col-6 -->
            <div class="col-xl-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading" style="background: white">
                        <h4 class="panel-title">ตารางแสดงกลุ่ม</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                               data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <table id="data-table-responsive-group" width="100%"
                               class="table table-bordered table-td-valign-middle">
                            @if (session('error'))
                                <div style="text-align: left; font-size: 16px; color: #ff0000;text-align: center;"
                                     class="alert alert-danger fade show">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <i class="fas fa-lg fa-fw mr-10 fa-times-circle"></i>{{ session('error') }}
                                </div>
                            @endif
                            <thead>
                            <tr>
                                <th class="text-nowrap">ชื่อ</th>
                                <th class="text-nowrap">รายละเอียด</th>
                                <th class="text-nowrap">ผู้ดูแล</th>
                                <th class="text-nowrap">สถานะ</th>
                                <th class="text-nowrap">เครื่องมือ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datagroup as $datagroups)
                                <tr class="odd gradeX">
                                    <td>{{$datagroups->group_name}}</td>
                                    <td>{{$datagroups->group_description}}</td>
                                    <td>{{$datagroups->users_name}}</td>
                                    @if( $datagroups->group_status==1)
                                        <td style="text-align: center;">
                                            <span class="label label-teal" style="font-size: 16px;">เปิด</span>
                                        </td>
                                    @elseif( $datagroups->group_status==2)
                                        <td style=",kqtext-align: center;">
                                            <span class="label label-red" style="font-size: 16px;">ปิด</span>
                                        </td>
                                    @endif
                                    <td style="width: 320px; text-align: center">
                                        @if( $datagroups->group_status==1)
                                            <a href="#modal-dialog{{$datagroups->group_id}}"
                                               class="btn btn-primary width-100" data-toggle="modal">เพิ่มสมาชิก</a>
                                        @elseif($datagroups->group_status==2)
                                            <a href="#" class="btn btn-default width-100"
                                               data-toggle="#">เพิ่มสมาชิก</a>
                                        @endif
                                        {{--                                    <a href="/admincreategroup/delete/{{ $datagroups->group_id}}" class="btn btn-danger width-100" ><i class="ion ion-md-trash"></i> สถานะ</a>--}}
                                        {{--                                    <a href="#modal-alert{{$datagroups->group_id}}" class="btn  btn-warning width-50" data-toggle="modal"><i class="ion ion-md-eye"></i></a>--}}
                                        <a href="#modal-alert" class="btn btn-warning width-100 btn-view-modal-alert"
                                           group_id="{{$datagroups->group_id}}" group_name="{{$datagroups->group_name}}"
                                           data-toggle="modal">ดูสมาชิก</a>
                                        <a href="#modal-without-animation{{$datagroups->group_id}}"
                                           class="btn btn-pink width-100" data-toggle="modal">แก้ไข</a>
                                    </td>
                                </tr>
                                <div class="modal fade addusergroup" id="modal-dialog{{$datagroups->group_id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">เพิ่มผู้ใช้</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">
                                                    ×
                                                </button>
                                            </div>
                                            <form class="form-horizontal form-bordered"
                                                  action="{{url('/admincreategroup/adduser')}}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">ผู้ใช้</label>
                                                        <div class="col-lg-4">
                                                            <div class="input-group">
                                                                <input name="user_serach" type="text" mode="group"
                                                                       class="form-control">
                                                                <span class="input-group-append">
												<button class="btn btn-inverse btn-searchs" type="button" mode="group" id="{{$datagroups->group_id}}"><i
                                                            class="fa fa-search"></i></button>
											</span>
                                                            </div>
                                                        </div>
                                                    <div class="col-lg-6">
                                                        <div class="row row-space-10">
                                                            <input type="hidden" name="group_id"
                                                                   value="{{$datagroups->group_id}}">
                                                            <div class="col-lg-12">
                                                                <select  name="user_id" required id="{{$datagroups->group_id}}" mode="group"
                                                                        class="form-control mb-3 usersname">
                                                                    <option value="" selected="">ค้นหาผู้ใช้
                                                                    </option>
                                                                </select>
                                                                <input type="hidden" name="fullname">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:;" class="btn btn-white"
                                                       data-dismiss="modal">Close</a>
                                                    <button type="submit" class="btn btn-primary">เพิ่ม</button>
                                                </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modal-without-animation{{$datagroups->group_id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{ $datagroups->group_name}}(แก้ไข)</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">
                                                    ×
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal form-bordered"
                                                      action="{{url('/admincreategroup/update')}}" method="post">
                                                    <div class="panel-body panel-form">

                                                        <div class="container">
                                                            @csrf
                                                            <div class="form-group row">
                                                                <label class="col-lg-4 col-form-label">ชื่อกลุ่ม </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group date">
                                                                        <input type="text" class="form-control"
                                                                               name="names"
                                                                               value="{{ $datagroups->group_name}}"
                                                                               required/>
                                                                        <input type="text" class="form-control"
                                                                               hidden="hidden" name="id"
                                                                               value="{{ $datagroups->group_id}}"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-lg-4 col-form-label">รายละเอียด </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group date">
                                                                    <textarea class="form-control" name="description"
                                                                              rows="8">{{ $datagroups->group_description}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-lg-4 col-form-label">สถานะ </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group date">
                                                                        <?php
                                                                        $check_status_1 = ($datagroups->group_status == 1) ? 'checked' : '';
                                                                        $check_status_2 = ($datagroups->group_status == 2) ? 'checked' : '';
                                                                        ?>

                                                                        <label> <input type="radio" name="status"
                                                                                       value="1" {{$check_status_1}}>
                                                                            เปิด</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <label> <input type="radio" name="status"
                                                                                       value="2" {{$check_status_2}}>
                                                                            ปิด</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="javascript:;" class="btn btn-danger"
                                                           data-dismiss="modal">ปิด</a>
                                                        <button type="submit" class="btn btn-primary">บันทึก</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-alert">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <table id="data-table-responsive-groupshares" style="width: 100%" class="table">
                        <thead>
                        <tr>
                            <th class="text-nowrap">ลำดับ</th>
                            <th class="text-nowrap">ชื่อ</th>
                            <th class="text-nowrap">ลบ</th>
                        </tr>
                        </thead>
                        <tbody class="tbody-data-list">

                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-danger" data-dismiss="modal">ปิด</a>
                </div>
            </div>
        </div>
    </div>


@endsection


<input type="hidden" class="input-hidden-accessToken">



@section('script')
    <script>

        $(".selectadmin").selectpicker('show');


        $('.div-create-group').hide();


        $(document).on("click", '.btn-swith-show-div-create-group', function () {
            if ($(this).find('i').attr('class') == 'fa fa-plus') {
                $(this).html('<i class="fa fa-minus"></i>');
            } else {
                $(this).html('<i class="fa fa-plus"></i>');
            }
        });


        $('.btn-view-modal-alert').click(function () {
            var group_id = $(this).attr('group_id');
            var group_name = $(this).attr('group_name');

            $('.modal-title').html(group_name);

            $.ajax({
                url: "/admincreategroup/get-data",
                type: "post",
                data: {'group_id': group_id},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                },
                success: function (response) {

                    $('.tbody-data-list').html('');
                    $(response.data).each(function (index, value) {
                        index++;
                        $('.tbody-data-list').append('<tr><td>' + index + '</td><td>' + value.users_name + '</td><td style="text-align: center;width: 120px""><a class="btn btn-red" href="/admincreategroup/delete/' + value.id + '">ออกจากกลุ่ม</a></td></tr>');
                    });
                }
            });
        });
        $('#data-table-responsive-group').DataTable({
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
        $('#data-table-responsive-groupshares').DataTable({
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
        var html = '';
        $(document).on("click", ".btn-searchs", function () {
            var btn_id = $(this).attr('id');
            html = '';
            $.ajax({
                url: "http://e-asset.nsru.ac.th/service/get/sys-token",
                type: "get",
                data: {'userRequestor': 'jirakiat'},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                },
                success: function (response) {
                    $('.input-hidden-accessToken').val(response['accessToken']);
                    var token = $('.input-hidden-accessToken').val();
                    var user = $('#modal-dialog'+btn_id+' input[name="user_serach"]').val();
                    serachusername(token, user);

                }
            });
        });
        $(document).on("change", ".usersname", function () {
            var mode = $(this).attr('mode'),
                btn_id = $(this).attr('id');
            if(btn_id != undefined){
                var user = $('#modal-dialog'+btn_id+' select[name="user_id"][mode="'+mode+'"] option:selected').text();
            } else {
                var user = $('.usersname option:selected').text();
            }
            $('input[name=fullname]').val(user);

        });

        function serachusername(token, user,mode) {
            var mode = $(this).attr('mode'),
                btn_id = $(this).attr('id');
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

        $(".addusergroup").on("keypress", function (event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });

    </script>

@endsection











