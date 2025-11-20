<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Enum\OrderStatus;

class OrderController extends Controller
{
    // 1) CREATE ORDER
    public function store(Request $request)
    {



        $request->validate([
            'address' => 'required|string|max:255',
            'items'   => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
        ]);

        $total = 0;

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            $total += $product->price * $item['quantity'];
        }

        // Create Order
        $order = Order::create([
            'user_id' => $request->user()->id,
            'address' => $request->address,
            'status'  => 'pending',
            'total'   => $total,
        ]);

        // Insert Order Items
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'quantity'   => $item['quantity'],
                'unit_price' => $product->price,
            ]);
        }





        return response()->json([
            'status' => true,
            'message' => 'Order created successfully',
            'data' => $order
        ]);




    }

    // 2) GET ALL ORDERS OF USER
    public function index(Request $request)
    {
        $orders = Order::with('items.product')
            ->where('user_id', $request->user()->id)
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $orders
        ]);
    }

    // 3) SHOW ONE ORDER
    public function show(Request $request, $id)
    {
        $order = Order::with('items.product')
            ->where('user_id', $request->user()->id)
            ->where('id', $id)
            ->first();

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $order
        ]);
    }





 public function cancel2($id)
{
    $order = Order::findOrFail($id);

    $order->status = OrderStatus::CANCELLED;  // هيشتغل تمام دلوقتي
    $order->save();

    return response()->json([
        'message' => 'Order cancelled successfully',
        'order' => $order
    ]);
}

















public function cancel3(Request $request, $id)
{
    $order = Order::where('user_id', $request->user()->id)
                  ->where('id', $id)
                  ->first();

    if (!$order) {
        return response()->json([
            'status' => false,
            'message' => 'Order not found'
        ], 404);
    }

    // حالات الطلب اللي مسموح إلغاءها
    $cancelableStatuses = ['pending', 'processing'];

    if (!in_array($order->status, $cancelableStatuses)) {
        return response()->json([
            'status' => false,
            'message' => 'Order cannot be cancelled at this stage'
        ], 400);
    }

    // تحديث الحالة
    $order->update([
        'status' => 'cancelled'
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Order cancelled successfully',
        'data' => $order
    ]);
}




public function cancel(Request $request, $id)
{
    $order = Order::where('user_id', $request->user()->id)
                  ->where('id', $id)
                  ->first();

    if (!$order) {
        return response()->json([
            'status' => false,
            'message' => 'Order not found'
        ], 404);
    }

    // Debug: شوف الـ status الفعلي
    return response()->json([
        'current_status' => $order->status,
        'status_type' => gettype($order->status),
        'raw_attributes' => $order->getAttributes()['status']
    ]);
}











}
