@extends('admin.layouts.app')

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
                    @lang('custom.common.edit')
                </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            {!! Form::hidden('confirm', Lang::get('custom.form.confirm_delete')) !!}
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                        
                    <h3 style="text-align: center;">
                        @lang('custom.common.edit_product')
                    </h3>

                    <div class="alert alert-success alert-dismissible col-sm-3" style="display: none;">
                        {!! Form::button(
                            '&times;',
                            [
                                'class' => 'close',
                                'data-dismiss' => 'alert',
                            ]
                        ) !!}
                        <strong></strong>
                    </div>
                </div>
                <div class="box-body" id="box-edit-product">

                    @if ($product[0]['deleted_at'] != null)
                        {!! Form::open(
                            [
                                'route' => [
                                    'admin.product.reuse', 
                                    $product[0]['id']
                                ],
                                'method' => 'POST',
                                'class' => 'col-md-6 col-md-offset-3',
                                'id' => 'form-edit-product',
                            ]
                        ) !!}

                        {!! Form::hidden('formType', 'reuse') !!}
                        <div class="callout callout-danger">
                            @lang('custom.common.reuse_warning')
                        </div>
                    @else 
                        {!! Form::open(
                            [
                                'route' => [
                                    'admin.product.update', 
                                    $product[0]['id']
                                ],
                                'method' => 'PUT',
                                'class' => 'col-md-6 col-md-offset-3',
                                'enctype' => 'multipart/form-data',
                                'id' => 'form-edit-product',
                            ]
                        ) !!}

                        {!! Form::hidden('formType', 'edit') !!}
                    @endif

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
                                old('category') ? old('category') : $product[0]['category_id'],
                                [
                                    'class' => 'form-control select2',
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
                                old('name') ? old('name') : $product[0]['name'],
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
                                old('description') ? old('description') : $product[0]['description'],
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
                                old('price') ? old('price') : $product[0]['price'],
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
                                    old('amount') ? old('amount') : $product[0]['amount'],
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
                            <div id="image-preview">
                                @foreach ($product[0]['images'] as $image)
                                    {!! Html::image(
                                        $image['image'],
                                        'Product Image',
                                        [
                                            'class' => 'img img-thumbnail col-xs-4',
                                        ]
                                    ) !!}
                                @endforeach                                
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-offset-3 col-sm-9">
                            @if ($product[0]['deleted_at'] != null)
                                {!! Form::submit(
                                    Lang::get('custom.common.reuse'),
                                    [
                                        'id' => 'btn-reuse',
                                        'class' => 'btn btn-danger',
                                    ]
                                ) !!}
                            @else
                                {!! Form::submit(
                                    Lang::get('custom.common.edit'),
                                    [
                                        'class' => 'btn btn-primary',
                                    ]
                                ) !!}
                            @endif

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
    {!! Html::script('js/admin/product.js') !!}
@endsection
