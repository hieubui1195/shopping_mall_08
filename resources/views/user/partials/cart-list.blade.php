{!! html_entity_decode(
    Html::link(
        null, 
        '<div class="header-btns-icon">
            <i class="fa fa-shopping-cart"></i>
            <span class="qty" id="cart-qty">'. Cart::count() .'</span> </div>
            <strong class="text-uppercase">' . Lang::get('custom.common.mycart') . '</strong><br>
            <span>' . Cart::total() . Lang::get('custom.common.currency') . '</span>',
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
            @foreach ($cart as $item)
                <div class="product product-widget">
                    <div class="product-thumb">
                        {{ Html::image($item->options->image) }}
                    </div>
                    <div class="product-body">
                        <h3 class="product-price">
                            {{ number_format($item->price, config('custom.defaultZero'), '', '.') }} @lang('custom.common.currency') <span class="qty">@lang('custom.common.item_qty', ['qty' => $item->qty ])</span>
                        </h3>
                        <h2 class="product-name">
                            {{ Html::linkRoute('product', $item->name, $item->id)}}
                        </h2>
                    </div>
                    {!! html_entity_decode(
                        Form::button(
                            '<i class="fa fa-trash"></i>',
                            [
                                'class' => 'cancel-btn',
                                'data-id' => $item->rowId,
                            ]
                        )
                    ) !!}
                </div>
            @endforeach
        </div>
        <div class="shopping-cart-btns">
            {!! html_entity_decode(
                Html::linkRoute(
                    'checkout',
                    Lang::get('custom.common.checkout') . ' <i class="fa fa-arrow-circle-right"></i>',
                    [],
                    [
                        'class' => 'primary-btn',
                    ]
                )
            ) !!}
        </div>
    </div>
</div>
