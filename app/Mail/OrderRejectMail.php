<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Lang;
use MyFunctions;

class OrderRejectMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $order, $orderDetails, $promotions, $totalOrder;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $order = Order::find($id); 
        $orderDetails = OrderDetail::where('order_id', $id)
                                    ->with('product')
                                    ->get();
        $promotions = [];
        foreach ($orderDetails as $orderDetail) {
            $promotion = Product::find($orderDetail->product_id)->promotionDetail;
            if ($promotion) {
                array_push($promotions, $promotion->percent);
            } else {
                array_push($promotions, config('custom.defaultZero'));
            }
        }
        $totalOrder = 0;
        for ($i=0; $i < count($orderDetails); $i++) { 
            $totalOrder += ceil(($orderDetails[$i]['product']['price'] * $orderDetails[$i]->amount) * (100 - $promotions[$i]) / 100);
        }

        $this->order = $order;
        $this->orderDetails = $orderDetails;
        $this->promotions = $promotions;
        $this->totalOrder = $totalOrder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        MyFunctions::changeLanguage();
        
        return $this->subject(Lang::get('custom.mail.subject_reject'))
                    ->markdown('admin.orders.reject-mail')
                    ->with([
                        'order' => $this->order,
                        'orderDetails' => $this->orderDetails,
                        'promotions' => $this->promotions,
                        'totalOrder' => $this->totalOrder,
                    ]);
    }
}
