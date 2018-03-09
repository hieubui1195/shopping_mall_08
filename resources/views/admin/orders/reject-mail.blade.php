@component('mail::message')
# @lang('custom.header.welcome')
<br />

# @lang('custom.mail.thanks')
<br />
@lang('custom.mail.reject', ['code' => $order->id, 'date' => \Carbon\Carbon::now()->format('d F\, Y')])

# @lang('custom.common.order_code', ['attr' => ':']) {{ $order->id }}

<strong>@lang('custom.common.email_detail')</strong>{{ $order->email }}
<br />
<strong>@lang('custom.common.purchase_detail')</strong>{{ \Carbon\Carbon::parse($order->purchase_date)->format('d F\, Y') }}
<br />
<strong>@lang('custom.common.name_detail')</strong>{{ $order->name }}
<br />
<strong>@lang('custom.common.address_detail')</strong>{{ $order->address }}
<br />
<strong>@lang('custom.common.mobile_detail')</strong>{{ $order->phone }}

@component('mail::table')
| @lang('custom.common.order_total')       | @lang('custom.common.purchase')         | @lang('custom.common.delivery')  |
| ------------- |:-------------:| --------:|
| {{ $totalOrder }}     | {{ \Carbon\Carbon::parse($order->purchase_date)->format('d F\, Y') }}      | {{ \Carbon\Carbon::parse($order->deliver_date)->format('d F\, Y') }}      |
@endcomponent

# @lang('custom.common.items')

@component('mail::table')
| @lang('custom.common.product_name')       | @lang('custom.common.price')         | @lang('custom.common.qty')  | @lang('custom.common.product_discount')  | @lang('custom.common.total_price')  |
| ------------- |:-------------:| --------:|
@foreach ($orderDetails as $item)
| {{ $item['product']['name'] }}     | {{ $item['product']['price'] }} @lang('custom.common.currency')      | {{ $item->amount }}      || {{ $promotions[$loop->index] }}      | {{ ceil(($item['product']['price'] * $item->amount) * (100 - $promotions[$loop->index]) / 100) }} @lang('custom.common.currency')      
@endforeach
@endcomponent

@lang('custom.mail.note', ['email' => 'order@eshop.com.vn', 'phone' => '0123456789'])

<br />
{{ \Carbon\Carbon::now() }}
@endcomponent
