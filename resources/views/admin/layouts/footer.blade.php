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
<!-- Bootstrap -->
{!! Html::script('assets/bootstrap/dist/js/bootstrap.min.js') !!}
<!-- Fastclick -->
{!! Html::script('assets/fastclick/lib/fastclick.js') !!}
<!-- AdminLTE App -->
{!! Html::script('dist/js/adminlte.min.js') !!}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{!! Html::script('dist/js/pages/dashboard.js') !!}
<!-- AdminLTE for demo purposes -->
{!! Html::script('dist/js/demo.js') !!}
<!-- Main js -->
{!! Html::script('js/main.js') !!}
