@extends('user.layouts.product-list')

@section('product-list')
    @section('paginate', $latest_products_all->links())
    @include('user.partials.product-list-1', [
    	'products' => $latest_products_all,
	])

@endsection
