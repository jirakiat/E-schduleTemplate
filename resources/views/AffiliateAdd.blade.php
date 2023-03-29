@extends('master')
@section('content')
    <!-- begin #content -->
    <div id="content" class="content" >
        <ol class="breadcrumb float-xl-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">หน้าแรก</a></li>
            <li class="breadcrumb-item active">หน่วยงานที่ดูแล</li>
        </ol>
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">หน่วยงานที่ดูแล<small></small></h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading" style="background: white">
                    <h4 class="panel-title"style="color: black;"></h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                           data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                        <table id="data-table-responsive-affiliate" width="100%"  class="table table-bordered table-td-valign-middle">
                        @if (session('error'))
                            <div style="text-align: left; font-size: 16px; color: #ff0000;text-align: center;" class="alert alert-danger fade show">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <i class="fas fa-lg fa-fw mr-10 fa-times-circle"></i>{{ session('error') }}
                            </div>
                        @endif
                        <thead>
                        <tr>
                            <th class="text-nowrap">ชื่อ</th>
                            <th class="text-nowrap">รายละเอียด</th>
                            <th class="text-nowrap">เครื่องมือ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($affiliate as $affiliates)
                        <tr class="odd gradeX">
                            <td  style="width: 200px;">{{ $affiliates->affiliate_name}}</td>
                            <td>{{ $affiliates->affiliate_description	}}</td>
                            <td style="width: 220px;text-align: center">
                                <a href="#modal-dialog{{ $affiliates->affiliate_id}}" class="btn btn-primary width-100" data-toggle="modal">เพิ่มสมาชิก</a>
                                <a href="#modal-alert" class="btn btn-warning width-100 btn-view-modal-alert" affiliate_id="{{$affiliates->affiliate_id}}" affiliate_name="{{ $affiliates->affiliate_name}}" data-toggle="modal">ดูสมาชิก</a>
                            </td>
                        </tr>
                        <div class="modal fade adduseraffiliate" id="modal-dialog{{ $affiliates->affiliate_id}}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">เพิ่มผู้ใช้</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <form class="form-horizontal form-bordered" action="{{url('/affiliateadd/adduser')}}" method="post">
                                        @csrf
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">ผู้ใช้</label>
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    <input name="user_serach" type="text" mode="affiliate"
                                                           class="form-control">
                                                    <span class="input-group-append">
												<button class="btn btn-inverse btn-searchs" type="button" mode="affiliate" id="{{$affiliates->affiliate_id}}"><i
                                                            class="fa fa-search"></i></button>
											</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row row-space-10">
                                                    <input type="hidden" name="affiliate_id"
                                                           value="{{ $affiliates->affiliate_id}}">
                                                    <div class="col-lg-12">
                                                        <select  name="user_id" required id="{{ $affiliates->affiliate_id}}"mode="affiliate"
                                                                 class="form-control mb-3 usersname">
                                                            <option value="" selected="">ค้นหาผู้ใช้
                                                            </option>
                                                        </select>
                                                        <input type="hidden" name="fullname">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal">ปิด</a>
                                        <button type="submit" class="btn btn-primary">เพิ่ม</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                </tbody>
                @endforeach
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
    <div class="modal fade" id="modal-alert">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <table id="data-table-colreorder" width="100%" class="table">
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
        $('.btn-view-modal-alert').click(function() {
            var affiliate_id = $(this).attr('affiliate_id');
            var affiliate_name = $(this).attr('affiliate_name');

            // console.log('affiliate_id : '+affiliate_id);
            // console.log('affiliate_name : '+affiliate_name);
            $('.modal-title').html(affiliate_name);

            $.ajax({
                url: "/affiliateadd/get-data",
                type: "post",
                data: {'affiliate_id': affiliate_id} ,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                },
                success: function (response) {
                    //console.log(response);
                    // $('.modal-body').html(response.html);


                    $('.tbody-data-list').html('');
                    $(response.data).each(function( index, value ) {
                        index++;
                        $('.tbody-data-list').append('<tr><td>'+index+'</td><td>'+value.users_name+'</td><td style="text-align: center;width: 120px"><a class="btn btn-red" href="/affiliateadd/deleteuser/'+value.affiliate_shares_id+'">ออกจากกลุ่ม</a></td></tr>');
                    });
                }
            });
        });

        $('#data-table-responsive-affiliate').DataTable({
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

        $(".adduseraffiliate").on("keypress", function (event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });

    </script>

@endsection
