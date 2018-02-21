<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Admin\HomeController;


use Auth;

class AdminLoginController extends Controller
{
    public function getLogin()
    {
        $homeController = new HomeController();
        $homeController->setLocaleApp();
        
        if (Auth::check()) {
            return redirect('admin');
        } else {
            return view('admin.login');
        }
    }

    public function postLogin(LoginRequest $request)
    {
        $homeController = new HomeController();
        $homeController->setLocaleApp();

        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => config('custom.level.admin'),
        ];

        if (Auth::attempt($login)) {
            return redirect('admin');
        } else {
            return redirect()->back()->with([
                'status' => Lang::get('custom.admin_login.status'),
                'email' => $login['email'],
            ]);
        }
    }

    public function getLogout(Request $request)
    {
        Auth::logout();

        return redirect()->route('getLogin');
    }
}
