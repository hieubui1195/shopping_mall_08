<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class MyFunctions
{
    
    public static function changeLanguage()
    {
        $lang = Session::get('website_language', 'default');
        
        return App::setlocale($lang);
    }
}
