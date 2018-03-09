<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Jobs\OrderRejectJob;
use App\Jobs\OrderSuccessJob;
use App\Jobs\OrderRejectItemJob;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use MyFunctions;
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
        MyFunctions::changeLanguage();

        $orders = Order::withTrashed()
                        ->orderBy('created_at', 'desc')
                        ->get();

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
        MyFunctions::changeLanguage();

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
                array_push($promotions, 0);
            }
        }
        
        return view('admin.orders.show', compact('order', 'orderDetails', 'promotions'));
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
        $orderDetails = OrderDetail::where('order_id', $id)->delete();
        $order->delete();
        $order->state = config('custom.defaultTwo');
        $order->save();
        
        return response()->json(['msg' => Lang::get('custom.msg.order_rejected')]);
    }

    public function approveOrder(Request $request)
    {
        $order = Order::find($request->orderId);
        $order->deliver_date = new DateTime();
        $order->state = config('custom.defaultOne');
        $order->save();

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

        $orderDetailId = $request->orderDetailId;
        $orderDetail = OrderDetail::find($orderDetailId);
        $orderDetail->delete();

        return response()->json(['msg' => Lang::get('custom.msg.order_item_rejected')]);
    }
}
