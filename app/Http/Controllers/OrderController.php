<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function index()
    {
        $orders = Order::all();

        return view('back.orders.index', [
            'orders' => $orders,
            'status' => Order::STATUS
        ]);
    }

    
       
    public function update(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status,
        ]);
        return redirect()->route('orders-index');
    }

 
    public function destroy(Order $order)
    {
        //
    }
}