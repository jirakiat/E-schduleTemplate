<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/css/material/app.min.css')}}" rel="stylesheet" />
{{--<link href="{{ asset('assets/template_html/assets/css/google/app.min.css')}}" rel="stylesheet"/>--}}
<link href="{{ asset('assets/template_html/assets/plugins/jvectormap-next/jquery-jvectormap.css')}}" rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/gritter/css/jquery.gritter.css')}}" rel="stylesheet"/>


<!!--  Calendar --!!>
<link href="{{ asset('assets/template_html/assets/plugins/fullcalendar/dist/fullcalendar.print.css')}}" rel="stylesheet"
      media='print'/>
<link href="{{ asset('assets/template_html/assets/plugins/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet"/>


<!!-- Form --!!>
<link href="{{ asset('assets/template_html/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/tag-it/css/jquery.tagit.css')}}" rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/template_html/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css')}}"
      rel="stylesheet"/>

<!!- Font -!!>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;500&display=swap" rel="stylesheet">
{{--<link href="https://fonts.googleapis.com/css2?family=Chakra+Petch&family=Kanit:wght@100;200;300&display=swap')}}" rel="stylesheet">--}}

<!!-- Data table --!!>
<link href="{{ asset('assets/template_html/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/datatables.net-colreorder-bs4/css/colreorder.bootstrap4.min.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/datatables.net-colreorder-bs4/css/colreorder.bootstrap4.min.css')}}"
      rel="stylesheet"/>
<!!-- Icon --!!>
<link href="{{ asset('assets/template_html/assets/plugins/simple-line-icons/css/simple-line-icons.css')}}"
      rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet"/>

<!!-- Follow --!>
<link href="{{ asset('assets/template_html/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet"/>
<link href="{{ asset('assets/template_html/assets/plugins/abpetkov-powerange/dist/powerange.min.css')}}"
      rel="stylesheet"/>

<link href="{{ asset('assets/range-date-time-rangedemo/css/mobiscroll.jquery.min.css')}}" rel="stylesheet" />
<style>
    body {
        margin: 0;
        /*font-family: 'Chakra Petch', sans-serif;*/
        font-family: 'Sarabun', sans-serif;
    }

    th {
        text-align: center;
        font-weight: bold;
        font-size: 16px;
    }

    td {
        font-size: 16px;
    }

    .imgfull {
        width: 100%;
        height: 100%;
    }

    .fc .fc-view-container .fc-body .fc-bg td.fc-today {
        background: #fffadb;
    }
    .fc-event{
        cursor: pointer;
    }
    .fc-list-item {
        cursor: pointer;
    }
    .scollshow{
        height: auto;
        overflow: scroll;
    }
    .inner-border::-webkit-scrollbar {
        display: none;
    }
    .badge-notify{
        background:#4CD964;
        position:relative;
        top: -12px;
        left: -16px;
    }
    .waitingForConnection {
        animation: blinker 2.0s cubic-bezier(.5, 0, 1, 1) infinite alternate;
    }
    @keyframes blinker {
        0%, 49% {
            background-color: #ffd500;
        }
        49%, 50% {
            background-color: yellow;
        }
        50%, 99% {
            background-color: #f3ca00;
        }
        99%, 100% {
            background-color: #faf98d;
        }
    }
    .logo {
        animation: bounceIn 0.6s;
        transform: rotate(0deg) scale(1) translateZ(0);
        transition: all 0.4s cubic-bezier(.8,1.8,.75,.75);
        cursor: pointer;
    }
    @keyframes bounceIn {
        0% {
            opacity: 1;
            transform: scale(.3);
        }

        50% {
            opacity: 1;
            transform: scale(1.05);
        }

        70% {
            opacity: 1;
            transform: scale(.9);
        }

        100% {
            opacity: 1;
            transform: scale(1);
        }

    }
    body {
        margin: 0;
        padding: 0;
    }



</style>