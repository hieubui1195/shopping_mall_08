<!DOCTYPE html>
<html lang="en">
    <head>
        @include('admin.layouts.head')

        @section('style')
            @show
    </head>
    <body class="skin-red sidebar-mini">
        <div class="wrapper">
            @include('admin.layouts.header')

            @include('admin.layouts.sidebar')

            @section('main-content')
                @show

            @include('admin.layouts.footer')

            @section('script')
                @show
        </div>
    </body>
</html> 
