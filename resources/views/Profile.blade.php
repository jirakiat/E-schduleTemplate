@extends('master')
@section('content')
    <div id="content" class="content content-full-width">
        <!-- end profile -->
        <!-- begin profile-content -->
        <div class="profile-content">
            <div class="col-lg-12 ">
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading" style="background: white">
                        <h4 class="panel-title" style="color: black;">กิจกรรมทั้งหมด</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                               data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="widget widget-stats  bg-blue">
                                    <div class="stats-icon"><i class="fa fa-share-alt"></i></div>
                                    <div class="stats-info">
                                        <h4>กิจกรรมที่แชร์กับฉัน</h4>
                                        <p>{{$share}} รายการ</p>
                                    </div>
                                    <div class="stats-link">
                                        <a href="eventshare">ดูกิจกรรม <i
                                                    class="fa fa-arrow-alt-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="widget widget-stats bg-blue">
                                    <div class="stats-icon"><i class="fa fa-share-alt-square"></i></div>
                                    <div class="stats-info">
                                        <h4>กิจกรรมที่ฉันแชร์ให้ผู้อื่น</h4>
                                        <p>{{$sharemember}} รายการ</p>
                                    </div>
                                    <div class="stats-link">
                                        <a href="shareedit">ดูกิจกรรม <i
                                                    class="fa fa-arrow-alt-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="widget widget-stats  bg-blue">
                                    <div class="stats-icon"><i class="fa fa-share-square"></i></div>
                                    <div class="stats-info">
                                        <h4>กิจกรรมที่ได้รับมอบหมาย</h4>
                                        <p>{{$assign}} รายการ</p>
                                    </div>
                                    <div class="stats-link">
                                        <a href="assign">ดูกิจกรรม <i
                                                    class="fa fa-arrow-alt-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="widget widget-stats  bg-blue">
                                    <div class="stats-icon"><i class="fa fa-user-plus"></i></div>
                                    <div class="stats-info">
                                        <h4>กิจกรรมที่ฉันมอบหมายผู้อื่น</h4>
                                        <p>{{$assignmember}} รายการ</p>
                                    </div>
                                    <div class="stats-link">
                                        <a href="assignedit">ดูกิจกรรม <i
                                                    class="fa fa-arrow-alt-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 ">
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading" style="background: white">
                        <h4 class="panel-title" style="color: black;">หน่วยงาน</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                               data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <div class="row">
                            @foreach($affiliate as $affiliates)
                                <div class="col-xl-3 col-md-6">
                                    <div class="widget widget-stats bg-blue">
                                        <div class="stats-icon"><i class="fa fa-university"></i></div>
                                        <div class="stats-info">
                                            <p>{{$affiliates->affiliate_name}}</p>
                                        </div>
                                        <div class="stats-link">
                                            <a href="/affiliate/events/{{$affiliates->affiliate_id}}">ดูกิจกรรม <i
                                                        class="fa fa-arrow-alt-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 ">
                <div class="panel panel-inverse">
                    <!-- begin panel-heading -->
                    <div class="panel-heading" style="background: white">
                        <h4 class="panel-title" style="color: black;">กลุ่มงาน</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                               data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <div class="row">
                            @foreach($group as $groups)
                                <div class="col-xl-3 col-md-6">
                                    <div class="widget widget-stats bg-blue">
                                        <div class="stats-icon"><i class="fa fa-users"></i></div>
                                        <div class="stats-info">
                                            <p>{{$groups->group_name}}</p>
                                        </div>
                                        <div class="stats-link">
                                            <a href="/group/events/{{$groups->group_id}}">ดูกิจกรรม <i
                                                        class="fa fa-arrow-alt-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end table -->

@endsection
@section('script')

@endsection
