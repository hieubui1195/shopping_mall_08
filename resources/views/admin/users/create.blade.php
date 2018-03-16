@extends('admin.layouts.app')

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @lang('custom.nav.accounts')
            </h1>
            <ol class="breadcrumb">
                <li>
                    {!! html_entity_decode(
                        Html::linkRoute(
                            'admin.home',
                            '<i class="fa fa-dashboard"></i> ' . Lang::get('custom.common.dashboard')
                        )
                    ) !!}
                </li>
                <li>
                    {!! Html::linkRoute(
                        'admin.product.index',
                        Lang::get('custom.nav.accounts')
                    ) !!}
                </li>
                <li class="active">
                    @lang('custom.common.create')
                </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    @include('admin.partials.success')
                        
                    <h3 style="text-align: center;">
                        @lang('custom.common.add_user')
                    </h3>
                </div>
                <div class="box-body">
                    {!! Form::open(
                        [
                            'route' => 'admin.user.store',
                            'class' => 'col-md-6 col-md-offset-3',
                        ]
                    ) !!}

                    {!! Form::hidden('formType', 'create') !!}

                    <div class="form-group row">
                        {!! Form::label(
                            'email',
                            Lang::get('custom.common.email'),
                            [
                                'class' => 'col-sm-3 col-form-label'
                            ]
                        ) !!}

                        <div class="col-sm-9">
                            {!! Form::text(
                                'email',
                                old('email'),
                                [
                                    'class' => 'form-control',
                                    'placeholder' => Lang::get('custom.common.email'),
                                    'required' => 'required',
                                ]
                            ) !!}

                            @if($errors->first('email'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </p>
                            @endif

                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label(
                            'name',
                            Lang::get('custom.common.name'),
                            [
                                'class' => 'col-sm-3 col-form-label'
                            ]
                        ) !!}

                        <div class="col-sm-9">
                            {!! Form::text(
                                'name',
                                old('name'),
                                [
                                    'class' => 'form-control',
                                    'placeholder' => Lang::get('custom.common.name'),
                                    'required' => 'required',
                                ]
                            ) !!}

                            @if($errors->first('name'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </p>
                            @endif

                        </div>
                    </div>
                    
                    <div class="form-group row">
                        {!! Form::label(
                            'role',
                            Lang::get('custom.common.role'),
                            [
                                'class' => 'col-sm-3 col-form-label'
                            ]
                        ) !!}

                        <div class="col-sm-9">
                            {!! Form::text(
                                'role',
                                'Admin',
                                [
                                    'class' => 'form-control',
                                    'disabled' => 'disabled',
                                ]
                            ) !!}

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-offset-3 col-sm-9">
                            {!! Form::submit(
                                Lang::get('custom.common.create'),
                                [
                                    'id' => 'btn-add-product',
                                    'class' => 'btn btn-primary',
                                ]
                            ) !!}

                            {!! Html::linkRoute(
                                'admin.user.index',
                                Lang::get('custom.common.back'),
                                [],
                                [
                                    'class' => 'btn btn-warning',
                                ]
                            ) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    {!! Html::script('js/admin/user.js') !!}
@endsection
