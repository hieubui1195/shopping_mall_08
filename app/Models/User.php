<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Image;
use App\Models\Review;
use App\Models\Order;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'address',
        'phone',
        'point',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'email', 'email');
    }

    public function scopeCountUser($query)
    {
        return $query->count();
    }

    public function scopeAllUser($query)
    {
        return $query->withTrashed()
                    ->orderBy('deleted_at')
                    ->orderBy('level', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->get();;
    }

    public function scopeUserId($query, $email)
    {
        return $query->where('email', $email)->value('id');;
    }

    public function scopeUserWithImage($query, $id)
    {
        return $query->where('id', $id)->with('image')->get();
    }
}
