<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Product;

class Category extends Model
{
	use SoftDeletes;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function sub()
    {
    	return $this->hasMany(Category::class, 'parent_id');
    }

    public function getParent()
    {
    	return $this->belongsTo(Category::class, 'parent_id');
    }
}
