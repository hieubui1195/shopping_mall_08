<!DOCTYPE html>
<html>
    <head>
        <title>@lang('custom.header.welcome')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap -->
        {!! Html::style('assets/bootstrap-3.3.7-dist/css/bootstrap.min.css') !!}
        {!! Html::style('css/user/login.css') !!}
    </head>
    <body>
    <section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-md-4 login-sec">
                    @section('content')
                        @show
                </div>
                <div class="col-md-8 banner-sec"></div>
            </div>
        </div>
    </section>
        <!-- jQuery -->
        {!! Html::script('assets/jquery/dist/jquery.min.js') !!}
        <!-- Bootstrap -->
        {!! Html::script('assets/bootstrap-3.3.7-dist/js/bootstrap.min.js') !!}
    </body>
</html>
