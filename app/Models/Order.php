<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\OrderDetail;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'deliver_date',
        'state',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function scopeCountOrder($query)
    {
    	return $query->where('state', config('custom.defaultZero'))->count();
    }

    public function scopeAllOrders($query)
    {
        return $query->withTrashed()
                    ->orderBy('state')
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

}
