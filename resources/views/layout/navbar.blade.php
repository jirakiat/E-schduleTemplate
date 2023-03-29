<div id="page-loader" class="fade show">
    <div class="material-loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
        <div class="message">กำลังโหลด...</div>
    </div>
</div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar">
    <!-- begin #header -->
    <div id="header" class="header navbar-default">
        <!-- begin navbar-header -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed navbar-toggle-left" data-click="sidebar-minify">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{url('dashboard')}}" class="navbar-brand">
            <img class="logo" src="{{asset('assets/template_html/assets/img/logo/logo-eschedule.png')}}">
            </a>
        </div>
        <!-- end navbar-header --><!-- begin header-nav -->
        <ul class="navbar-nav navbar-right">
            <li class="dropdown navbar-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="d-none d-md-inline">{{ session('full_name') }}</span>
                    <img  src=" {{ session('portrait_image')}}" alt="" />
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a  href="{{url('signout')}}" class="dropdown-item">ออกจากระบบ</a>
                </div>
            </li>
        </ul>
        <!-- end header navigation right -->

    </div>
    <!-- end #header -->

    <!-- begin #sidebar -->
    <div id="sidebar" class="sidebar" data-disable-slide-animation="true">
        <!-- begin sidebar scrollbar -->
        <div data-scrollbar="true" data-height="100%">
            <!-- begin sidebar user -->
            <ul class="nav">
                <li class="nav-profile">
                    <a href="javascript:;" data-toggle="nav-profile">
                        <div class="cover with-shadow"></div>
                        <div class="info">
                            <b class="caret pull-right"></b>{{ session('full_name') }}
                            <small></small>
                            <small></small>
                        </div>
                    </a>
                </li>
                <li>
                    <ul class="nav nav-profile">
                        <li><a href="{{url('/profile')}}"><i class="fa fa-user"></i> บัญชี</a></li>
                        <li><a href="{{url('/signout')}}"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a></li>
                    </ul>
                </li>
            </ul>
            <!-- end sidebar user -->
            <!-- begin sidebar nav -->
            <ul class="nav">
                @if(session('statususer')==1)
                <li class="has-sub active">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="material-icons">home</i>
                        <span>Super Admin</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{url('/dashboard')}}">
                                <i class="fa fa-th-large"></i>
                                <span>แดชบอร์ด</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('main')}}">
                                <i class="far fa-calendar-alt"></i>
                                <span>ปฏิทินของฉัน</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('task')}}">
                                <i class="fas fa-edit"></i>
                                <span>จัดการกิจกรรมของฉัน</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('assign')}}">
                                <i class="fas fa-share-square"></i>
                                <span>กิจกรรมที่ฉันได้รับมอบหมาย</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('assignedit')}}">
                                <i class="fas fa-user-plus"></i>
                                <span>กิจกรรมที่ฉันมอบหมายผู้อื่น</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('eventshare')}}">
                                <i class="fas fa-share-alt"></i>
                                <span>กิจกรรมที่แชร์กับฉัน</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('shareedit')}}">
                                <i class="fas fa-share-alt-square"></i>
                                <span>กิจกรรมที่ฉันแชร์ให้ผู้อื่น</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('affiliateadd')}}">
                                <i class="fas fa-university"></i>
                                <span>หน่วยงานที่ดูแล</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admincreategroup')}}">
                                <i class="fas fa-users"></i>
                                <span>จัดการกลุ่ม</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('userform')}}">
                                <i class="fas fa-lock"></i>
                                <span>จัดการสิทธิผู้ดูแล</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('createstatus')}}">
                                <i class="fas fa-lock"></i>
                                <span>เพิ่มสิทธิ</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('affiliate')}}">
                                <i class="fas fa-university"></i>
                                <span>จัดการหน่วยงาน</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('addeventadayoff')}}">
                                <i class="fas fa-calendar-plus"></i>
                                <span>จัดการปฏิทินวันหยุด</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @elseif(session('statususer')==2)
                    <li class="has-sub active">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="material-icons">account_box</i>
                            <span>Admin</span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{url('dashboard')}}">
                                    <i class="fa fa-th-large"></i>
                                    <span>แดชบอร์ด</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('main')}}">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>ปฏิทินของฉัน</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('task')}}">
                                    <i class="fas fa-edit"></i>
                                    <span>จัดการกิจกรรมของฉัน</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('assign')}}">
                                    <i class="fas fa-share-square"></i>
                                    <span>กิจกรรมที่ฉันได้รับมอบหมาย</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('assignedit')}}">
                                    <i class="fas fa-user-plus"></i>
                                    <span>กิจกรรมที่ฉันมอบหมายผู้อื่น</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('eventshare')}}">
                                    <i class="fas fa-share-alt"></i>
                                    <span>กิจกรรมที่แชร์กับฉัน</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('shareedit')}}">
                                    <i class="fas fa-share-alt-square"></i>
                                    <span>กิจกรรมที่ฉันแชร์ให้ผู้อื่น</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('affiliateadd')}}">
                                    <i class="fas fa-university"></i>
                                    <span>หน่วยงานที่ดูแล</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admincreategroup')}}">
                                    <i class="fas fa-users"></i>
                                    <span>จัดการกลุ่ม</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @elseif(session('statususer')==null)
                    <li class="has-sub active">
                        <a href="javascript:;">
                            <b class="caret"></b>
                            <i class="material-icons">account_box</i>
                            <span>ผู้ใช้ทั่วไป</span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{url('dashboard')}}">
                                    <i class="fa fa-th-large"></i>
                                    <span>แดชบอร์ด</span>
                                </a>
                            </li>
                            <li>
                            <a href="{{url('main')}}">
                                <i class="far fa-calendar-alt"></i>
                                <span>ปฏิทินของฉัน</span>
                            </a>
                            </li>
                            <li>
                                <a href="{{url('task')}}">
                                    <i class="fas fa-edit"></i>
                                    <span>จัดการกิจกรรมของฉัน</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('assign')}}">
                                    <i class="fas fa-share-square"></i>
                                    <span>กิจกรรมที่ฉันได้รับมอบหมาย</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('assignedit')}}">
                                    <i class="fas fa-user-plus"></i>
                                    <span>กิจกรรมที่ฉันมอบหมายผู้อื่น</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('eventshare')}}">
                                    <i class="fas fa-share-alt"></i>
                                    <span>กิจกรรมที่แชร์กับฉัน</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('shareedit')}}">
                                    <i class="fas fa-share-alt-square"></i>
                                    <span>กิจกรรมที่ฉันแชร์ให้ผู้อื่น</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="active">
                    <a href="{{asset('assets/template_html/assets/tool/คู่มือการใช้งานระบบจัดการตารางงาน.pdf')}}" target="_blank">
                        <i class="material-icons">sticky_note_2</i>
                        <span>คู่มือใช้งานระบบ</span>
                    </a>
                    </li>
            <!-- end sidebar nav -->
            </ul>

            <span class="fixed-bottom bg-success" style="color: white;text-align: center">Powered by ARITC 2020 © NSRU, All Rights Reserved. Version 1 - Development by Mr. Jirakiat Cangsalak (Trainee)</span>
        </div>
        <!-- end sidebar scrollbar -->
    </div>
    <div class="sidebar-bg"></div>