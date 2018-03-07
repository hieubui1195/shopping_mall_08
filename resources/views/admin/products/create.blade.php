@extends('admin.layouts.app')

@section('style')
    {!! Html::style('assets/datatables.net-dt/css/jquery.dataTables.min.css') !!}
    {!! Html::style('assets/select2/dist/css/select2.min.css') !!}
@endsection

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @lang('custom.nav.products')
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
                        Lang::get('custom.nav.products')
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
                        @lang('custom.common.add_product')
                    </h3>
                </div>
                <div class="box-body">
                    {!! Form::open(
                        [
                            'route' => 'admin.product.store',
                            'class' => 'col-md-6 col-md-offset-3',
                            'enctype' => 'multipart/form-data',
                            'id' => 'add-product',
                        ]
                    ) !!}

                    {!! Form::hidden('formType', 'create') !!}

                    <div class="form-group row">
                        {!! Form::label(
                            'category',
                            Lang::get('custom.common.category'),
                            [
                                'class' => 'col-sm-3 col-form-label'
                            ]
                        ) !!}
                        
                        
                        <div class="col-sm-9">
                            {!! Form::select(
                                'category',
                                $categories,
                                old('category'),
                                [
                                    'class' => 'form-control',
                                ]
                            ) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label(
                            'name',
                            Lang::get('custom.common.product'),
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
                                    'placeholder' => Lang::get('custom.common.product'),
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
                            'description',
                            Lang::get('custom.common.description'),
                            [
                                'class' => 'col-sm-3 col-form-label'
                            ]
                        ) !!}

                        <div class="col-sm-9">
                            {!! Form::textarea(
                                'description',
                                old('description'),
                                [
                                    'class' => 'form-control',
                                    'placeholder' => Lang::get('custom.common.description'),
                                    'required' => 'required',
                                    'rows' => 5,
                                ]
                            ) !!}

                            @if($errors->first('description'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </p>
                            @endif

                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label(
                            'price',
                            Lang::get('custom.common.price'),
                            [
                                'class' => 'col-sm-3 col-form-label'
                            ]
                        ) !!}

                        <div class="col-sm-9">
                            {!! Form::input(
                                'number',
                                'price',
                                old('price') ? old('price') : 0,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => Lang::get('custom.common.price'),
                                    'required' => 'required',
                                ]
                            ) !!}

                            @if($errors->first('price'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </p>
                            @endif

                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label(
                            'amount',
                            Lang::get('custom.common.qty'),
                            [
                                'class' => 'col-sm-3 col-form-label'
                            ]
                        ) !!}

                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon" data-quantity="minus" data-field="amount"><i class="fa fa-minus"></i></span>
                                {!! Form::input(
                                    'number',
                                    'amount',
                                    old('amount') ? old('amount') : 0,
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => Lang::get('custom.common.qty'),
                                        'required' => 'required',
                                    ]
                                ) !!}
                                <span class="input-group-addon" data-quantity="plus" data-field="amount"><i class="fa fa-plus"></i></span>
                            </div>
                            
                            @if($errors->first('amount'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </p>
                            @endif

                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label(
                            'image',
                            Lang::get('custom.common.image'),
                            [
                                'class' => 'col-sm-3 col-form-label'
                            ]
                        ) !!}

                        <div class="col-sm-9">
                            {!! Form::file(
                                'images[]',
                                [
                                    'id' => 'image',
                                    'required' => 'required',
                                    'accept' => 'image/*',
                                    'multiple' => 'multiple',
                                ]
                            ) !!}

                            @if($errors->first('images.*'))
                                <p class="text-danger">
                                    <strong>{{ $errors->first('images.*') }}</strong>
                                </p>
                            @endif

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-offset-3 col-sm-9">
                            <div id="image-preview"></div>
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
                                'admin.product.index',
                                Lang::get('custom.common.back'),
                                [],
                                [
                                    'class' => 'btn btn-warning',
                                ]
                            ) !!}
                        </div>
                    </div>

                    {!! Form::hidden('imageSelected') !!}

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
    {!! Html::script('assets/select2/dist/js/select2.min.js') !!}
    {!! Html::script('assets/datatables.net/js/jquery.dataTables.min.js') !!}
    {!! Html::script('js/admin/product.js') !!}
@endsection
