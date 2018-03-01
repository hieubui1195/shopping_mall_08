<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Models\User;

use Auth;

class CommonComposer
{

    public $avatar;

    public function __construct()
    {
        $this->avatar = config('custom.image.avatar_default');
    }

    public function compose(View $view)
    {
        if (Auth::check()) {
            
            if (User::find(Auth::user()->id)->image) {
                $this->avatar = User::find(Auth::user()->id)->image->image;
            }

            $view->with('avatar', $this->avatar);
        }
        
    }
}
