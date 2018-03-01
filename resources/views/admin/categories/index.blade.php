@extends('admin.layouts.app')

@section('style')
    {!! Html::style('assets/datatables.net-dt/css/jquery.dataTables.min.css') !!}
@endsection
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
                    @lang('custom.common.list')
                </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            {!! Form::hidden('confirm', Lang::get('custom.form.confirm_delete')) !!}
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <div class="pull-left">
                        <h3 class="pull-left">
                            @lang('custom.common.categories')
                        </h3>

                        <br />
    
                        {!! Form::select(
                            'filter-category',
                            [
                                '' => Lang::get('custom.common.categories'),
                                Lang::get('custom.common.active') => Lang::get('custom.common.active'),
                                Lang::get('custom.common.deleted') => Lang::get('custom.common.deleted'),
                            ],
                            null,
                            [
                                'class' => 'form-control',
                                'id' => 'filter-category',
                            ]
                        ) !!}
                    </div>
                    <div class="dropdown pull-right">
                        {!! html_entity_decode(
                            Form::button(
                                '<i class="fa fa-plus"></i> ' . Lang::get('custom.common.create'),
                                [
                                    'class' => 'btn btn-success dropdown-toggle',
                                    'data-toggle' => 'dropdown',
                                    'aria-haspopup' => 'true',
                                    'aria-expanded' => 'false',
                                ]
                            )
                        ) !!}
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            {!! Html::linkRoute(
                                'admin.category.create',
                                Lang::get('custom.common.main_category'),
                                [
                                    'type' => config('custom.form_type.create_main'),
                                ],
                                [
                                    'class' => 'dropdown-item',
                                ]
                            ) !!}

                            {!! Html::linkRoute(
                                'admin.category.create',
                                Lang::get('custom.common.sub_category'),
                                [
                                    'type' => config('custom.form_type.create_sub'),
                                ],
                                [
                                    'class' => 'dropdown-item',
                                ]
                            ) !!}
                        </div>
                    </div>
                    @include('admin.partials.success')
                </div>
                <div class="box-body">
                    <table id="categories-table" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('custom.common.name')</th>
                                <th>@lang('custom.common.parent')</th>
                                <th>@lang('custom.common.status')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td>
                                        {{ $category->name }}
                                    </td>
                                    <td>
                                        @if ($categories[$loop->index]['getParent'] != null)
                                            {{ $categories[$loop->index]['getParent']['name'] }}
                                        @else
                                            {{ $category->parent_id }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($category->deleted_at != null)
                                            @lang('custom.common.deleted')
                                        @else
                                            @lang('custom.common.active')
                                        @endif
                                    </td>
                                    <td>
                                        {!! html_entity_decode(
                                            Html::linkRoute(
                                                'admin.category.edit',
                                                '<i class="fa fa-edit"></i>',
                                                [
                                                    'id' => $category->id
                                                ],
                                                [
                                                    'class' => 'btn btn-info'
                                                ]
                                            )
                                        ) !!}

                                        {!! Form::open([
                                            'route' => ['admin.category.destroy', $category->id],
                                            'method' => 'DELETE',
                                            'id' => 'delete-form-' . $category->id,
                                            'style' => 'display: none;',
                                        ]) !!}

                                        {!! Form::close() !!}

                                        {!! html_entity_decode(
                                            Html::link(
                                                null,
                                                '<i class="fa fa-trash"></i>',
                                                [
                                                    'class' => 'btn btn-danger delete-category',
                                                    'data-id' => $category->id,
                                                ]
                                            )
                                        ) !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>@lang('custom.common.name')</th>
                                <th>@lang('custom.common.parent')</th>
                                <th>@lang('custom.common.status')</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="msg"></div>
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
    {!! Html::script('assets/datatables.net/js/jquery.dataTables.min.js') !!}
 @endsection
