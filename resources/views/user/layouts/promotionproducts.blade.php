@extends('user.layouts.product-list')

@section('product-list')
    @section('paginate', $promotion_products_all->links())

    @include('user.partials.product-list-2', [
    	'products' => $promotion_products_all,
	])    
@endsection
