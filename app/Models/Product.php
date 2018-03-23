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
                    ->get();
    }

    public function scopeProductId($query, $product)
    {
        return $query->where('name', $product)->value('id');
    }

    public function scopeProductImages($query, $id)
    {
        return $query->where('id', $id)->with('images')->get();
    }

    public function scopeProductImageFirst($query, $id)
    {
        return $query->where('id', $id)->with('images')->first();
    }

    public function scopeProductRestore($query, $product)
    {
        return $query->withTrashed()->where('name', $product)->restore();
    }

    public function scopeProductNameId($query)
    {
        return $query->pluck('name', 'id');
    }

    public function scopeProductFind($query, $id)
    {
        return $query->find($id);
    }

    public function scopeOrderTake($query)
    {
        return $query->orderBy('id', 'desc')
                        ->take(config('custom.defaultEight'));
    }

    public function scopeSearch($query, $search, $type, $sort){
        return $query->where('name','like', '%'.$search.'%')
                        ->orWhere('description','like', '%'.$search.'%')
                        ->orderBy($type, $sort)
                        ->paginate(config('custom.defaultEight'));
    }

    public function scopeOrderPaginate($query, $type, $sort)
    {
        return $query->orderBy($type, $sort)
                        ->paginate(config('custom.defaultEight'));
    }

    public function scopeOrderCategory($query, $categoryId, $type, $sort)
    {
        return $query->where('category_id', $categoryId)
                        ->orderBy($type, $sort)
                        ->paginate(config('custom.defaultEight'));
    }
}
