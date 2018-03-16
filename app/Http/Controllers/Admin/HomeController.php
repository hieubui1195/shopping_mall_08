<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;

class HomeController extends Controller
{
    public function index()
    {
        $countOrder = Order::countOrder();
        $countUser = User::countUser();
        $countSale = OrderDetail::countSale();

        return view('admin.home', compact('countOrder', 'countUser', 'countSale'));
    }
}
