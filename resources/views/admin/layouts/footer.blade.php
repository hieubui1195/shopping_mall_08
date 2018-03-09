<footer class="main-footer">
    <div class="pull-right hidden-xs" style="float: right;">
        <b>@lang('custom.footer.version')</b>
    </div>
    <strong>
        @lang('custom.footer.copyright') 
        {!! Html::link('https://adminlte.io', Lang::get('custom.footer.author')) !!}
    </strong> 
    @lang('custom.footer.reserved')
</footer>
<!-- ./wrapper -->

<!-- jQuery -->
{!! Html::script('assets/jquery/dist/jquery.min.js') !!}
<!-- Propper -->
{!! Html::script('assets/popper.js/dist/umd/popper.min.js') !!}
<!-- Bootstrap -->
{!! Html::script('assets/bootstrap-3.3.7-dist/js/bootstrap.min.js') !!}
<!-- Fastclick -->
{!! Html::script('assets/fastclick/lib/fastclick.js') !!}
<!-- Select2 -->
{!! Html::script('assets/select2/dist/js/select2.min.js') !!}
<!-- Datatables -->
{!! Html::script('assets/datatables.net/js/jquery.dataTables.min.js') !!}
<!-- Bootstrap Daterangepicker -->
{!! Html::script('assets/moment/moment.js') !!}
{!! Html::script('assets/bootstrap-daterangepicker/daterangepicker.js') !!}
<!-- Sweet Alert -->
{!! Html::script('assets/sweetalert2/dist/sweetalert2.min.js') !!}
<!-- AdminLTE App -->
{!! Html::script('dist/js/adminlte.min.js') !!}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{!! Html::script('dist/js/pages/dashboard.js') !!}
<!-- AdminLTE for demo purposes -->
{!! Html::script('dist/js/demo.js') !!}
<!-- Main js -->
{!! Html::script('js/admin/main.js') !!}
