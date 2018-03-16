<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;

class OrderDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'product_id',
        'amount',
    ];
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeCountSale($query)
    {
    	$now = Carbon::now();
        $monthStart = Carbon::createFromFormat('Y-m-d H:i:s', $now->startOfMonth());
        $monthEnd = Carbon::createFromFormat('Y-m-d H:i:s', $now->endOfMonth());
        return $query->whereBetween('created_at', [$monthStart, $monthEnd])
                    ->distinct('product_id')
                    ->count();
    }

    public function scopeDetailWithProduct($query, $orderId)
    {
        return $query->where('order_id', $orderId)
                    ->with('product')
                    ->get();
    }

    public function scopeOrderDetail($query, $orderId)
    {
        return $query->where('order_id', $orderId);
    }
}
