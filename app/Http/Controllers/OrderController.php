<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    
    
    public function index()
    {
        

        
        $orders = Order::orderBy('OrderDate', 'desc')->get();

        
        return view('orders.index', compact('orders'));
    }


    //Display a single order’s details.
  
    public function show(string $id)
    {
        
        $order = Order::findOrFail($id);

        
        $orders = Order::where('User_ID', Auth::id())
            ->orderBy('OrderDate', 'desc')
            ->get();

        return view('orders', compact('order'));
        return view('show', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->Status = $request->input('Status');
        $order->save();

        return redirect()->back();
    }
}
