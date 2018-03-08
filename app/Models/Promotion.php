<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Image;
use App\Models\PromotionDetail;

class Promotion extends Model
{
	use SoftDeletes;
	
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function promotionDetails()
    {
        return $this->hasMany(PromotionDetail::class);
    }
}
