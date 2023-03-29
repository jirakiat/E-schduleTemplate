
<script src="{{ asset('assets/template_html/assets/js/app.min.js')}}"></script>
{{--<script src="{{ asset('assets/template_html/assets/js/theme/google.min.js')}}"></script>--}}
<script src="{{ asset('assets/template_html/assets/js/theme/material.min.js')}}"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('assets/template_html/assets/plugins/flot/jquery.flot.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/flot/jquery.flot.time.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/flot/jquery.flot.resize.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/flot/jquery.flot.pie.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>


<!!-- Calendar --!!>
<script src="{{ asset('assets/template_html/assets/plugins/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/fullcalendar/dist/locale/th.js')}}"></script>


<!!-- Form --!!>
<script src="{{ asset('assets/template_html/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/@danielfarrell/bootstrap-combobox/js/bootstrap-combobox.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/tag-it/js/tag-it.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/select2/dist/js/select2.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/bootstrap-show-password/dist/bootstrap-show-password.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/clipboard/dist/clipboard.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/js/demo/form-plugins.demo.js')}}"></script>


<!!-- Data Table --!!>
<script src="{{ asset('assets/template_html/assets/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/js/demo/table-manage-responsive.demo.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/datatables.net-colreorder/js/dataTables.colreorder.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/datatables.net-colreorder-bs4/js/colreorder.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/js/demo/table-manage-colreorder.demo.js')}}"></script>


<script src="{{ asset('assets/template_html/assets/plugins/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/js/demo/ui-modal-notification.demo.js')}}"></script>



<!!-- Follow --!>
<script src="{{ asset('assets/template_html/assets/plugins/switchery/switchery.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/plugins/abpetkov-powerange/dist/powerange.min.js')}}"></script>
<script src="{{ asset('assets/template_html/assets/js/demo/form-slider-switcher.demo.js')}}"></script>
<script src="{{ asset('assets/range-date-time-rangedemo/js/mobiscroll.jquery.min.js')}}"></script>
@yield('script')
<script>

    var url = window.location.href;
    $('a[href="'+url+'"]').parent().addClass('active');
    $('.has-sub[href="'+url+'"]').parent().addClass('active');
    $('.selectpicker').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        var user_id = $(this).find("option").eq(clickedIndex).val();
        $('input[name="user_id"]').val(user_id);
    });

</script>