<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home',[
            'title' => 'Главная',
            'orders' => Order::all()
        ]);
    }
}
