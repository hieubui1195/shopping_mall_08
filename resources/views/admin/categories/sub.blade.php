@extends('admin.layouts.app')

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @lang('custom.nav.categories')
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
                        'admin.category.index',
                        Lang::get('custom.nav.categories')
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
                        @lang('custom.common.sub_category')
                    </h3>
                </div>
                <div class="box-body">
                    {!! Form::open(
                        [
                            'route' => 'admin.category.store',
                            'class' => 'col-md-6 col-md-offset-3',
                        ]
                    ) !!}

                    {!! Form::hidden('formType', 'createSub') !!}

                    <div class="form-group row">
                        {!! Form::label(
                            'parentId',
                            Lang::get('custom.common.main_category'),
                            [
                                'class' => 'col-sm-3 col-form-label'
                            ]
                        ) !!}
                        
                        
                        <div class="col-sm-9">
                            {!! Form::select(
                                'parentId',
                                $mainCategories,
                                null,
                                [
                                    'class' => 'form-control select2',
                                    'style' => 'with: 100%',
                                ]
                            ) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label(
                            'name',
                            Lang::get('custom.common.sub_category'),
                            [
                                'class' => 'col-sm-3 col-form-label'
                            ]
                        ) !!}

                        <div class="col-sm-9">
                            {!! Form::text(
                                'name',
                                null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => Lang::get('custom.common.sub_category'),
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
                        <div class="col-sm-offset-3 col-sm-9">
                            {!! Form::submit(
                                Lang::get('custom.common.create'),
                                [
                                    'class' => 'btn btn-primary',
                                ]
                            ) !!}

                            {!! Html::linkRoute(
                                'admin.category.index',
                                Lang::get('custom.common.back'),
                                null,
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
