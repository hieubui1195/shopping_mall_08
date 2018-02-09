<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Image;
use App\Models\PromotionDetail;

class Promotion extends Model
{
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function promotionDetails()
    {
        return $this->hasMany(PromotionDetail::class);
    }
}
