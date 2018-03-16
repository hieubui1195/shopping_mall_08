<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image" style="float: left;">
                {!! Html::image(
                    $avatar, 
                    'User Image', 
                    [
                        'class' => 'img-circle'
                    ]
                ) !!} 
            </div>
            <div class="pull-left info" style="float: left;">
                <p>{!! Auth::user()->name !!}</p>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview">

                {!! html_entity_decode(
                    Html::link(
                        null, 
                        '<i class="fas fa-globe"></i> <span>' . 
                        Lang::get('custom.common.change_language') . 
                        '</span><span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i></span>'
                    )
                ) !!}

                <ul class="treeview-menu">
                    <li>
                        {!! html_entity_decode(
                            Html::linkRoute(
                                'change-language', 
                                Html::image('images/en.png') . Lang::get('custom.common.en'), 
                                [
                                    'lang' => 'en'
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
                                ]
                            )
                        ) !!}
                    </li>
                </ul>
            </li>
            <li>
                {!! html_entity_decode(
                    Html::linkRoute(
                        'admin.category.index', 
                        '<i class="fa fa-list"></i> <span>' .  Lang::get('custom.nav.categories') . '</span>'
                    )
                ) !!}
            </li>
            <li>
                {!! html_entity_decode(
                    Html::linkRoute(
                        'admin.product.index', 
                        '<i class="fab fa-product-hunt"></i> <span>' . Lang::get('custom.nav.products') . '</span>'
                    )
                ) !!}
            </li>
            <li>
                {!! html_entity_decode(
                    Html::linkRoute(
                        'admin.promotion.index', 
                        '<i class="fa fa-plus"></i> <span>' . Lang::get('custom.nav.promotions') . '</span>'
                    )
                ) !!}
            </li>
            <li>
                {!! html_entity_decode(
                    Html::linkRoute(
                        'admin.order.index', 
                        '<i class="fa fa-file"></i> <span>' . Lang::get('custom.nav.orders') . '</span>'
                    )
                ) !!}
            </li>
            <li>
                {!! html_entity_decode(
                    Html::linkRoute(
                        'admin.user.index', 
                        '<i class="fa fa-users"></i> <span>' . Lang::get('custom.nav.accounts') . '</span>'
                    )
                ) !!}
            </li>
    </section>
    <!-- /.sidebar -->
</aside>
