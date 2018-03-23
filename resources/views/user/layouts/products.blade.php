@extends('user.layouts.product-list')

@section('product-list')
    @section('sortby')
        {!! Form::select(
            'sort',
            [
                '' => Lang::get('custom.common.sel_sort'),
                config('custom.defaultOne') => Lang::get('custom.common.price_asc'),
                config('custom.defaultTwo') => Lang::get('custom.common.price_desc'),
            ],
            null,
            [
                'class' => 'input sort-price',
                'style' => 'width: 200px',
            ]
        ) !!}
    @endsection
    
    @section('paginate', $product_in_cates->links())

    @include('user.partials.product-list-1', [
        'products' => $product_in_cates,
    ])    
@endsection                       
