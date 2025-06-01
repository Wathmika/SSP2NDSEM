<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $orders = Order::all(); 
        return view('admin', compact('users', 'orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'Status' => 'required|in:pending,processing,done,cancelled',
        ]);

        
        $order = Order::where('_id', $id)->firstOrFail();

        $order->Status = $request->input('Status');
        $order->save();

        return back()->with('success', 'Order status updated.');
    }
}
