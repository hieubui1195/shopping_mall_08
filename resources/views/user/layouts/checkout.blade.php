@extends('user.layouts.layout')

@section('style')
    {!! Html::style('css/user/main.css') !!}
@endsection

@section('content')
<!-- section -->
<div class="section" id="checkout-content">
    @include('user.partials.checkout-content')
</div>
<!-- /section -->
@endsection

@section('script')
    {!! Html::script('js/user/cart.js') !!}
@endsection
