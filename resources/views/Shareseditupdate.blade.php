@extends('master')
@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">แก้ไข {{$task->events_name}}<small></small></h1>
        <a href="{{url('shareedit')}}" class="btn btn-default width-60">
            กลับ
        </a>
        <br>  <br>
        <div class="row">
            <!-- end page-header -->
            <!-- begin row -->
            <div class="col-xl-12">
                <div class="panel panel-inverse">
                    <!-- begin col-6 -->
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">

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
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered"
                                  action="{{url('/task/update/share')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">ชื่อกิจกรรม </label>
                                    <div class="col-lg-8">
                                        <div class="input-group date">
                                            <input type="text" class="form-control" name="names"
                                                   value="{{$task->events_name}}"
                                                   required/>
                                            <input type="text" class="form-control"
                                                   hidden="hidden" name="id"
                                                   value="{{$task->events_id}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">รายละเอียด </label>
                                    <div class="col-lg-8">
                                        <div class="input-group date">
                                                        <textarea class="form-control" name="description"
                                                                  rows="8">{{$task->event_description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">วันเวลา</label>
                                    <div class="col-lg-8">
                                        <div id="demo-calendar"></div>
                                        <label>
                                            <input id="start" type="hidden"   placeholder="" name="startdate"/>
                                        </label>
                                        <label>
                                            <input id="end"  type="hidden"   placeholder="" name="enddate" />
                                        </label>
                                        <input type="hidden" value="{{$task->start_event}}" name="startdate2">
                                        <input type="hidden" value="{{$task->end_event}}" name="enddate2">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label"></label>
                                    <div class="col-lg-8">
                                        <div class="row row-space-10">
                                            <div class="col-xs-6">
                                                <button type="submit" class="btn btn-primary" data-toggle="tooltip"
                                                        data-html="true" title="เพิ่มวันหยุด">บันทึก
                                                </button>
                                            </div>
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


@endsection
@section('script')
    <script>

        mobiscroll.setOptions({
            locale: mobiscroll.localeEn,
            theme: 'ios',
            themeVariant: 'light'
        });
        $(function () {
            $('#demo-calendar').mobiscroll().datepicker({
                controls: ['calendar', 'time'],
                select: 'range',
                startInput: '#start',
                endInput: '#end',
                touchUi: true,
                display: 'inline',
                defaultSelection: '{{$startdate}}',
            });
        });

    </script>

@endsection