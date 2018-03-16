<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Jobs\OrderRejectJob;
use App\Jobs\OrderSuccessJob;
use App\Jobs\OrderRejectItemJob;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use DateTime;
use Lang;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::allOrders();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $order = Order::findOrFail($id);
            $orderDetails = OrderDetail::detailWithProduct($id);
            $promotions = [];
            foreach ($orderDetails as $orderDetail) {
                $promotion = Product::find($orderDetail->product_id)->promotionDetail;
                if ($promotion) {
                    array_push($promotions, $promotion->percent);
                } else {
                    array_push($promotions, config('custom.defaultZero'));
                }
            }
            
            return view('admin.orders.show', compact('order', 'orderDetails', 'promotions'));
            
        } catch (ModelNotFoundException $e) {
            return view('admin.partials.404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Queueing
        OrderRejectJob::dispatch($id)
                        ->delay(now()->addSeconds(config('custom.defaultOne')));

        $order = Order::find($id);
        $orderDetails = OrderDetail::orderDetail($id)->delete();
        Order::find($id)->update([
            'state' => config('custom.defaultTwo')
        ]);
        $order->delete();
        
        return response()->json(['msg' => Lang::get('custom.msg.order_rejected')]);
    }

    public function approveOrder(Request $request)
    {
        Order::find($request->orderId)->update([
            'deliver_date' => new DateTime,
            'state' => config('custom.defaultOne'),
        ]);
        
        // Update products table
        $orderDetails = OrderDetail::orderDetail($request->orderId)->get();
        foreach ($orderDetails as $orderDetail) {
            $amountCurrent = $product->value('amount');
            $amountNew = $amountCurrent - $orderDetail->amount;
            Product::find($orderDetail->product_id)->update([
                'amount' => $amountNew,
            ]);
        }

        // Queueing
        OrderSuccessJob::dispatch($request->orderId)
                        ->delay(now()->addSeconds(config('custom.defaultOne')));
                    
        return response()->json(['msg' => Lang::get('custom.msg.order_approved')]);
    }

    public function rejectItem(Request $request)
    {
        // Queueing
        OrderRejectItemJob::dispatch($request->orderDetailId)
                            ->delay(now()->addSeconds(config('custom.defaultOne')));

        OrderDetail::destroy($request->orderDetailId);

        return response()->json(['msg' => Lang::get('custom.msg.order_item_rejected')]);
    }
}
