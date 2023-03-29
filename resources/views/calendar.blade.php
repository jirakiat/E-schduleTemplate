@extends('master')
@section('content')
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">My Calendar <small></small></h1>
        <!-- end page-header -->
        <!-- begin vertical-box -->
        <div class="vertical-box">
            <!-- begin event-list -->
            <div class="vertical-box-column p-r-30 d-none d-lg-table-cell" style="width: 215px">
                <div id="external-events" class="fc-event-list">
                </div>
                <div class="panel panel-inverse" data-sortable-id="form-plugins-13">
                    <!-- begin panel-heading -->
                    <div class="panel-heading" style="text-align: center;">
                        <h4 class="panel-title">ตั้งค่าปฏิทิน</h4>
                        <div class="panel-heading-btn">
                        </div>
                    </div>
                    <!-- end panel-heading -->
                    <!-- begin panel-body -->
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">
                                    <input type="checkbox" id="vehicle1" name="id">
                                </label>
                                <div class="col-lg-8">
                                    <label>วันหยุด</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">
                                    <input type="checkbox" id="vehicle1" name="id">
                                </label>
                                <div class="col-lg-8">
                                    <label>หน่วยงาน</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="calendar" class="vertical-box-column calendar"></div>


        <div class="modal fade showmodal" id="modal-dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-hover">
                            <tbody>
                            <tr>
                                <td style="width: 100px"><b>รายละเอียด</b></td>
                                <td><p class="description"></p></td>
                            </tr>
                            <tr>
                                <td style="width: 100px"><b>วันเริ่มต้น</b></td>
                                <td><p class="startdate"></p></td>
                            </tr>
                            <tr>
                                <td style="width: 100px"><b>วันสิ้นสุด</b></td>
                                <td><p class="enddate"></p></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-danger" data-dismiss="modal">ปิด</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            var calendar = $('#calendar').fullCalendar({
                eventClick: function (info) {
                    alert('Event: ' + info.event.title);
                    alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    alert('View: ' + info.view.type);

                    // change the border color just for fun
                    info.el.style.borderColor = 'red';
                },
                eventLimit: true,
                draggable: false,
                defaultView: 'month',
                locale: 'th',
                firstDay: 0,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek,listMonth,listYear',
                },
                events: 'master/get-data',
                eventClick: function (event, jsEvent, view) {
                    $('.showmodal').modal('show');
                    $('.modal-title').html(event.title);
                    $('.description').html("" + event.description);
                    $('.startdate').html("" + event.dateStartTxt);
                    $('.enddate').html(" " + event.dateEndTxt);
                }
            });
        });
        $('.closemodal').click(function () {
            $('.showmodal').removeClass('show');
        });

        function myFunction(x) {
            if (x.matches) {
                $('#calendar').fullCalendar('changeView', 'listMonth', {});
            } else {
                $('#calendar').fullCalendar('changeView', 'month', {});
            }
        }

        var x = window.matchMedia("(max-width: 1080px)")
        myFunction(x)
        x.addListener(myFunction)
    </script>




@endsection


