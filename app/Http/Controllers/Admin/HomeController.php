<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

use MyFunctions;

class HomeController extends Controller
{
    public function index()
    {
        MyFunctions::changeLanguage();

        return view('admin.home');
    }
}
