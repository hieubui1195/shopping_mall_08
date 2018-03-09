<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Order;
use App\Models\OrderDetail;
use Lang;
use MyFunctions;

class OrderRejectItemMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $order, $orderDetail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $orderDetail = OrderDetail::where('id', $id)
                                    ->with('order')
                                    ->with('product')
                                    ->get();

        $this->orderDetail = $orderDetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        MyFunctions::changeLanguage();

        return $this->subject(Lang::get('custom.mail.subject_reject_item'))
                    ->markdown('admin.orders.reject-item-mail')
                    ->with([
                        'orderDetail' => $this->orderDetail,
                    ]);
    }
}
