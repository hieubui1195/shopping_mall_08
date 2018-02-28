<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{!!Lang::get('custom.header.welcome')!!}</title>

    @include('user.layouts.style')
    @section('style')
        @show

</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- top Header -->
        <div id="top-header">
            <div class="container">
                <div class="pull-left">
                    <span>{!!Lang::get('custom.header.welcome')!!}</span>
                </div>
                <div class="pull-right">
                    <ul class="header-top-links">
                        <li class="dropdown default-dropdown">
                            {!! html_entity_decode(
                                Html::link(
                                    null, 
                                    Lang::get('custom.common.language') . '<i class="fa fa-caret-down"></i>',
                                    [
                                        'class' => 'dropdown-toggle',
                                        'data-toggle' => 'dropdown',
                                        'aria-expanded' => 'true',
                                    ]
                                )
                            ) !!}
                            <ul class="custom-menu">
                                <li>
                                    {!! html_entity_decode(
                                        Html::linkRoute(
                                            'change-language',
                                            Html::image('images/en.png') . Lang::get('custom.common.en'),
                                            [
                                                'lang' => 'en'
                                            ],
                                            [
                                                'style' => 'color:black'
                                            ]
                                        )
                                    ) !!}
                                </li>
                                <li>
                                    {!! html_entity_decode(
                                        Html::linkRoute(
                                            'change-language', 
                                            Html::image('images/vi.png') . Lang::get('custom.common.vi'), 
                                            [
                                                'lang' => 'vi'
                                            ], 
                                            [
                                                'style' => 'color:black'
                                            ]
                                        )
                                    ) !!}
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /top Header -->

        <!-- header -->
        <div id="header">
            <div class="container">
                <div class="pull-left">
                    <!-- Logo -->
                    <div class="header-logo">
                        {!! html_entity_decode(
                            Html::link(
                                null, 
                                Html::image('assets/img/logo.png'),  
                                [
                                    'class' => 'logo'
                                ]
                            )
                        ) !!}
                    </div>
                    <!-- /Logo -->

                    <!-- Search -->
                    <div class="header-search">
                        {{ Form::open(['url' => '', 'method' => 'post']) }}

                        {{ Form::input('text', 'search_input', null, ['class' => 'input search-input', 'placeholder' => 'Enter your keyword' ]) }}
                        {{ Form::input('button', 'search_button', null, ['class' => 'search-btn'] ) }}

                            <button class="search-btn"><i class="fa fa-search"></i></button>

                        {{ Form::close() }}                        
                    </div>
                    <!-- /Search -->
                </div>
                <div class="pull-right">
                    <ul class="header-btns">
                        <!-- Account -->
                        <li class="header-account dropdown default-dropdown">
                            <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                                <div class="header-btns-icon">
                                    <i class="fa fa-user-o"></i>
                                </div>
                                <strong class="text-uppercase">{!!Lang::get('custom.common.myaccount')!!}<i class="fa fa-caret-down"></i></strong>
                            </div>
                            <span>Ten TK</span>
                            <ul class="custom-menu">
                                
                                @auth
                                {!! html_entity_decode(
                                    Html::link(
                                        null, 
                                        '<li>' .Lang::get('custom.common.myaccount') . '<i class="fa fa-user-o"></i> </li>'
                                    )
                                ) !!}
                                {!! html_entity_decode(
                                    Html::link(
                                        null, 
                                        '<li>' .Lang::get('custom.common.wishlist') . '<i class="fa fa-heart-o"></i> </li>'
                                    )
                                ) !!}
                                {!! html_entity_decode(
                                    Html::link(
                                        null, 
                                        '<li>' .Lang::get('custom.common.logout') . '<i class="fa fa-lock-alt"></i> </li>'
                                    )
                                ) !!}
                                @endauth

                                @guest
                                {!! html_entity_decode(
                                    Html::link(
                                        null, 
                                        '<li>' .Lang::get('custom.common.login') . '<i class="fa fa-unlock-alt"></i> </li>'
                                    )
                                ) !!}
                                {!! html_entity_decode(
                                    Html::link(
                                        null, 
                                        '<li>' .Lang::get('custom.common.register') . '<i class="fa fa-user-plus"></i> </li>'
                                    )
                                ) !!}
                                @endguest
                            </ul>
                        </li>
                        <!-- /Account -->

                        <!-- Cart -->
                        <li class="header-cart dropdown default-dropdown">
                            
                            {!! html_entity_decode(
                                Html::link(
                                    null, 
                                    '<div class="header-btns-icon">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="qty">'.'3'.'</span> </div>
                                        <strong class="text-uppercase">' . Lang::get('custom.common.mycart') . '</strong>
                                        <br>
                                        <span>' .'99$'. '</span>',
                                    [
                                        'class' => 'dropdown-toggle',
                                        'data-toggle' => 'dropdown',
                                        'aria-expanded' => 'true',
                                    ]
                                )
                            ) !!}

                            <div class="custom-menu">
                                <div id="shopping-cart">
                                    <div class="shopping-cart-list">
                                        <div class="product product-widget">
                                            <div class="product-thumb">
                                                {{ HTML::image('assets/img/thumb-product01.jpg', 'a picture') }}
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-price"> $32.50 <span class="qty">x3</span></h3>
                                                <h2 class="product-name">
                                                    {{ HTML::link('#', 'Product Name Goes Here')}}
                                                </h2>
                                            </div>
                                            <button class="cancel-btn"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    <div class="shopping-cart-btns">
                                        <button class="main-btn">{{ Lang::get('custom.common.viewcart') }}</button>
                                        <button class="primary-btn">{{ Lang::get('custom.common.checkout') }} <i class="fa fa-arrow-circle-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- /Cart -->

                        <!-- Mobile nav toggle-->
                        <li class="nav-toggle">
                            <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                        </li>
                        <!-- / Mobile nav toggle -->
                    </ul>
                </div>
            </div>
            <!-- header -->
        </div>
        <!-- container -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <div id="navigation">
        <!-- container -->
        <div class="container">
            <div id="responsive-nav">
                <!-- category nav -->

                <!-- /category nav -->

                <!-- menu nav -->
                <div class="menu-nav">
                    <span class="menu-header"><i class="fa fa-bars"></i></span>
                    <ul class="menu-list">
                        <li>
                            {{ HTML::link('#', 'Home')}}
                        </li>
                        <li class="dropdown default-dropdown">
                            {!! html_entity_decode(
                                Html::link(
                                    null, 
                                    Lang::get('custom.common.category') . '<i class="fa fa-caret-down"></i>',
                                    [
                                        'class' => 'dropdown-toggle',
                                        'data-toggle' => 'dropdown',
                                        'aria-expanded' => 'true',
                                    ]
                                )
                            ) !!}
                            <ul class="custom-menu">
                                <li>{{ HTML::link('#', 'Danh mục 1')}}</li>
                                <li>{{ HTML::link('#', 'Danh mục 2')}}</li>
                                <li>{{ HTML::link('#', 'Danh mục 3')}}</li>
                                <li>{{ HTML::link('#', 'Danh mục 4')}}</li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- menu nav -->
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /NAVIGATION -->

    @section('content')
        @show

    <!-- FOOTER -->
    <footer id="footer" class="section section-grey">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- footer widget -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <!-- footer logo -->
                        <div class="footer-logo">
                            {!! html_entity_decode(
                                            Html::link(
                                                '#',
                                                Html::image('assets/img/logo.png','logo'),
                                                [
                                                    'class' => 'logo'
                                                ]
                                            )
                            ) !!}
                        </div>
                        <!-- /footer logo -->

                        <p>{{Lang::get('custom.common.desc')}}</p>

                        <!-- footer social -->
                        <ul class="footer-social">
                            <li>{!! html_entity_decode(
                                Html::link(
                                    null, 
                                    '<i class="fa fa-facebook"></i>'
                                )
                            ) !!}</li>
                            <li>{!! html_entity_decode(
                                Html::link(
                                    null, 
                                    '<i class="fa fa-twitter"></i>'
                                )
                            ) !!}</li>
                            <li>{!! html_entity_decode(
                                Html::link(
                                    null, 
                                    '<i class="fa fa-instagram"></i>'
                                )
                            ) !!}</li>
                            <li>{!! html_entity_decode(
                                Html::link(
                                    null, 
                                    '<i class="fa fa-google-plus"></i>'
                                )
                            ) !!}</li>
                        </ul>
                        <!-- /footer social -->
                    </div>
                </div>
                <!-- /footer widget -->

                <!-- footer widget -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">{!!Lang::get('custom.common.myaccount')!!}</h3>
                        <ul class="list-links">
                            @auth
                            {!! html_entity_decode(
                                Html::link(
                                    null, 
                                    '<li>' . Lang::get('custom.common.myaccount') . '</li>'
                                )
                            ) !!}
                            {!! html_entity_decode(
                                Html::link(
                                    null, 
                                    '<li>' . Lang::get('custom.common.wishlist') . '</li>'
                                )
                            ) !!}
                            {!! html_entity_decode(
                                Html::link(
                                    null, 
                                    '<li>' . Lang::get('custom.common.logout') . '</li>'
                                )
                            ) !!}
                            @endauth

                            @guest
                            {!! html_entity_decode(
                                Html::link(
                                    null, 
                                    '<li>' . Lang::get('custom.common.login') . '</li>'
                                )
                            ) !!}
                            {!! html_entity_decode(
                                Html::link(
                                    null, 
                                    '<li>' . Lang::get('custom.common.register') . '</li>'
                                )
                            ) !!}
                            @endguest
                        </ul>
                    </div>
                </div>
                <!-- /footer widget -->

                <div class="clearfix visible-sm visible-xs"></div>

                <!-- footer widget -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">{{Lang::get('custom.common.customerservice')}}</h3>
                        <ul class="list-links">
                            <li>{{ HTML::link('#', 'About Us')}}</li>
                            <li>{{ HTML::link('#', 'FAQ')}}</li>
                        </ul>
                    </div>
                </div>
                <!-- /footer widget -->

                <!-- footer subscribe -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">{{Lang::get('custom.common.news')}}</h3>
                        <p>{{Lang::get('custom.common.desnews')}}</p>
                        
                        {{ Form::open() }}
                            <div class="form-group">
                                {{ Form::input('text', 'email_input', null, [
                                                                            'class' => 'input',
                                                                            'placeholder' => 'Enter Email Address'
                                                                            ]) }}
                            </div>
                            <button class="primary-btn">{{Lang::get('custom.common.receive')}}</button>
                        {{Form::close()}}

                    </div>
                </div>
                <!-- /footer subscribe -->
            </div>
            <!-- /row -->
            <hr>
        </div>
        <!-- /container -->
    </footer>
    <!-- /FOOTER -->

    @include('user.layouts.script')
    @section('script')
        @show


</body>

</html>
