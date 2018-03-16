<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Product;

class Category extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'name',
        'parent_id',
    ];

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

    public function scopeAllCategories($query)
    {
        return $query->withTrashed()
                    ->with('getParent')
                    ->orderBy('deleted_at')
                    ->orderBy('parent_id')
                    ->orderBy('name')
                    ->get();
    }

    public function scopeMainCategories($query)
    {
        return $query->where('parent_id', config('custom.default_parent'))
                    ->orderBy('name')
                    ->pluck('name', 'id');
    }

    public function scopeSubCategories($query)
    {
        return $query->where('parent_id', '!=', config('custom.default_parent'))
                    ->orderBy('name')
                    ->pluck('name', 'id');
    }

    public function scopeSubIds($query, $id)
    {
        return $query->find($id)->sub->pluck('id');
    }
}
