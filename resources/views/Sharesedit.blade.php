@extends('master')
@section('content')
    <div id="content" class="content">
        <ol class="breadcrumb float-xl-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">หน้าแรก</a></li>
            <li class="breadcrumb-item"><a href="{{url('task')}}">จัดการกิจกรรมของฉัน</a></li>
            <li class="breadcrumb-item active">กิจกรรมที่ฉันแชร์</li>
        </ol>
        <h1 class="page-header">กิจกรรมที่ฉันแชร์
        </h1>
        <div class="row">
            <div class="col-xl-12">
                <br>
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading" style="background: white;">
                        <h4 class="panel-title"></h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                               data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body" style="text-align: center">
                        <table id="data-table-responsive-member" width="100%"
                               class="table table-striped table-td-valign-middle hover">
                            @if (session('error'))
                                <div style="text-align: left; font-size: 16px; color: #ff0000;text-align: center;"
                                     class="alert alert-danger fade show">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <i class="fas fa-lg fa-fw mr-10 fa-times-circle"></i>{{ session('error') }}
                                </div>
                            @endif
                            <thead>
                            <tr>
                                <th class="text-nowrap">กิจกรรม</th>
                                <th class="text-nowrap">รายละเอียด</th>
                                <th class="text-nowrap">วันเวลา</th>
                                <th class="text-nowrap">สี</th>
                                <th class="text-nowrap">แชร์ให้กับ</th>
                                <th class="text-nowrap">เครื่องมือ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sharesedit as $sharesedits)
                                @if($sharesedits->events_status==4 or $sharesedits->events_status==9)
                                    <tr class="odd gradeX">
                                        <td style="width: 20%;">
                                            @if($sharesedits->events_status==9)
                                                {{$sharesedits->events_name}}
                                                <br>
                                                <b style="font-size: 12px;color: red">(หมายเหตุ:{{$sharesedits->event_note}}
                                                    )</b>
                                            @elseif($sharesedits->events_status==4)
                                                {{$sharesedits->events_name}}
                                            @endif
                                        </td>
                                        <td style="width: 20%;"> {{(!empty( $sharesedits->event_description)?  $sharesedits->event_description : '-')}}</td>
                                        <td style="width: 15%;">{{$sharesedits->thaidatestart}}
                                            -{{$sharesedits->thaidateend}}</td>
                                        <td style="width: 5%;"><p class="btn"
                                                                  style="background: {{$sharesedits->color}};width: 100%;height: 100%;">
                                                &nbsp;</p></td>

                                        </td>
                                        <td style="width: 15%;text-align: left;">
                                            @foreach($test as $tests)
                                                @if($sharesedits->events_id==$tests->events_id)
                                                    <i class="fas fa-caret-right"></i>&nbsp;
                                                    {{$tests->users_name}}
                                                    <a href="#modal-alert{{$tests->event_shares_id }}"
                                                       style="color: red"
                                                       data-toggle="modal"><i class="fas fa-sm fa-trash-alt"></i></a>
                                                    <br>
                                                    @if($tests->event_shares_statuss==1)
                                                        (
                                                        <span style="color: green;font-size: 12px"><i
                                                                    class="fa fa-check-circle"></i> Accept เวลา :{{ $tests->thaivertifytime}}</span>
                                                        )
                                                    @elseif($tests->event_shares_statuss==3)
                                                        (
                                                        <span style="color: red;font-size: 12px"><i
                                                                    class="fa fa-times-circle"></i>  Reject  เวลา :{{$tests->thaivertifytime}}</span>
                                                        )
                                                    @elseif($tests->event_shares_statuss==0)
                                                        (
                                                        <span style="color: cornflowerblue;font-size: 12px"><i
                                                                    class="fas fa-spinner fa-pulse"></i> กำลังดำเนินการ </span>
                                                        )
                                                    @elseif($tests->event_shares_statuss==5)
                                                        (
                                                        <span style="color: black;font-size: 12px"><i
                                                                    class="far fa-eye-slash"></i> เผิกเฉย {{$tests->thaivertifytime}}</span>
                                                        )
                                                    @endif
                                                    <br>
                                                @endif
                                                <div class="modal fade" id="modal-alert{{$tests->event_shares_id }}">
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
                                                                  action="{{url('/task/deleteusershare')}}"
                                                                  method="post">
                                                                @csrf
                                                                <div class="modal-body" style="font-size: 18px;text-align: center">
                                                                    <div class="alert alert-danger m-b-0">
                                                                        <div class="form-group row">
                                                                            <label class="col-lg-12 col-form-label center"><b
                                                                                        style="color: red">
                                                                                    <i class="fas fa-exclamation-triangle"></i>
                                                                                    คุณต้องการลบ {{$tests->users_name}}
                                                                                    ออกจากกิจกรรม {{$tests->events_name}}
                                                                                    ใช่/ไม่ </b></label>
                                                                        <input type="hidden"
                                                                               value="{{$tests->event_shares_id  }}"
                                                                               name="event_shares_id">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="javascript:;" class="btn btn-danger"
                                                                       data-dismiss="modal">ยกเลิก</a>
                                                                    <button class="btn btn-primary" type="submit">ยืนยัน
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td style="width: 20%; text-align: center">
                                            @if($sharesedits->events_status==4)
                                                <a href="shareedit/update/{{$sharesedits->events_id}}"
                                                   class="btn  btn-primary width-80" >แก้ไข</a>
                                                <a href="#modal-message{{$sharesedits->events_id}}"
                                                   class="btn btn-warning width-50"
                                                   data-toggle="modal">แชร์</a>
                                                <a href="#modal-dialog{{$sharesedits->events_id}}"
                                                   class="btn btn-pink width-60"
                                                   data-toggle="modal">ยกเลิก</a>
                                            @elseif($sharesedits->events_status==9)
                                                <p style="color: red">ยกเลิก</p>
                                            @endif
                                        </td>
                                        {{--                                    <td style="width: 5%;">{{$assignshows->creat_users_ldap}}</td>--}}
                                    </tr>
                                    <div class="modal fade" id="modal-dialog{{$sharesedits->events_id}}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">  {{$sharesedits->events_name}}(ยกเลิก)</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×
                                                    </button>
                                                </div>
                                                <form class="form-horizontal form-bordered"
                                                      action="{{url('/task/cancel/share')}}"
                                                      method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label">หมายเหตุ </label>
                                                            <div class="col-lg-8">
                                                                <div class="input-group date">
                                                                    <input type="text" class="form-control"
                                                                           name="event_note"
                                                                           value="" required>
                                                                    <input type="text" class="form-control"
                                                                           hidden="hidden" name="id"
                                                                           value="{{$sharesedits->events_id}}"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="javascript:;" class="btn btn-danger"
                                                           data-dismiss="modal">ปิด</a>
                                                        <button class="btn btn-primary">ยืนยัน</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade shareedit" id="modal-message{{$sharesedits->events_id}}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">แชร์</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×
                                                    </button>
                                                </div>
                                                <form class="form-horizontal form-bordered"
                                                      action="{{url('/task/shareevent/shareedit')}}"
                                                      method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label class="col-lg-2 col-form-label">ผู้ใช้</label>
                                                            <div class="col-lg-4">
                                                                <div class="input-group">
                                                                    <input name="user_serach" type="text" mode="shared"
                                                                           class="form-control">
                                                                    <span class="input-group-append">
												<button class="btn btn-inverse btn-searchs" type="button"
                                                        id="{{$sharesedits->events_id}}" mode="shared"><i
                                                            class="fa fa-search"></i></button>
											</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="row row-space-10">
                                                                    <div class="col-lg-12">
                                                                        <select name="user_id" mode="shared"
                                                                                id="{{$sharesedits->events_id}}"
                                                                                class="form-control mb-3 usersname">
                                                                            <option value="" selected="">ค้นหาผู้ใช้
                                                                            </option>
                                                                        </select>
                                                                        <input type="hidden" name="fullname">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" value="{{$sharesedits->events_id}}"
                                                               name="events_id">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="javascript:;" class="btn btn-danger"
                                                           data-dismiss="modal">ปิด</a>
                                                        <button class="btn btn-primary">ยืนยัน</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-without-animation{{$sharesedits->events_id}}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{$sharesedits->events_name}}(แก้ไข)</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">
                                                        ×
                                                    </button>
                                                </div>
                                                <form class="form-horizontal form-bordered"
                                                      action="{{url('/task/update/share')}}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label">ชื่อกิจกรรม </label>
                                                            <div class="col-lg-8">
                                                                <div class="input-group date">
                                                                    <input type="text" class="form-control" name="names"
                                                                           value="{{$sharesedits->events_name}}"
                                                                           required/>
                                                                    <input type="text" class="form-control"
                                                                           hidden="hidden" name="id"
                                                                           value="{{$sharesedits->events_id}}"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-lg-4 col-form-label">รายละเอียด </label>
                                                            <div class="col-lg-8">
                                                                <div class="input-group date">
                                                        <textarea class="form-control" name="description"
                                                                  rows="8">{{$sharesedits->event_description}}</textarea>
                                                                </div>
                                                            </div>
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
                            @endif
                            @endforeach
                        </table>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <p class="badge-yellow"></p>
@endsection


<input type="hidden" class="input-hidden-accessToken">



@section('script')
    <script>
        function user(src) {
            $('.div-showuser').show();
            $('.div-showgroup').hide();
            // $('.test ').removeClass('badge-warning');
            // $('.test ').addClass('note-warning');
        }

        function group(src) {
            $('.div-showgroup').show();
            $('.div-showuser').hide();
            // $('.test ').removeClass('badge-aqua');
            // $('.test ').addClass('badge-warning');
        }


        $('.div-showuser').hide();
        $('.div-showgroup').hide();
        $('#data-table-responsive-member').DataTable({
            responsive: true,
            "order": [[2, "asc"],],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "lengthMenu": "แสดง _MENU_ รายการ",
                "search": "ค้นหา:",
                "zeroRecords": "ไม่มีข้อมูล",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล",
            }
        });


        var html = '';


        $(document).on("click", ".btn-searchs", function () {
            var mode = $(this).attr('mode'),
                btn_id = $(this).attr('id');
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

                    if (btn_id != undefined) {
                        var user = $('#modal-message' + btn_id + ' input[name="user_serach"][mode="' + mode + '"]').val();
                    } else {
                        var user = $('input[name="user_serach"][mode="' + mode + '"]').val();
                    }

                    serachusername(token, user, mode);
                }
            });
        });


        $(document).on("change", ".usersname", function () {
            var mode = $(this).attr('mode'),
                btn_id = $(this).attr('id');
            if (btn_id != undefined) {
                var user = $('#modal-message' + btn_id + ' select[name="user_id"][mode="' + mode + '"] option:selected').text();
            } else {
                var user = $('.usersname option:selected').text();
            }
            $('input[name=fullname]').val(user);

        });


        function serachusername(token, user, mode) {
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
                    $('.usersname[mode="' + mode + '"]').append(html);
                }
            });
        }


        $(".shareedit").on("keypress", function (event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });


    </script>
@endsection

