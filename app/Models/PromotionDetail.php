<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Promotion;
use App\Models\Product; 

class PromotionDetail extends Model
{
    public function promotion()
    {
        $this->belongsTo(Promotion::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
