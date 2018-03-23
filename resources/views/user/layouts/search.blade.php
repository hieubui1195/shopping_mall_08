@extends('user.layouts.product-list')

@section('product-list')
    @section('paginate', $products->links())

    @include('user.partials.product-list-1', [
    	'products' => $products,
	])
@endsection
