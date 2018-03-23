@extends('user.layouts.product-list')

@section('product-list')
    @section('paginate', $product_in_cates->links())

    @include('user.partials.product-list-1', [
    	'products' => $product_in_cates,
	])    
@endsection                       
