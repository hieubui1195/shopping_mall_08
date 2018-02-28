@extends('user.layouts.layout')
@section('content')
<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!--  Product Details -->
            <div class="product product-details clearfix">
                <div class="col-md-6">
                    <div id="product-main-view">
                        <div class="product-view">
                            {{ Html::image('assets/img/main-product01.jpg', 'a picture') }}
                        </div>
                        <div class="product-view">
                            {{ Html::image('assets/img/main-product02.jpg', 'a picture') }}
                        </div>
                        <div class="product-view">
                            {{ Html::image('assets/img/main-product03.jpg', 'a picture') }}
                        </div>
                        <div class="product-view">
                            {{ Html::image('assets/img/main-product04.jpg', 'a picture') }}
                        </div>
                    </div>
                    <div id="product-view">
                        <div class="product-view">
                            {{ Html::image('assets/img/thumb-product01.jpg', 'a picture') }}
                        </div>
                        <div class="product-view">
                            {{ Html::image('assets/img/thumb-product02.jpg', 'a picture') }}
                        </div>
                        <div class="product-view">
                            {{ Html::image('assets/img/thumb-product03.jpg', 'a picture') }}
                        </div>
                        <div class="product-view">
                            {{ Html::image('assets/img/thumb-product04.jpg', 'a picture') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-body">
                        <div class="product-label">
                            <span class="sale">-20%</span>
                        </div>
                        <h2 class="product-name">Product Name Goes Here</h2>
                        <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                        <div>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                            </div>
                            {{ Html::link('#','3 Review(s) / Add Review')}}
                        </div>
                        <p><strong>{!!Lang::get('custom.common.availability')!!}</strong>{!!Lang::get('custom.common.instock')!!}</p>
                        <p>???</p>

                        <div class="product-btns">
                            <div class="qty-input">
                                <span class="text-uppercase">{{Lang::get('custom.common.qty')}}</span>
                                <input class="input" type="number">
                            </div>
                            <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> {{Lang::get('custom.common.addcart')}}</button>
                            <div class="pull-right">
                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                ~-~-~
                                <button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="product-tab">
                        <ul class="tab-nav">
                            <li class="active">
                                {{Html::link('#tab1',Lang::get('custom.common.description'),['data-toggle' => 'tab'])}}
                            </li>
                            <li>
                                {{Html::link('#tab2',Lang::get('custom.common.details'),['data-toggle' => 'tab'])}}
                            </li>
                            <li>
                                {{Html::link('#tab3',Lang::get('custom.common.review'),['data-toggle' => 'tab'])}}
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab1" class="tab-pane fade in active">
                                <p>Description</p>
                            </div>
                            <div id="tab2" class="tab-pane fade in active">
                                <p>Product Deltails</p>
                            </div>
                            <div id="tab3" class="tab-pane fade in">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="product-reviews">
                                            <div class="single-review">
                                                <div class="review-heading">
                                                    <div><i class="fa fa-user-o"></i> John</a></div>
                                                    <div><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
                                                    <div class="review-rating pull-right">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o empty"></i>
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>Review Content</p>
                                                </div>
                                            </div>

                                            <ul class="reviews-pages">
                                                <li class="active">1</li>
                                                <li>{{Html::link('#','2')}}</li>
                                                <li>{{Html::link('#','3')}}</li>
                                                <li>{!! html_entity_decode(Html::link('#','<i class="fa fa-caret-right"></i>'))!!}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="text-uppercase">{{Lang::get('custom.common.writereview')}}</h4>
                                        {{Form::open(['class' => 'review-form'])}}
                                            <div class="form-group">
                                                {!! Form::text(
                                                    'name', 
                                                    null, 
                                                    [
                                                        'id' => 'name', 
                                                        'class' => 'form-control', 
                                                        'required' => 'required', 
                                                        'autofocus' => 'autofocus', 
                                                        'placeholder' => Lang::get('custom.common.name')
                                                    ]
                                                ) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::email(
                                                    'email', 
                                                    null, 
                                                    [
                                                        'id' => 'email', 
                                                        'class' => 'form-control', 
                                                        'required' => 'required', 
                                                        'autofocus' => 'autofocus', 
                                                        'placeholder' => Lang::get('custom.admin_login.email_placeholder')
                                                    ]
                                                ) !!}                                                
                                            </div>
                                            <div class="form-group">
                                                {!! Form::text(
                                                    'review', 
                                                    null, 
                                                    [
                                                        'id' => 'review', 
                                                        'class' => 'form-control', 
                                                        'required' => 'required', 
                                                        'autofocus' => 'autofocus', 
                                                        'placeholder' => Lang::get('custom.common.writereview')
                                                    ]
                                                ) !!}
                                            </div>
                                            <div class="form-group">
                                                <div class="input-rating">
                                                    <strong class="text-uppercase">{{Lang::get('custom.common.yourrate')}}</strong>
                                                    <div class="stars">
                                                        {{ Form::radio('rating', 1, ['id' => 'star1']) }}<label for="star1"></label>
                                                        {{ Form::radio('rating', 2, ['id' => 'star2']) }}<label for="star2"></label>
                                                        {{ Form::radio('rating', 3, ['id' => 'star3']) }}<label for="star3"></label>
                                                        {{ Form::radio('rating', 4, ['id' => 'star4']) }}<label for="star4"></label>
                                                        {{ Form::radio('rating', 5, ['id' => 'star5']) }}<label for="star5"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="primary-btn">{{Lang::get('custom.common.submit')}}</button>
                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /Product Details -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->

@endsection