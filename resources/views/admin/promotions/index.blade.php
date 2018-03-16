@extends('admin.layouts.app')

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @lang('custom.nav.promotions')
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
                        'admin.promotion.index',
                        Lang::get('custom.nav.promotions')
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
                            @lang('custom.common.promotions')
                        </h3>

                        <br />
    
                        {!! Form::select(
                            'filter-promotion',
                            [
                                '' => Lang::get('custom.common.promotions'),
                                Lang::get('custom.common.active') => Lang::get('custom.common.active'),
                                Lang::get('custom.common.finished') => Lang::get('custom.common.finished'),
                                Lang::get('custom.common.deleted') => Lang::get('custom.common.deleted'),
                            ],
                            null,
                            [
                                'class' => 'form-control',
                                'id' => 'filter-promotion',
                            ]
                        ) !!}
                    </div>

                    <div class="pull-right">
                        {!! html_entity_decode(
                            Html::linkRoute(
                                'admin.promotion.create',
                                '<i class="fa fa-plus"></i> ' . Lang::get('custom.common.create'),
                                [],
                                [
                                    'class' => 'btn btn-success',
                                ]
                            )
                        ) !!}
                    </div>
                    
                    @include('admin.partials.success')
                    
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
                <div class="box-body">
                    <table id="promotions-table" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('custom.common.name')</th>
                                <th>@lang('custom.common.start_date')</th>
                                <th>@lang('custom.common.end_date')</th>
                                <th>@lang('custom.common.status')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($promotions as $promotion)
                                <tr>
                                    <td>
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td>

                                        {{ $promotion->name }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($promotion->start_date)->format('d F\, Y') }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($promotion->end_date)->format('d F\, Y') }}
                                    </td>
                                    <td>
                                        @if ($promotion->deleted_at != null)
                                            <p class="label bg-red">
                                                @lang('custom.common.deleted')
                                            </p>
                                        @else
                                            @if (\Carbon\Carbon::parse($promotion->end_date)->isPast())
                                                <p class="label bg-yellow">
                                                    @lang('custom.common.finished')
                                                </p>
                                            @elseif (\Carbon\Carbon::parse($promotion->start_date)->isFuture())
                                                <p class="label bg-blue">
                                                    @lang('custom.common.comming')
                                                </p>
                                            @else
                                                <p class="label bg-green">
                                                    @lang('custom.common.active')
                                                </p>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        {!! html_entity_decode(
                                            Html::linkRoute(
                                                'admin.promotion.show',
                                                '<i class="fa fa-info"></i>',
                                                [
                                                    'id' => $promotion->id
                                                ],
                                                [
                                                    'class' => 'btn btn-success ' . ($promotion->deleted_at != null ? 'disabled' : ''),
                                                    'data-id' => $promotion->id,
                                                    'title' => Lang::get('custom.common.view_detail'),
                                                ]
                                            )
                                        ) !!}

                                        {!! html_entity_decode(
                                            Html::linkRoute(
                                                'admin.promotion.edit',
                                                '<i class="fa fa-edit"></i>',
                                                [
                                                    'id' => $promotion->id
                                                ],
                                                [
                                                    'class' => 'btn btn-info ' . ($promotion->deleted_at != null ? 'disabled' : ''),
                                                ]
                                            )
                                        ) !!}

                                        {!! Form::open([
                                            'route' => ['admin.promotion.destroy', $promotion->id],
                                            'method' => 'DELETE',
                                            'id' => 'delete-form-' . $promotion->id,
                                            'style' => 'display: none;',
                                        ]) !!}

                                        {!! Form::close() !!}

                                        {!! html_entity_decode(
                                            Html::link(
                                                null,
                                                '<i class="fa fa-trash"></i>',
                                                [
                                                    'class' => 'btn btn-danger delete-promotion ' . (($promotion->deleted_at != null) || (\Carbon\Carbon::parse($promotion->end_date)->isPast()) ? 'disabled' : ''),
                                                    'data-id' => $promotion->id,
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
                                <th>@lang('custom.common.start_date')</th>
                                <th>@lang('custom.common.end_date')</th>
                                <th>@lang('custom.common.status')</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
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
    {!! Html::script('js/admin/promotion.js') !!}
@endsection
