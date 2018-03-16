<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Image;
use App\Models\Category;
use App\Models\PromotionDetail;
use App\Models\Review;
use App\Models\OrderDetail;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'amount',
    ];
    
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function promotionDetail()
    {
        return $this->hasOne(PromotionDetail::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function scopeAllProductsWithImagesCategory($query)
    {
        return $query->withTrashed()
                    ->with('images')
                    ->with('category')
                    ->orderBy('deleted_at')
                    ->orderBy('name')
                    ->get();;
    }

    public function scopeProductId($query, $product)
    {
        return $query->where('name', $product)->value('id');
    }

    public function scopeProductImages($query, $id)
    {
        return $query->where('id', $id)->with('images')->get();
    }

    public function scopeProductRestore($query, $product)
    {
        return $query->withTrashed()->where('name', $product)->restore();
    }

    public function scopeProductNameId($query)
    {
        return $query->pluck('name', 'id');
    }
}
