<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Image;
use App\Models\PromotionDetail;

class Promotion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
    ];
    
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function promotionDetails()
    {
        return $this->hasMany(PromotionDetail::class);
    }

    public function scopeAllPromotions($query)
    {
        return $query->withTrashed()
                    ->orderBy('deleted_at')
                    ->orderBy('start_date')
                    ->get();
    }

    public function scopePromotionId($query, $promotion)
    {
        return $query->where('name', $promotion)->value('id');
    }

    public function scopeDetailProduct($query, $id)
    {
        return $query->find($id)->promotionDetails;
    }

    public function scopePromotionImage($query, $id)
    {
        return $query->find($id)->image->image;
    }
}
