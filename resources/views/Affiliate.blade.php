@extends('master')
@section('content')
    <div id="content" class="content">
        <ol class="breadcrumb float-xl-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">หน้าแรก</a></li>
            <li class="breadcrumb-item active">จัดการหน่วยงาน</li>
        </ol>
        <h1 class="page-header">จัดการหน่วยงาน</h1>
        <div class="row">
            <div class="col-xl-12">
                <div class="panel panel-inverse">
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">

                        <div class="panel-heading" style="background: white">
                            <h4 class="panel-title" style="color: black;font-size: 16px;">สร้างหน่วยงาน</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;"
                                   class="btn btn-xs btn-icon btn-circle btn-warning btn-swith-show-div-create-affiliate"
                                   data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="panel-body panel-form div-create-affiliate addaffiliate">
                            <form class="form-horizontal form-bordered"  action="{{url('Affiliate/insert')}}"
                                  method="post">
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
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">ชื่อหน่วยงาน</label>
                                    <div class="col-lg-8">
                                        <div class="input-group date">
                                            <input type="text" class="form-control" name="names" required
                                                   data-toggle="tooltip" data-html="true" title="รายละเอียด"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">รายละเอียด</label>
                                    <div class="col-lg-8">
                                        <div class="input-group date">
                                            <textarea class="form-control" name="description" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label"></label>
                                    <div class="col-lg-8">
                                        <div class="row row-space-10">
                                            <div class="col-xs-6">
                                                <button type="submit" class="btn btn-primary"
                                                        data-toggle="tooltip" data-html="true"
                                                        title="เพิ่มหน่วยงาน">บันทึก
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
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading" style="background: white">
                        <h4 class="panel-title">ตารางแสดงหน่วยงาน</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                               data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="data-table-responsive-manageaffiliate" width="100%"
                               class="table table-bordered table-td-valign-middle">
                            <thead>
                            <tr>
                                <th class="text-nowrap">หน่วยงาน</th>
                                <th class="text-nowrap">รายละเอียด</th>
                                <th class="text-nowrap">ผู้ดูแล</th>
                                <th class="text-nowrap">เครื่องมือ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($affiliate as $affiliates)
                                <tr class="odd gradeX">
                                    <td style="width: 20%;">{{ $affiliates->affiliate_name}}</td>
                                    <td style="width: 20%;">{{(!empty( $affiliates->affiliate_description)?  $affiliates->affiliate_description : '-')}}</td>
                                    <td style="width: 10%;">{{(!empty( $affiliates->users_name)?  $affiliates->users_name : '-')}}</td>
                                    <td style="width: 15%;text-align: center">
                                        <a href="#modal-dialog{{ $affiliates->affiliate_id}}"
                                           class="btn  btn-primary width-80" data-toggle="modal">แก้ไข</a>
                                        <a href="#modal-alert{{ $affiliates->affiliate_id}}"
                                           class="btn btn-danger width-80"
                                           data-toggle="modal"> ลบ</a>
                                        @if( $affiliates->users_ldap===null)
                                            <a href="#modal-without-animation{{ $affiliates->affiliate_id}}"
                                               class="btn btn btn-info" data-toggle="modal">เพิ่มผู้ดูแล</a>
                                        @endif
                                    </td>


                                </tr>
                                <div class="modal fade" id="modal-without-animation{{ $affiliates->affiliate_id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">เพิ่มแอดมิน</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×
                                                </button>
                                            </div>
                                            <form action="{{url('Affiliate/updateadmin')}}" method="post">
                                                <div class="modal-body">
                                                    @csrf
                                                    <input type="hidden" class="form-control" name="id"
                                                           value="{{ $affiliates->affiliate_id}}"/>
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label">ผู้ดูแล</label>
                                                        <div class="col-lg-8">
                                                            <input class="form-control" type="text" name="userldap"
                                                                   autocomplete="false">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">ปิด</a>
                                                    <button type="submit" class="btn btn-success">เพิ่มผู้ดูแล</button>

                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modal-alert{{$affiliates->affiliate_id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">ยืนยันการลบ</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×
                                                </button>
                                            </div>
                                            <form class="form-horizontal form-bordered"
                                                  action="{{url('/affiliate/deleteaffiliate')}}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="alert alert-danger m-b-0">
                                                        <p><b>หน่วยงาน</b>&nbsp;{{$affiliates->affiliate_name}}</p>
                                                        <p><b>รายละเอียด</b>&nbsp;{{$affiliates->affiliate_description}}
                                                        </p>
                                                        <p>
                                                            <b>ผู้ดูแล</b>&nbsp;{{(!empty( $affiliates->users_name)?  $affiliates->users_name : '-')}}
                                                        </p>
                                                        <input type="hidden" value="{{$affiliates->affiliate_id }}"
                                                               name="affiliate_id">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">ปิด</a>
                                                    <button class="btn btn-danger" type="submit">ลบ</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade " id="modal-dialog{{ $affiliates->affiliate_id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">แก้ไข้หน่วยงาน </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal form-bordered"
                                                      action="{{url('Affiliate/update')}}" method="post">
                                                    <div class="panel-body panel-form">

                                                        <div class="container">
                                                            @csrf
                                                            <div class="form-group row">
                                                                <label class="col-lg-4 col-form-label">ชื่อหน่วยงาน </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group date">
                                                                        <input type="text" class="form-control"
                                                                               name="names"
                                                                               value="{{ $affiliates->affiliate_name}}"
                                                                               required/>
                                                                        <input type="text" class="form-control"
                                                                               hidden="hidden" name="id"
                                                                               value="{{ $affiliates->affiliate_id}}"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-lg-4 col-form-label">รายละเอียด </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group date">
                                                                        <textarea class="form-control"
                                                                                  name="description"
                                                                                  rows="8">{{ $affiliates->affiliate_description}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="javascript:;" class="btn btn-danger"
                                                           data-dismiss="modal">ปิด</a>
                                                        <button type="submit" class="btn btn-primary"><i
                                                                    class="fas fa-lg fa-fw fa-save"></i>บันทึก
                                                        </button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<input type="hidden" class="input-hidden-accessToken">
@section('script')
    <script>

        $(document).on("click",".btn-searchs",function() {
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
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "lengthMenu": "แสดง _MENU_ รายการ",
                "zeroRecords": "Nothing found - sorry",
                "search": "ค้นหา:",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล ",
            }
        });


        $(".addaffiliate").on("keypress", function (event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });
    </script>

@endsection