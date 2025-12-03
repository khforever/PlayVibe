<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders=Order::with(['user','items.product'])->orderBy('id','DESC')->get();
        return view('dashboard.orders.index',compact('orders'));
    }


    public function deliverd($id)
  {
        $order=Order::findOrFail($id);
        if ($order->status == Order::PENDING) {
            $order->update(['status'=>Order::DELIVERD]);
        }
        return redirect()->route('orders.index')->with('success','Order deliverd successfully');
  }
}
