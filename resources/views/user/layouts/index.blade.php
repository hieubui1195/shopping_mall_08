@extends('user.layouts.layout')

@section('content')
<!-- HOME -->
<div id="home">
    <!-- container -->
    <div class="container">
        <!-- home wrap -->
        <!-- <div class="home-wrap"> -->
            <!-- home slick -->
            <div id="home-slick">
                <!-- banner -->
                <div class="banner banner-1">
                    {{ Html::image('assets/img/banner02.jpg', 'a picture') }}
                    <div class="banner-caption text-center">
                        <h1>{!!Lang::get('custom.header.welcome')!!}</h1>
                        <h3 class="white-color font-weak">{!!Lang::get('custom.common.discount')!!}</h3>
                        <button class="primary-btn">{!!Lang::get('custom.common.shopnow')!!}</button>
                    </div>
                </div>
                <div class="banner banner-1">
                    {{ Html::image('assets/img/banner04.jpg', 'a picture') }}
                    <div class="banner-caption text-center">
                        <h1>{{Lang::get('custom.header.welcome')}}</h1>
                        <h3 class="white-color font-weak">{{Lang::get('custom.common.discount')}}</h3>
                        <button class="primary-btn">{{Lang::get('custom.common.shopnow')}}</button>
                    </div>
                </div>
                <div class="banner banner-1">
                    {{ Html::image('assets/img/banner06.jpg', 'a picture') }}
                    <div class="banner-caption text-center">
                        <h1>{!!Lang::get('custom.header.welcome')!!}</h1>
                        <h3 class="white-color font-weak">{!!Lang::get('custom.common.discount')!!}</h3>
                        <button class="primary-btn">{!!Lang::get('custom.common.shopnow')!!}</button>
                    </div>
                </div>
                <!-- /banner -->
            <!-- /home slick -->
        <!-- </div> -->
        <!-- /home wrap -->
    </div>
    <!-- /container -->
</div>
<!-- /HOME -->

<!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 class="title">{!! Lang::get('custom.common.latestproduct') !!}</h2>
                    </div>
                </div>
                <!-- section title -->

                <!-- Product Single -->
                @foreach ($products as $product)
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="product product-single">
                            <div class="product-thumb">
                                <button class="main-btn quick-view"><i class="fa fa-search-plus"></i>{!! Lang::get('custom.common.view') !!}
                                </button>
                                {{ Html::image($product->images[0]['image']) }}
                            </div>
                            <div class="product-body">
                                <h3 class="product-price">{{ $product->price }} @lang('custom.common.currency')</h3>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o empty"></i>
                                </div>
                                <h2 class="product-name">{{ Html::link('#', 'Sản Phẩm 1')}}
                                    @foreach ($product->reviews as $review)
                                        {{ $review->rate }}
                                    @endforeach
                                    {{-- {{ $product->reviews }} --}}
                                </h2>
                                <div class="product-btns">
                                    <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                    ~-~-~-~
                                    <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i>{{ Lang::get('custom.common.addcart') }} </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Product Single -->
                @endforeach
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->
@endsection
