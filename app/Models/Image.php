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
    public function imageable()
    {
        return $this->morphTo();
    }
}
