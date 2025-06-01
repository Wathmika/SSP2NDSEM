<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserOrdersController extends Controller
{
    
    public function index()
    {
        
        $orders = Order::where('User_ID', Auth::id())
            ->orderBy('OrderDate', 'desc')
            ->get();

        
        return view('userorders', compact('orders'));
    }
}
