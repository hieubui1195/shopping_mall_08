@extends('user.layouts.layout')
@section('content')
<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            {{Form::open(['class' => 'clearfix', 'id' => 'checkout-form'])}}
                <div class="col-md-6">
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">{{Lang::get('custom.header.welcome')}}</h3>
                        </div>
                        <div class="form-group">
                            {!! Form::input(
                                'text', 
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
                            {!! Form::input(
                                'text', 
                                'address',
                                null, 
                                [
                                    'id' => 'address', 
                                    'class' => 'form-control', 
                                    'required' => 'required', 
                                    'autofocus' => 'autofocus', 
                                    'placeholder' => Lang::get('custom.common.address')
                                ]
                            ) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="order-summary clearfix">
                        <div class="section-title">
                            <h3 class="title">{{Lang::get('custom.common.orderreview')}}</h3>
                        </div>
                        <table class="shopping-cart-table table">
                            <thead>
                                <tr>
                                    <th>{{Lang::get('custom.common.product')}}</th>
                                    <th></th>
                                    <th class="text-center">{{Lang::get('custom.common.price')}}</th>
                                    <th class="text-center">{{Lang::get('custom.common.qty')}}</th>
                                    <th class="text-center">{{Lang::get('custom.common.total')}}</th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="thumb">{{ Html::image('assets/img/thumb-product01.jpg', 'a picture') }}</td>
                                    <td class="details">
                                        {{Html::link('#','Product Name Goes Here')}}
                                    </td>
                                    <td class="price text-center"><strong>$32.50</strong><br><del class="font-weak"><small>$40.00</small></del></td>
                                    <td class="qty text-center"><input class="input" type="number" value="1"></td>
                                    <td class="total text-center"><strong class="primary-color">$32.50</strong></td>
                                    <td class="text-right"><button class="main-btn icon-btn"><i class="fa fa-close"></i></button></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="empty" colspan="3"></th>
                                    <th>{{Lang::get('custom.common.total')}}</th>
                                    <th colspan="2" class="total">$97.50</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="pull-right">
                            <button class="primary-btn">{{Lang::get('custom.common.placeorder')}}</button>
                        </div>
                    </div>
                </div>
            {{Form::close()}}
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->
@endsection