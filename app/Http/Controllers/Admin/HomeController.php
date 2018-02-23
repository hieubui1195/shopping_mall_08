<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

use App\Models\User;

use MyFunctions;
use Auth;

class HomeController extends Controller
{

    public function index()
    {
        MyFunctions::changeLanguage();
        $avatar = User::find(Auth::user()->id)->image->image;

        return view('admin.home', compact('avatar'));
    }

    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }

}
