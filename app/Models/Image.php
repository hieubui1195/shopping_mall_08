<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Models\User;
use App\Models\Product;
use App\Models\Promotion;

Relation::morphMap([
    'user' => User::class,
    'product' => Product::class,
    'promotion' => Promotion::class,
]);

class Image extends Model
{
    protected $fillable = [
        'image',
        'imageable_id',
        'imageable_type',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function scopeImageFirst($query, $id, $type)
    {
        return $query->where('imageable_id', $id)
                    ->where('imageable_type', $type)
                    ->first();
    }

    public function scopeDelImagesProduct($query, $productId)
    {
        return $query->where('imageable_id', $productId)
                    ->where('imageable_type', config('custom.image.product'))
                    ->delete();
    }

    public function scopeImageType($query, $type)
    {
        return $query->where('imageable_type', $type);
    }

}
