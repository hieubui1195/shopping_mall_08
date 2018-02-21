<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $this->setLocaleApp();
        
        return view('admin.home');
    }

    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }

    public function setLocaleApp()
    {
        $lang = Session::get('website_language', 'default');

        return App::setlocale($lang);
    }
}
