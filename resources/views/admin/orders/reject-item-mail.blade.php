@component('mail::message')
# @lang('custom.header.welcome')
<br />

# @lang('custom.mail.thanks')
<br />

@lang('custom.mail.reject_item', ['product' => $orderDetail[0]['product']['name'], 'code' => $orderDetail[0]['order_id']])

# @lang('custom.common.order_code', ['attr' => ':']) {{ $orderDetail[0]['order_id'] }}

<strong>@lang('custom.common.email_detail')</strong>{{ $orderDetail[0]['order']['email'] }}
<br />
<strong>@lang('custom.common.purchase_detail')</strong>{{ \Carbon\Carbon::parse($orderDetail[0]['order']['purchase_date'])->format('d F\, Y') }}
<br />
<strong>@lang('custom.common.name_detail')</strong>{{ $orderDetail[0]['order']['name'] }}
<br />
<strong>@lang('custom.common.address_detail')</strong>{{ $orderDetail[0]['order']['address'] }}
<br />
<strong>@lang('custom.common.mobile_detail')</strong>{{ $orderDetail[0]['order']['phone'] }}

@lang('custom.mail.note', ['email' => 'order@eshop.com.vn', 'phone' => '0123456789'])

<br />
{{ \Carbon\Carbon::now() }}
@endcomponent
